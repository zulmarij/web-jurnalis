<?php

namespace App\Livewire;

use App\Models\Post;
use App\Settings\GeneralSettings;
use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Home extends Component
{
    public string $siteName;
    public string $siteDescription;
    public int $perPage = 12;

    public Collection $posts;

    public function mount(): void
    {
        $settings = app(GeneralSettings::class);

        $this->siteName = $settings->site_name;
        $this->siteDescription = $settings->site_description;

        $this->posts = collect();
        $this->loadPosts();
    }

    protected function configureSeo(): void
    {
        $title = $this->siteName;
        $description = $this->siteDescription;
        $url = route('home');

        seo()
            ->title($title)
            ->description($description)
            ->canonical($url)
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(Schema::organization()->name($title))
            );
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

    public function render()
    {
        $this->configureSeo();

        return view('livewire.home');
    }
}
