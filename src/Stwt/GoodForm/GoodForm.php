<?php namespace Stwt\GoodForm;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class GoodForm
{
    private $fields  = [];
    private $actions = [];
    private $attr    = [
        //'class'  => 'form-horizontal',
        'method' => 'POST',
    ];

    public static $theme = 'bootstrap3';

    public function generate($attr = null)
    {
        if ($attr) {
            $this->attr($attr);
        }
        // convert array to object
        $form    = json_decode(json_encode($this->attr), false);

        $fields = [];
        foreach ($this->fields as $k => $v) {
            $fields[$k] = $v->generate();
        }

        $data = [
            'actions'        => $this->actions,
            'fields'         => $fields,
            'form'           => $form,
            'formAttributes' => $this->attributes(),
        ];

        $theme = self::$theme;
        return View::make("good-form::{$theme}.form", $data)->render();
    }


    /***************************/


    /**
     * Add a hidden input to the form
     * 
     * @param  string $name       The field name
     * @param  stirng $value      The field value
     * @param  array  $attributes Any additional attributes
     * 
     * @return GoodForm           Returns form instance (chainable)
     */
    public function hidden($name, $value, $label = null, $attributes = [])
    {
        return $this->add('hidden', $name, $value, $label, $attributes);
    }

    /**
     * Add a text input to the form
     * 
     * @param  string $name       The field name
     * @param  stirng $value      The field value
     * @param  array  $attributes Any additional attributes
     * 
     * @return GoodForm           Returns form instance (chainable)
     */
    public function text($name, $value, $label = null, $attributes = [])
    {
        return $this->add('text', $name, $value, $label, $attributes);
    }

    /**
     * Add a datetime input to the form
     * 
     * @param  string $name       The field name
     * @param  stirng $value      The field value
     * @param  array  $attributes Any additional attributes
     * 
     * @return GoodForm           Returns form instance (chainable)
     */
    public function datetime($name, $value, $label = null, $attributes = [])
    {
        return $this->add('datetime', $name, $value, $label, $attributes);
    }

    /**
     * Add a date input to the form
     * 
     * @param  string $name       The field name
     * @param  stirng $value      The field value
     * @param  array  $attributes Any additional attributes
     * 
     * @return GoodForm           Returns form instance (chainable)
     */
    public function date($name, $value, $label = null, $attributes = [])
    {
        return $this->add('date', $name, $value, $label, $attributes);
    }

    /**
     * Add a time input to the form
     * 
     * @param  string $name       The field name
     * @param  stirng $value      The field value
     * @param  array  $attributes Any additional attributes
     * 
     * @return GoodForm           Returns form instance (chainable)
     */
    public function time($name, $value, $label = null, $attributes = [])
    {
        return $this->add('time', $name, $value, $label, $attributes);
    }

    public function add($type, $name = null, $value = null, $label = null, $attributes = [])
    {
        if (is_array($type) or is_object($type)) {
            $attributes = $type;
        } else {
            $attributes['label'] = $label;
            $attributes['name']  = $name;
            $attributes['type']  = $type;
            $attributes['value'] = $value;
        }

        $name   = self::element('name', $attributes);

        if (self::element('type', $attributes) == 'file') {
            $this->attr('enctype', 'multipart/form-data');
        }
        $this->fields[$name]  = new GoodFormField($attributes);

        return $this;
    }


    /***************************/


    public function addAction($field)
    {
        $name = self::element('name', $field);
        if (self::element('type', $field)) {
            $this->attr('enctype', 'multipart/form-data');
        }
        $this->actions[$name]  = new GoodFormField($field);
    }

    public function attributes()
    {
        $array = [];

        foreach ($this->attr as $k => $v) {
            $array[] = $k.'="'.$v.'"';
        }

        return implode(' ', $array);
    }

    /*
     * Add attributes to the form
     *
     * Accepts $key & $value as parameters or pass
     * an associative array as the first parameter
     * to add multiple attributes at once
     *
     * Examples
     * --------
     * $form->attr('method', 'POST');
     * $form->attr(['method' => 'POST', 'method' => '/uri/to']);
     *
     * @param mixed  $key
     * @param string $value
     */
    public function attr($key, $value = null)
    {
        if (is_array($key)) {
            $this->attr = array_merge($this->attr, $key);
        } else {
            $this->attr[$key] = $value;
        }
        return $this;
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
    public function addErrors($errors)
    {
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
    public function has($name)
    {
        return (isset($this->fields[$name]) ?: false);
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
    private static function element($index, $collection, $default = null)
    {
        if (is_object($collection)) {
            if (isset($collection->{$index})) {
                return $collection->{$index};
            }
        } elseif (is_array($collection)) {
            if (isset($collection[$index])) {
                return $collection[$index];
            }
        }
        return $default;
    }

    /*
     * Returns a key => value associative array 
     * as a key="value" string
     *
     * @param    array $array
     *
     * @return   string
     */
    public static function arrayToAttributes($array)
    {
        $attr = [];
        foreach ($array as $k => $v) {
            $attr[] = $k.'="'.$v.'"';
        }
        return implode(' ', $attr);
    }
}
