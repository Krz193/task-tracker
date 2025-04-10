<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $type;
    public string $message;
    public float $index;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type = 'info', string $message = '', $index = 0)
    {
        $this->type = $type;
        $this->message = ucfirst(strtolower($message));
        $this->index = $index;
    }

    public function delay(): float
    {
        return $this->index * 0.5;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
