<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\Post;
use App\Settings\GeneralSettings;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use Illuminate\Support\Collection;


class Show extends Component
{

    public  $slug;
    public  $post;
    public  $latestPosts;
    public  $latestComments;

    public function mount(): void
    {
        $this->post = Post::whereSlug($this->slug)->firstOrFail();
        $this->latestPosts = Post::published()->take(5)->get();
        $this->latestComments = Comment::approved()->take(5)->get();

        $tags =  $this->post->tags->pluck('name');
        $categories = $this->post->categories->pluck('name');
        $keywords = $tags->merge($categories);

        $settings = app(GeneralSettings::class);

        SEOMeta::setTitle($this->post->title . ' - ' . $settings->site_name, false);
        SEOMeta::setDescription($this->post->excerpt());
        SEOMeta::addMeta('article:published_time', $this->post->published_at->toW3CString(), $this->post->categories->first()->name);
        SEOMeta::addMeta('article:section', $this->post->categories->first()->name, $this->post->categories->first()->name);
        SEOMeta::addKeyword($keywords->unique());

        OpenGraph::setDescription($this->post->excerpt());
        OpenGraph::setTitle($this->post->title);
        OpenGraph::setUrl(route('post.show', ['slug' => $this->slug]));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'id');
        OpenGraph::addProperty('locale:alternate', ['en']);
        OpenGraph::addImage($this->post->imageUrl);

        JsonLd::setTitle($this->post->title);
        JsonLd::setDescription($this->post->excerpt());
        JsonLd::setType('Article');
        JsonLd::addImage($this->post->imageUrl);
    }
}
