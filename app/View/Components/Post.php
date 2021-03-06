<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{

    public \App\Models\Post $post;
    public string $classoptions;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Post|null $post
     * @param string $classoptions
     */
    public function __construct(\App\Models\Post $post = null,$classoptions = "")
    {
        $this->post = $post;
        $this->classoptions = $classoptions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post');
    }
}
