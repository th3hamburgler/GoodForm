<?php namespace Stwt\GoodForm;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class GoodFormField
{
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
     * Constructs the instance. Can take either
     * an associative array or object to create the field
     *
     * @param mixed $field
     *
     * @return void
     */
    public function __construct($field)
    {
        $properties = (is_array($field) ? $field : get_object_vars($field));
        $forceArray = ['help', 'error'];
        foreach ($properties as $k => $v) {
            if (in_array($k, $forceArray) && !is_array($v)) {
                $this->$k = [$v];
            } else {
                $this->$k = $v;
            }
        }
        if (!$this->id) {
            $this->id = $this->name;
        }
        $this->parseValue();
    }

    /**
     * Parse the field value if any preperation 
     * needs to be done
     *
     * @return   void
     */
    protected function parseValue()
    {
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
     * @return   string
     */
    protected function template()
    {
        $path = 'good-form::';
        switch ($this->type) {
            case 'hidden':
                $path .= 'hidden';
                break;
            case 'color':
                $path .= 'color';
                break;
            case 'datetime':
                $path .= 'datetime';
                return null;
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
     * @return   string
     */
    public function generate()
    {
        $data = [
            'field' => $this,
        ];
        $template = $this->template();
        if ($template) {
            return View::make($template, $data);
        }
    }

    /**
     * Adds help items(s) to the field
     * $help can be a string or array
     *
     * @param mixed $help
     * @return void
     */
    public function addHelp($help)
    {
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
     * @param mixed $error
     *
     * @return void
     */
    public function addError($error)
    {
        if (is_array($error)) {
            $this->errors = array_merge($this->errors, $error);
        } else {
            $this->errors[] = $error;
        }
    }

    /*
     * Returns the fields properties as a string
     * pass in keys of any attributes you dont want
     * returned in the string
     *
     * @param array $not
     *
     * @return string
     */
    public function attributes($not = [])
    {
        $attributes = [
            'class',
            'cols',
            'id',
            'max',
            'min',
            'step',
            'name',
            'placeholder',
            'rows',
            'type',
            'value',
        ];
        $array = [];
        foreach ($attributes as $k) {
            if (isset($this->$k) && !in_array($k, $not)) {
                $array[$k] = $this->$k;
            }
        }
        return GoodForm::array_to_attributes($array);
    }

    /**
     * Returns all the field help items as a string
     *
     * @param string  $format
     *
     * @return string  
     */
    public function help($format = '<span class="help-inline">:message</span>')
    {
        $string = '';
        foreach ($this->help as $h) {
            $string .= str_replace(':message', $h, $format);
        }
        return $string;
    }

    /**
     * Returns all the field errors as a string
     *
     * @param string $format
     *
     * @return string  
     */
    public function errors($format = '<span class="help-inline">:message</span>')
    {
        $string = '';
        foreach ($this->errors as $e) {
            $string .= str_replace(':message', $e, $format);
        }
        return $string;
    }

    /**
     * Returns an array of options for the field
     *
     * [label] => [value]
     *
     * First checked for cached options in the $options property
     * Will then look if this field is tied to a model and load options
     * from the model instead. This array is cached in the model so the
     * query will not be ran each time
     *
     * @return array
     */
    public function options()
    {
        if ($this->options) {
            return $this->options;
        } elseif ($this->model) {
            $object = new $this->model;
            $object::all();
            $this->options = [];
            if (!$this->null) {
                // if field allows null add a null option
                $this->options['-- select --'] = null;
            }
            foreach ($object::all() as $o) {
                $this->options[(string)$o] = $o->id;
            }
            return $this->options;
        } else {
            return [];
        }
    }

    /**
     * Returns any classes defined for the field container
     * including any error classes
     *
     * @return string
     */
    public function containerClass()
    {
        // check for error in field
        if ($this->hasError()) {
            return 'error';
        }
    }

    /**
     * Returns true if the field has any errors
     *
     * @access public
     *
     * @return boolean
     */
    public function hasError()
    {
        return ($this->errors ? true : false);
    }

    /**
     * returns true if the given value matches this
     * instances value. 
     *
     * If this objects value is an array, we'll check if
     * the given value exists in it.
     *
     * @param mixed $value
     *
     * @return boolean
     */
    public function isSelected($value)
    {
        if ($this->value == $value) {
            return true;
        }
        if (is_array($this->value) AND in_array($value, $this->value)) {
            return true;
        }
        return false;
    }

    /**
     * Returns the checked html atribute string
     * if the given value matches this instances value
     *
     * @param mixed $value
     *
     * @return string
     */
    public function checked($value)
    {
        if ($this->isSelected($value)) {
            return 'checked';
        }
    }

    /**
     * Returns the selected html atribute string
     * if the given value matches this instances value
     *
     * @param mixed $value
     *
     * @return string
     */
    public function selected($value)
    {
        if ($this->isSelected($value)) {
            return 'selected';
        }
    }
}
