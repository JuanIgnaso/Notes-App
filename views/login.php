<?php
use app\core\Application;

$this->title = 'Login';
?>
<h1 class="tituloPagina">Registrar Nuevo Usuario</h1>
<main class="main-login-register">
    <div class="main-login-register-inner">
        <?php $form = app\core\form\Form::begin('', 'post'); ?>
        <i class="fa-solid fa-map-pin login-pin"></i>
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <input type="submit" value="Registrar Cuenta">
        <?php app\core\form\Form::end(); ?>
    </div>
</main>