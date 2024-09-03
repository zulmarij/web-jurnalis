<?php

namespace App\Livewire;

use App\Models\Post;
use App\Settings\GeneralSettings;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PostsByAuthor extends Component
{
    public string $username;
    public int $perPage = 12;
    public Collection $posts;

    public function mount(): void
    {
        $this->posts = collect();
        $this->loadPosts();

        $settings = app(GeneralSettings::class);

        SEOMeta::setTitle(ucwords($this->username) . ' - ' . $settings->site_name, false);
        SEOMeta::setDescription($settings->site_description);
        SEOMeta::setCanonical(route('home'));

        OpenGraph::setDescription($settings->site_description);
        OpenGraph::setTitle(ucwords($this->username) . ' - ' . $settings->site_name);
        OpenGraph::setUrl(route('home'));
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle(ucwords($this->username) . ' - ' . $settings->site_name);
        TwitterCard::setSite('@thestanceid');

        JsonLd::setTitle(ucwords($this->username) . ' - ' . $settings->site_name);
        JsonLd::setDescription($settings->site_description);
        JsonLd::addImage(Storage::url($settings->site_logo));
    }


    public function loadPosts(bool $loadingMore = false): void
    {
        $query = Post::query()
            ->whereHas('user', function ($query) {
                $query->where('username', $this->username);
            })
            ->orderBy('created_at', 'desc')
            ->limit($this->perPage);

        if ($loadingMore) {
            $query->offset($this->posts->count());
        }

        $posts = $query->get();
        $this->posts = $this->posts->merge($posts);
    }

    public function loadMore(): void
    {
        $this->loadPosts(true);
    }

    public function total(): int
    {
        return Post::whereHas('user', function ($query) {
            $query->where('username', $this->username);
        })->count();;
    }

    public function hasMore(): bool
    {
        return $this->posts->count() < $this->total();
    }
}
