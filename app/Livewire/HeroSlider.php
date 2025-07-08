<?php

namespace App\Livewire;

use App\Models\Banner;
use Livewire\Component;
use Livewire\Attributes\On;

class HeroSlider extends Component
{
    public $banners;
    public $currentBanner = 0;

    public function mount()
    {
        $this->banners = Banner::active()->ordered()->get();
    }

    #[On('nextSlide')]
    public function nextSlide()
    {
        if ($this->banners->count() > 0) {
            $this->currentBanner = ($this->currentBanner + 1) % $this->banners->count();
        }
    }

    public function prevSlide()
    {
        if ($this->banners->count() > 0) {
            $this->currentBanner = $this->currentBanner === 0 
                ? $this->banners->count() - 1 
                : $this->currentBanner - 1;
        }
    }

    public function goToBanner($index)
    {
        $this->currentBanner = $index;
    }

    public function render()
    {
        return view('livewire.hero-slider');
    }
}