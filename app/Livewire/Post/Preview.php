<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Preview extends Component
{

    public  $slug;
    public  $post;


    public function mount(): void
    {
        $this->post = Post::whereSlug($this->slug)->firstOrFail();
    }

    #[Layout('components.layouts.preview')]
    public function render()
    {
        return view('livewire.post.preview');
    }
}
