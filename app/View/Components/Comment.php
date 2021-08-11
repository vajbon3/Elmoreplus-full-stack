<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comment extends Component
{
    public string $classoptions;
    public \App\Models\Comment $comment;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Comment|null $comment
     * @param String $classoptions
     */
    public function __construct(\App\Models\Comment $comment = null,
                                String $classoptions = "")
    {
        $this->comment = $comment;
        $this->classoptions = $classoptions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment');
    }
}
