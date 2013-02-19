<?php namespace Stwt\GoodForm;

use Illuminate\Support\Facades\Log;

class GoodForm {
    
    public $fields=[];

    public function generate() {
        $form = [];
        foreach ($this->fields as $field)
            $form[] = $field->generate();
        return implode("\n", $form);
    }

    public function add($field) {
        $name   = self::element('name', $field);
        Log::error('Add '.$name);
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