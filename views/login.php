<?php
use app\core\Application;

$this->title = 'Login';
?>
<h1 class="tituloPagina">Iniciar Sesión</h1>
<main class="main-login-register">
    <div class="main-login-register-inner">
        <?php $form = app\core\form\Form::begin('', 'post'); ?>
        <i class="fa-solid fa-map-pin login-pin"></i>
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <label for="recordar">Recordar</label>
        <input type="checkbox" name="recordar" id="recordar" <?php echo isset($_COOKIE['test']) ? 'checked' : ''; ?>>
        <input type="text" name="prueba" id="prueba"
            value="<?php echo isset($_COOKIE['test']) ? $cookie->get('test') : ''; ?> ">
        <input type="submit" value="Iniciar sesión">
        <?php app\core\form\Form::end(); ?>
    </div>

</main>
<?php
echo '<pre>';
var_dump($body);
echo '</pre>';
?>