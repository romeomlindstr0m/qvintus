<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Combobox extends Component
{
    public string $label;
    public array $options;
    public string $id;
    public string $selected_id;
    public string $selected_name;
    /**
     * Create a new component instance.
     */
    public function __construct(string $label, array $options, string $id, string $selected_id = '', string $selected_name = '')
    {
        $this->label = $label;
        $this->options = $options;
        $this->id = $id;
        $this->selected_id = $selected_id;
        $this->selected_name = $selected_name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.combobox');
    }
}
