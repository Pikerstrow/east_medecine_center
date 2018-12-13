<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:13
 */

namespace Clinic\Classes\Validators;


abstract class TypeTextFormElement extends FormElement {
    protected $maxlength = 65535;
    protected $minlength = 5;

    public function __construct($data){
        parent::__construct($data);

        foreach($this->attributes as $key => $value) {
            switch ($key) {
                case 'maxlength':
                    $this->maxlength = $value;
                    break;
                case 'minlength':
                    $this->minlength = $value;
                    break;
            }
        }
        $this->validate($this->value);
    }
}