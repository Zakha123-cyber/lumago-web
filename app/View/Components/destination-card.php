<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DestinationCard extends Component
{
    public $title;
    public $subtitle;
    public $image;
    public $url;
    public $isActive;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $image
     * @param string|null $subtitle
     * @param string|null $url
     * @param bool $isActive
     */
    public function __construct($title, $image, $subtitle = null, $url = null, $isActive = false)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->image = $image;
        $this->url = $url;
        $this->isActive = $isActive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.destination-card');
    }
}
