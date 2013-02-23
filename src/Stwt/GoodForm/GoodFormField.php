<?php namespace Stwt\GoodForm;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class GoodFormField {

    public $error;
    public $help;
    public $id;
    public $label;
    public $name;
    public $options;
    public $type;
    public $value;

    // numbers
    public $min;
    public $max;
    public $step;

   /**
    * constructor
    *
    * @access   public
    * @param    object
    * @return   void
    */
    public function __construct($field) {
        foreach ((is_array($field) ? $field : get_object_vars($field)) as $k => $v) {
            $this->$k = $v;
        }
        if (!$this->id) $this->id = $this->name;
        $this->parseValue();
    }

    /**
    * method
    *
    * @access   protected
    * @param    void
    * @return   void
    */
    protected function parseValue() {
        if ($this->type == 'datetime') {
            $time = strtotime($this->value);
            $this->value = [
                'date'  => date('Y-m-d', $time),
                'time'  => date('H:i:s', $time),
            ];
        }
    }

   /**
    * returns the blade template for this field
    *
    * @access   protected
    * @param    void
    * @return   string
    */
    protected function template() {
        $path = 'good-form::';
        switch ($this->type) {
            case 'hidden':
               $path .= 'hidden';
               break;
            case 'datetime':
               //$path .= 'datetime';
                return NULL;
               break;
            case 'textarea':
               $path .= 'textarea';
               break;
            case 'select':
               $path .= 'select';
               break;
            case 'float':
            case 'decimal':
            case 'number':
               $path .= 'number';
               break;
            default:
               // Log::error($this->type);
               $path .= 'input';
               break;
       }
       return $path;
    }

   /**
    * generate the form element
    *
    * @access   public
    * @return   string
    */
    public function generate() {
        $data = [
            'field' => $this,
        ];
        $template = $this->template();
        if ($template)
            return View::make($template, $data);
    }

   /**
    * returns true if the given value matches this
    * instances value. 
    *
    * If this objects value is an array, we'll check if
    * the given value exists in it.
    *
    * @access   public
    * @param    mixed
    * @return   boolean
    */
    public function isSelected($value) {
        if ($this->value == $value)
            return TRUE;
        if (is_array($this->value) AND in_array($value, $this->value))
            return TRUE;
        return FALSE;
    }

   /**
    * Returns the selected html atribute string
    * if the given value matches this instances value
    *
    * @access   public
    * @param    mixed
    * @return   string
    */
    public function selected($value) {
        if ($this->isSelected($value))
            return 'selected';
    }
}