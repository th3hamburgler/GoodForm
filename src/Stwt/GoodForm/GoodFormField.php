<?php namespace Stwt\GoodForm;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class GoodFormField {

    public $id;
    public $label;
    public $name;
    public $type;

   /**
    * constructor
    *
    * @access   public
    * @param    object
    * @return   void
    */
    public function __construct($field) {
        $this->name     = $field->name;
        $this->id       = $field->name;
        $this->label    = $field->label;
        $this->type     = $field->form;
    }

   /**
    * generate the form element
    *
    * @access   public
    * @param    void
    * @return   void
    */
    public function generate() {
        $data = [
            'f' => $this,
            'name'  => $this->name,
            'label'  => $this->label,
        ];
        switch ($this->type) {
            case 'hidden':
                return '';
                break;
            case 'text':
            case 'password':
            case 'email':
            case 'date':
                Log::error('Generate '.$this->label);
                return View::make('good-form::input', $data)->render();
            default:
                return View::make('good-form::template', $data)->render();
                break;
        }
    }
}