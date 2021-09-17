<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class Button extends Component
{
    public $url;
    public $type;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url = null, $type = null, $label = null)
    {
        $this->url = $url;
        $this->type = $type;
        $this->label = $label;
    }

    public function class()
    {
        return [
            'create'    => 'alt-success',
            'show'      => 'alt-info',
            'edit'      => 'alt-primary',
            'delete'    => 'alt-danger',
            'index'      => 'alt-info',
            'impersonate' => 'alt-warning',
        ][$this->type] ?? 'alt-success' ;
    }

    public function title()
    {
        return [
            'create'    => 'Create',
            'show'      => 'View',
            'edit'      => 'Edit',
            'delete'    => 'Delete',
            'index'      => 'Back to Listing',
            'impersonate' => 'Impersonate',
        ][$this->type] ?? '' ;
    }

    public function icon()
    {
        return [
            'create'    => '<i class="fa fa-fw fa-plus mr-1"></i>',
            'show'      => '<i class="far fa-fw fa-eye"></i>',
            'edit'      => '<i class="si fa-fw si-pencil"></i>',
            'delete'    => '<i class="far fa-fw fa-trash-alt text-danger"></i>',
            'index'      => '<i class="fa fa-fw fa-list-ul"></i>',
            'impersonate' => '<i class="fa fa-user-cog"></i>',
        ][$this->type] ?? '' ;
    }

    public function text()
    {
        return [
            'create'    => 'Create',
        ][$this->type] ?? $this->label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.button');
    }
}
