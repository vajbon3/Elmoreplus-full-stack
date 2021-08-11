<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Throttle extends Component
{
    public string $classoptions;
    /**
     * Create a new component instance.
     *
     * @param string $classoptions
     */
    public function __construct(string $classoptions = "")
    {
        $this->classoptions = $classoptions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.throttle');
    }
}
