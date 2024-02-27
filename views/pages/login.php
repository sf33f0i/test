<form action="/login" method="POST">
    <input type="text" name = "email">
    <input type="text" name="password">
    <input type="submit">
</form>
<?php $this->component('errors', compact(['session'])); ?>
