<?php
/**
 * @var \App\Kernel\Session\Session $session;
 **/
?>
<form action="/admin/products" method="POST">
    <input type="text" name="name" placeholder="Наименование товара">
    <input type="text" name="price" placeholder="Наименование товара2">
    <button type="submit">Добавить</button>
</form>
<?php $this->component('errors', compact(['session'])); ?>
<?php $this->component('success', compact(['session'])); ?>

