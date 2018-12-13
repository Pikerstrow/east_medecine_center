<?php
/**
 * Created by PhpStorm.
 * User: piker
 * Date: 25.09.2018
 * Time: 21:13
 */

namespace Clinic\Classes\Validators;


abstract class TypeNumberFormElement extends FormElement {
    protected $maxValue = 4294967295;
    protected $minValue = 1;

    public function __construct($data){
        parent::__construct($data);

        foreach($this->attributes as $key => $value) {
            switch ($key) {
                case 'maxValue':
                    $this->maxValue = $value;
                    break;
                case 'minValue':
                    $this->minValue = $value;
                    break;
            }
        }
        $this->validate($this->value);
    }
}