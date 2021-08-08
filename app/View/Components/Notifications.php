<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notifications extends Component
{
    public $notifications;
    public $bclass;

    /**
     * Create a new component instance.
     *
     * @param $bclass
     * @param $notifications
     */
    public function __construct($notifications, $bclass = "")
    {
        $this->notifications = $notifications;
        $this->bclass = $bclass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications');
    }
}
