<?php namespace Stwt\GoodForm;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class GoodFormField {

    private $errors = [];
    private $help   = [];

    public $id;
    public $label;
    public $name;
    public $options = [];
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
               $path .= 'datetime';
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
            case 'checkbox_bool':
               $path .= 'checkbox-bool';
               break; 
            case 'radio':
            case 'checkbox-group':
               $path .= 'check';
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
    * Adds help items(s) to the field
    * $help can be a string or array
    *
    * @access   public
    * @param    mixed   $help
    * @return   void
    */
    public function addHelp($help) {
        if (is_array($help)) {
            $this->help[] = array_merge($this->help, $help);
        } else {
            $this->help[] = $help;
        }
    }

   /**
    * Adds error(s) to the field
    * $error can be a string or array
    *
    * @access   public
    * @param    mixed   $error
    * @return   void
    */
    public function addError($error) {
        if (is_array($error)) {
            $this->errors = array_merge($this->errors, $error);
        } else {
            $this->errors[] = $error;
        }
    }

   /**
    * Returns all the field help items as a string
    *
    * @access   public
    * @param    string  $format
    * @return   string  
    */
    public function help($format='<span class="help-inline">:message</span>') {
        $string = '';
        foreach ($this->help as $h)
            $string .= str_replace(':message', $h, $format);
        return $string;
    }

   /**
    * Returns all the field errors as a string
    *
    * @access   public
    * @param    string  $format
    * @return   string  
    */
    public function errors($format='<span class="help-inline">:message</span>') {
        $string = '';
        foreach ($this->errors as $e)
            $string .= str_replace(':message', $e, $format);
        return $string;
    }

   /**
    * Returns any classes defined for the field container
    * including any error classes
    *
    * @access   public
    * @param    void
    * @return   void
    */
    public function containerClass() {
        // check for error in field
        if ($this->hasError())
            return 'error';
    }

   /**
    * Returns true if the field has any errors
    *
    * @access   public
    * @return   boolean
    */
    public function hasError() {
        return ($this->errors ? TRUE : FALSE);
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
        Log::error('isSelected '.$this->value.' == '.$value);
        if ($this->value == $value)
            return TRUE;
        if (is_array($this->value) AND in_array($value, $this->value))
            return TRUE;
        return FALSE;
    }

   /**
    * Returns the checked html atribute string
    * if the given value matches this instances value
    *
    * @access   public
    * @param    mixed
    * @return   string
    */
    public function checked($value) {
        if ($this->isSelected($value))
            return 'checked';
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