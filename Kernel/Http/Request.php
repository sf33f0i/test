<?php
namespace App\Kernel\Http;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;

class Request implements RequestInterface {

    private Validator $validator;

    private function __construct(
    public readonly array $get,
    public readonly array $post,
    public readonly array $request,
    public readonly array $server,
    public readonly array $files)
    {
    }

    public static function RequestSet():static
    {
        return (new static($_GET, $_POST, $_REQUEST, $_SERVER, $_FILES));
    }

    public function getUri()
    {
        return strtok($this->server['REQUEST_URI'],'?');
    }

    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }
    public function all():array
    {
        return $this->request;
    }

    public function input($name, $default = null)
    {
        return $this->request[$name]??$default;
    }

    public function validate($rules):bool|array
    {
        $data = [];
        $FilterRules = [];
        foreach ($rules as $key => $nameFiled){
            if(array_key_exists($key , $this->request)) {
                $data[$key] = $this->input($key);
                $FilterRules[$key] = $nameFiled;
            }
        }
        return $this->validator->validate($data, $FilterRules);
    }

    public function errors():array
    {
        return $this->validator->errors();
    }
    public function setValidator(ValidatorInterface $validator):void
    {
        $this->validator = $validator;
    }
}