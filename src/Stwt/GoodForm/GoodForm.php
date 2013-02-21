<?php namespace Stwt\GoodForm;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class GoodForm {
    
    public $fields=[];

    public function generate($form) {
        $data = [
            'fields' => $this->fields,
            'form'   => json_decode(json_encode($form), FALSE),
        ];
        return View::make('good-form::form', $data);
    }

    public function add($field) {
        $name   = self::element('name', $field);
        Log::error('Add '.$name);
        Log::error(print_r($field, 1));
        $this->fields[$name]  = new GoodFormField($field);
    }

   /*
    * Safely return an array element or object property
    * with a default fallback value
    *
    * @param    array
    * @param    string
    * @param    mixed
    * @return   mixed
    */
    private static function element($index, $collection, $default=NULL) {
        if (is_object($collection)) {
            if (isset($collection->{$index}))
                return $collection->{$index};
        } else if (is_array($collection)) {
            if (isset($collection[$index]))
                return $collection[$index];
        }
        return $default;
    }
}