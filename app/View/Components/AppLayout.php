<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public string $customStyles; // Property to hold custom styles

    public function __construct(string $customStyles = '') // Constructor to set custom styles
    {
        $this->customStyles = $customStyles;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app', ['customStyles' => $this->customStyles]);
    }
}
