# Change log

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