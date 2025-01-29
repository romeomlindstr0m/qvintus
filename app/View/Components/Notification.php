<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notification extends Component
{
    public string $type;
    public string $title;
    public array $body;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type, string $title, array $body)
    {
        $this->type = $type;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification');
    }
}
