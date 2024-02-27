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
        <?php if ($auth->check()):?>
        <h1>
            <?= $auth->user()->email() ?>
        </h1>
            <form action="/logout">
                <button type="submit">
                Logout
                </button>

            </form>
        <?php endif; ?>

    </header>
    <?php
    require_once $page;
    ?>
</body>
</html>