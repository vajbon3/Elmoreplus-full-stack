<?php

namespace App\View\Components;

use App\Models\Notification;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $notifications;
    /**
     * Create a new component instance.
     *
     * @param $notifications
     */
    public function __construct($notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
