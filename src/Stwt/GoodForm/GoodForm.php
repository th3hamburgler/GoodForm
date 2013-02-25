<?php namespace Stwt\GoodForm;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class GoodForm {
    
    private $fields=[];

    public function generate($form) {
        $data = [
            'fields' => $this->fields,
            'form'   => json_decode(json_encode($form), FALSE),
        ];
        return View::make('good-form::form', $data);
    }

    public function add($field) {
        $name   = self::element('name', $field);
        $this->fields[$name]  = new GoodFormField($field);
    }

   /**
    * Updates any fields with validation errors
    *
    * Expects $errors to be an associative array where the key
    * matches the form field name. Errors stored in array for 
    * each field so we can handle multiple erors per field.
    *
    * @access   public
    * @param    array   $errors
    * @return   void
    */
    public function addErrors($errors) {
        foreach ($errors as $name => $error) {
            if ($this->has($name)) {
                // note - error may be array or string
                $this->fields[$name]->addError($error);
            }
        }
    }

   /**
    * Checks if a field of $name exists in this
    * instance of the form.
    *
    * @access   public
    * @param    string  $name
    * @return   boolean
    */
    public function has($name) {
        return (isset($this->fields[$name]) ?: FALSE);
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