<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FlashError extends Component
{
    public string $error;
    /**
     * Create a new component instance.
     *
     * @param $error
     */
    public function __construct($error)
    {
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.flash-error');
    }
}
