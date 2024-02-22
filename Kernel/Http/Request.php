<?php
namespace App\Kernel\Http;

class Request {


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
}