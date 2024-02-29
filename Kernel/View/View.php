<?php
namespace App\Kernel\View;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface{

    public readonly SessionInterface $session;
    public readonly AuthInterface $auth;

    public function __construct(Session $session, $auth)
    {
        $this->session = $session;
        $this->auth = $auth;
    }

    public function component($component, $compact = null)
    {
        if(!is_null($compact))
            extract($compact);
        return include APP_PATH."/views/components/$component.php";
    }

    public function page(string $name, $compact=[])
    {
        if(is_array($compact)) {
            extract($compact);
        }
        $session = $this->session;
        $auth = $this->auth;
        $explode = explode('.', $name);
        if(count($explode) > 1){
            [$template, $name] = $explode;
        }else{
            $template = null;
            [$name] = $explode;
        }
        if(!$template) {
            $path = APP_PATH . "/views/pages/$name.php";
            if (file_exists($path)) {
                return require_once $path;
            }
            return false;
        }
        $template = APP_PATH."/views/templates/$template.php";
        $page = APP_PATH . "/views/pages/$name.php";

        if(file_exists($template) && file_exists($page)){
            return require_once $template;
        }
        return false;
    }


}
