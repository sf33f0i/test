<?php
namespace App\Kernel\Validator;

interface ValidatorInterface {
    public function validate($data, $rules):array|bool;
    public function validationRule(string $key,string $ruleName, $ruleValue = null);
    public function loadAlias();
    public function errors():array;
}