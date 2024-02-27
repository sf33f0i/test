<?php
/**
 * @var \App\Kernel\Session\Session $session;
 **/
?>
<?php if($session->has('errors')) { ?>
    <div class="alert alert-danger">
        <ul>
            <?php
            foreach ($session->flash('errors') as $error){
                echo '<li>'. $error .'</li>';
            }
            ?>
        </ul>
    </div>
<?php } ?>