<?php
/**
 * @var $page - the path to the page
 * @var \App\Kernel\Auth\AuthClass $auth;
 * */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/css.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <div class="container">
                        <div class="row d-flex justify-content-between">
                            <div class="col-2">
                                <div class="logo my-4 d-flex justify-content-center">
                                   <h1>SAM</h1>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="nav w-100">
                                    <ul class="d-flex justify-content-between align-items-center w-100">
                                        <li>
                                            <a href="http://sam/home" <?php if($_SERVER['REQUEST_URI']==='/home'):?>
                                                style = "color: orange; text-shadow: orange 0 0 10px;" <?php endif; ?>>
                                                Главная
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/admin/products" <?php if($_SERVER['REQUEST_URI']==='/admin/products'):?>
                                                style = "color: orange; text-shadow: orange 0 0 10px;" <?php endif; ?>>
                                                Игры</a>
                                        </li>
                                        <li>
                                            <a href="/users"  <?php if($_SERVER['REQUEST_URI']==='/users'):?>
                                                style = "color: orange; text-shadow: orange 0 0 10px;" <?php endif; ?>>
                                                Пользователи</a>
                                        </li>
                                        <li>
                                            <a href="/genres"  <?php if($_SERVER['REQUEST_URI']==='/genres'):?>
                                                style = "color: orange; text-shadow: orange 0 0 10px;" <?php endif; ?>>
                                                Жанры</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
    require_once $page;
    ?>
</body>
</html>