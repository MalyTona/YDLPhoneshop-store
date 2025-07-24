<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Blog Post')]
class PostDetailPage extends Component
{
    public Post $post;
    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.post-detail-page');
    }
}
