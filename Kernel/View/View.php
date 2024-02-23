<?php
namespace App\Kernel\View;
use App\Kernel\Session\Session;

class View {

    public readonly Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function page(string $name, $template = false)
    {

        if(!$template) {
            $path = APP_PATH . "/views/pages/$name.php";
            if (file_exists($path)) {
                return require_once $path;
            }
            return false;
        }
        $template = APP_PATH."/views/templates/$template.php";
        $page = APP_PATH . "/views/pages/$name.php";
        $session = $this->session;
        if(file_exists($template) && file_exists($page)){
            return require_once $template;
        }
        return false;
    }
}
