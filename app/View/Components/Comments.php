<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Comments extends Component
{
    public Collection $comments;
    public \App\Models\Post $post;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $comments = null,\App\Models\Post $post = null)
    {
        $this->comments = $comments;
        if($comments == null)
            $this->comments = collect();

        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comments');
    }
}
