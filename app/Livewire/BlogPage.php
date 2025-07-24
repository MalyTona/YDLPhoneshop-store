<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Blog - YDLPhoneShop')]
class BlogPage extends Component
{
    public function render()
    {
        $posts = Post::where('is_published', true)->latest()->paginate(6);
        return view('livewire.blog-page', compact('posts'));
    }
}
