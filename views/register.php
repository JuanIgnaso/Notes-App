<?php
use app\core\Application;
use app\core\Cookie;

$this->title = 'Registrarse';
?>
<h1 class="tituloPagina">Registrar Nuevo Usuario</h1>
<main class="main-login-register">
    <div class="main-login-register-inner">
        <?php $form = app\core\form\Form::begin('', 'post'); ?>
        <i class="fa-solid fa-map-pin login-pin"></i>
        <?php echo $form->field($model, 'nombre'); ?>
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <?php echo $form->field($model, 'passwordConfirm')->passwordField(); ?>
        <span id="capsOn"><strong></strong></span>
        <input type="submit" value="Registrar Cuenta">
        <script src="/resources/js/isCapsOn.js"></script> <!-- Muestra mensaje cuando las maýusc están activadas -->
        <?php app\core\form\Form::end(); ?>
    </div>
</main>