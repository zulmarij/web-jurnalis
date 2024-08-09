<?php

namespace App\Livewire;

use App\Models\Post;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Home extends Component
{
    public function render()
    {
        $generalSettings = app(GeneralSettings::class);

        seo()
            ->title($title = $generalSettings->site_name)
            ->description($description = $generalSettings->site_description)
            ->canonical($url = route('home'))
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(Schema::organization()->name($title))
            );


        $featuredPosts = Post::published()->take(5)->get();
        $carouselPosts = Post::published()
            ->take(9)
            ->get();
        $posts = Post::published()
            ->take(4)->get();

        return view('livewire.home', compact('posts', 'featuredPosts', 'carouselPosts'));
    }
}
