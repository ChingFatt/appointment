<?php 

namespace App\Services\Html;

class HtmlBuilder extends \Collective\Html\FormBuilder {

    public function btnCreate($url = null) {
        return '<a href="'.$url.'" class="btn btn-alt-success" data-toggle="click-ripple"><i class="fa fa-fw fa-plus mr-1"></i> Create</a>';
    }

    public function btnView($url = null, $label = null) {
        return '<a href="'.$url.'" class="btn btn-sm btn-alt-info" data-toggle="tooltip" data-placement="top" title="View"><i class="far fa-fw fa-eye"></i>'.$label.'</a>';
    }
    
    public function btnEdit($url = null, $label = null) {
        return '<a href="'.$url.'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="si fa-fw si-pencil"></i>'.$label.'</a>';
    }

    public function btnDelete($url = null, $label = null) {
        return '<a href="javascript:void(0)" class="ml-1 btn btn-sm btn-alt-danger" id="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-fw fa-trash-alt text-danger"></i>'.$label.'</a>';
    }

    public function btnModalCreate($modalID) {
        return '<a href="javascript:void(0)" class="btn btn-alt-success" data-toggle="modal" data-target="'.$modalID.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-fw fa-plus mr-1"></i> Create</a>';
    }

    public function btnSave() {
        return '<div class="btn-group mr-2"><button type="submit" class="btn btn-alt-primary">Save</button></div><div class="btn-group"><a href="'.url()->previous().'" class="btn btn-alt-secondary">Cancel</a></div>';
    }

    public function btnBack($url = null, $label = null) {
        return '<a href="'.$url.'" class="btn btn-sm btn-alt-info mr-1" data-toggle="tooltip" data-placement="top" title="Back to Listing"><i class="fa fa-fw fa-list-ul"></i>'.$label.'</a>';
    }
}