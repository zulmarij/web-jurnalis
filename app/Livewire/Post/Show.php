<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\Post;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Str;

class Show extends Component
{

    public $slug;

    public function render()
    {
        $generalSettings = app(GeneralSettings::class);
        $post = Post::with(['comments' => fn ($query) => $query->approved()])->whereSlug($this->slug)->firstOrFail();;

        seo()
            ->title($generalSettings->site_name . ' - ' . ($post->seoDetail?->title ?? $post->title))
            ->description($post->seoDetail->description ?? Str::limit($post->body, 160))
            ->canonical(route('post.show', ['slug' => $this->slug]))
            ->addSchema( 
                Schema::article()
                    ->headline($post->seoDetail->title ?? $post->title)
                    ->articleBody($post->seoDetail->description ?? Str::limit($post->body, 160))
                    ->image($post->imageUrl)
                    ->datePublished($post->published_at)
                    ->dateModified($post->updated_at)
                    ->author(Schema::person()->name($post->user->name))
            );

        $latestPosts = Post::published()->take(5)->get();
        $recentComments = Comment::approved()->take(4)->get();

        return view('livewire.post.show', compact((['post', 'latestPosts', 'recentComments'])));
    }
}
