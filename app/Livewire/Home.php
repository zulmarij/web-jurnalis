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

class Home extends Component
{
    public int $perPage = 12;

    public Collection $posts;

    public function mount(): void
    {
        $this->posts = collect();
        $this->loadPosts();

        $settings = app(GeneralSettings::class);

        SEOMeta::setTitle($settings->site_name, false);
        SEOMeta::setDescription($settings->site_description);
        SEOMeta::setCanonical(route('home'));

        OpenGraph::setDescription($settings->site_description);
        OpenGraph::setTitle($settings->site_name);
        OpenGraph::setUrl(route('home'));
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle($settings->site_name);
        TwitterCard::setSite('@thestanceid');

        JsonLd::setTitle($settings->site_name);
        JsonLd::setDescription($settings->site_description);
        JsonLd::addImage(Storage::url($settings->site_logo));
    }


    public function loadPosts(bool $loadingMore = false): void
    {
        $query = Post::query()->limit($this->perPage);

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
        return Post::count();
    }

    public function hasMore(): bool
    {
        return $this->posts->count() < $this->total();
    }
}
