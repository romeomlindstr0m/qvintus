<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notification extends Component
{
    public string $title;
    public $messages;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $messages)
    {
        $this->title = $title;
        $this->messages = is_array($messages) ? $messages : [$messages];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification');
    }
}
