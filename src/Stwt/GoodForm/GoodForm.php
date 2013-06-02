<?php namespace Stwt\GoodForm;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class GoodForm
{
    private $fields  = [];
    private $actions = [];
    private $attr    = [
        'class'  => 'form-horizontal',
        'method' => 'POST',
    ];

    public function generate($attr = null)
    {
        if ($attr) {
            $this->attr($attr);
        }
        // convert array to object
        $form    = json_decode(json_encode($this->attr), false);
        $data = [
            'actions'        => $this->actions,
            'fields'         => $this->fields,
            'form'           => $form,
            'formAttributes' => $this->attributes(),
        ];
        return View::make('good-form::form', $data);
    }

    public function add($field)
    {
        $name   = self::element('name', $field);
        if (self::element('type', $field) == 'file') {
            $this->attr('enctype', 'multipart/form-data');
        }
        $this->fields[$name]  = new GoodFormField($field);
    }

    public function hidden($name, $value)
    {
        $field = [];
        
        $field['name']  = $name;
        $field['type']  = 'hidden';
        $field['value'] = $value;

        return $this->add($field);
    }

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
