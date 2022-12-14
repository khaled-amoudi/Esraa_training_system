<?php

namespace App\View\Components\BaseComponents\layout;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $items;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (request()->routeIs(['dashboard', 'dashboard.*'])) {
            $this->items = config('sidebar_items');
        }
        elseif(request()->routeIs(['teacher', 'teacher.*'])){
            $this->items = config('sidebar_items_teacher');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.BaseComponents.layout.sidebar');
    }
}
