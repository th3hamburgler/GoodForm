# Change log

## 31st May 2013

* Bug with model options. Null fields did not have a null option
* Use the field value found in Input::old() if it's present

## 24th May 2013

* Updated the datetime input field layout

## 13th May 2013

* Fixed bug where any input field with a type attribute would set the form to a multitype form

## 26th April 2013

* Changed the action types in resource controllers to 'collection', 'resource', 'related' & 'single'
* Added localization support and moved much of the language string into lang/mothership.php

## 25th April 2013

* Added the $form property. This defines the form element tag
* Added actions. These are fields that will appear in the form footer. Like submit and cancel buttons

## 24th April 2013

* Password fields will now never include the value attribute in forms for secrity reasons.

## 16th April 2013

* added options() method that will automatically return all instances of a table _if_ the field is linked to a model.