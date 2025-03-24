<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $message;
    public $title;
    public $id;
    /**
     * Create a new component instance.
     */
    public function __construct($type = 'success', $message = '', $title = '', $id = 'alert')
    {
        $this->type = $type;
        $this->message = $message;
        $this->title = $title ?: $this->getDefaultTitle($type);
        $this->id = $id;
    }

    private function getDefaultTitle($type)
    {
        return match ($type) {
            'success' => 'Success!',
            'danger', 'error' => 'Error!',
            'warning' => 'Warning!',
            'info' => 'Info!',
            default => 'Notification',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
