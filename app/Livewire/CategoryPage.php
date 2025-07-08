<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Category;

#[Title('Categories - YDLPhoneshop')]
class CategoryPage extends Component
{ 
   
    public function render()
    { 
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.category-page',[
             'categories' => $categories,
        ]);
       
    }
}
