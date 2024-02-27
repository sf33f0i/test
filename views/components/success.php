<?php
/**
 * @var \App\Kernel\Session\Session $session
 * */
if($session->has('success')):?>
    <div class="alert alert-success">
        <?= $session->flash('success') ?>
    </div>
<?php endif; ?>
