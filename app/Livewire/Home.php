<?php

namespace App\Livewire;

use App\Models\Post;
use App\Settings\GeneralSettings;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Home extends Component
{
    public $featuredPost;
    // public $posts;
    public $headlinePosts;
    public $nowYouKnowPosts;
    public $soultNutrientPosts;
    public $bigShiftPosts;
    public $popCulturePosts;
    public $humanOfChangePosts;
    public $socialPodiumPosts;

    public function mount(): void
    {
        $this->featuredPost = Post::latest()->firstOrFail();

        $this->headlinePosts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'headline');
        })
            ->where('id', '!=', $this->featuredPost->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $this->nowYouKnowPosts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'now-you-know');
        })
            ->where('id', '!=', $this->featuredPost->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $this->soultNutrientPosts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'soul-nutrient');
        })
            ->where('id', '!=', $this->featuredPost->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $this->bigShiftPosts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'big-shift');
        })
            ->where('id', '!=', $this->featuredPost->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $this->popCulturePosts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'pop-culture');
        })
            ->where('id', '!=', $this->featuredPost->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $this->humanOfChangePosts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'human-of-change');
        })
            ->where('id', '!=', $this->featuredPost->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $this->socialPodiumPosts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'social-podium');
        })
            ->where('id', '!=', $this->featuredPost->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();


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
}
