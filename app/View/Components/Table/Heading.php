<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Heading extends Component
{
    public $sortable;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sortable = null)
    {
        $this->sortable = $sortable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.heading');
    }
}
