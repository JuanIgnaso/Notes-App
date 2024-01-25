<?php
use app\core\Application;

$this->title = 'Login';
?>
<h1 class="tituloPagina">Iniciar Sesión</h1>
<main class="main-login-register">
    <div class="main-login-register-inner">
        <?php $form = app\core\form\Form::begin('', 'post'); ?>
        <i class="fa-solid fa-map-pin login-pin"></i>
        <div class="formGroup">
            <label>Correo electrónico</label>
            <div class="input-group">
                <input type="text" id="email" name="email" value="<?php
                if (isset($_COOKIE['email'])) {
                    $cookie->get('email');
                }
                if (isset($model->email)) {
                    echo $model->email;
                } else {
                    echo '';
                }

                ?>"><i class="fa-solid fa-pen-fancy pen"></i>
            </div>
            <p class="input_error">
                <?php if (isset($model->errors['email'])) {
                    echo ($model->errors['email'][0]);
                } ?>
            </p>
        </div>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <div class="formGroup">
            <label for="recordar">Recordar</label>
            <input type="checkbox" name="recordar" id="recordar" <?php echo isset($_COOKIE['email']) ? 'checked' : ''; ?>>
        </div>
        <input type="submit" value="Iniciar sesión">
        <span id="capsOn"><strong></strong></span>
        <script src="/resources/js/isCapsOn.js"></script> <!-- Muestra mensaje cuando las maýusc están activadas -->
        <?php app\core\form\Form::end(); ?>
    </div>

</main>