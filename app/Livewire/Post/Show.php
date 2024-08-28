<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\Post;
use App\Settings\GeneralSettings;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Show extends Component
{

    public  $slug;
    public  $post;
    public  $latestPosts;
    public  $latestComments;

    public function mount(): void
    {
        $settings = app(GeneralSettings::class);
        $this->post = Post::whereSlug($this->slug)->firstOrFail();
        $this->latestPosts = Post::published()->take(5)->get();
        $this->latestComments = Comment::approved()->take(5)->get();

        $title = ($this->post->seoDetail->title ?? $this->post->title) . ' - ' . $settings->site_name;
        $description = $this->post->seoDetail->description ?? $this->post->excerpt();
        $tags =  $this->post->tags->pluck('name');
        $categories = $this->post->categories->pluck('name');
        $keywords = $tags->merge($categories)->unique()->implode(', ');
        $media = $this->post->media_url;
        $publishedTime = $this->post->published_at->toW3CString();

        SEOMeta::setTitle($title, false);
        SEOMeta::setDescription($description);
        SEOMeta::addMeta('article:published_time', $publishedTime,  $categories[0]);
        SEOMeta::addMeta('article:section',  $categories[0],  $categories[0]);
        SEOMeta::addKeyword($keywords);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl(route('post.show', ['slug' => $this->slug]));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'id');
        OpenGraph::addProperty('locale:alternate', ['en']);
        OpenGraph::addImage($media);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('Article');
        JsonLd::addImage($media);
    }
}
