<?php
namespace App\Kernel\View;

class View {

    public function page(string $name)
    {
        $path = APP_PATH."/veiws/$name.php";
        if (file_exists($path)) {
            return require_once $path;
        }
        die('Страница не найдена');
    }
}