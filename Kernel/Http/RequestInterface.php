<?php
namespace App\Kernel\Http;
use App\Kernel\Validator\ValidatorInterface;

interface RequestInterface {

    public static function RequestSet():static;
    public function getUri();
    public function getMethod();
    public function all():array;
    public function input($name, $default = null);
    public function validate($rules):bool|array;
    public function errors():array;
    public function setValidator(ValidatorInterface $validator):void;


}