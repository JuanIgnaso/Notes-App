<?php
use app\core\Application;

$this->title = 'Editar Nota';
?>
<h1 class="tituloPagina">Editar mi nota</h1>

<form action="" method="post" id="editForm">
    <input type="hidden" name="id" value="<?php echo $model->id; ?>">
    <div class="group">
        <label>
            Titulo
            <input type="text" name="titulo" id="titulo"
                value="<?php echo isset($model->titulo) ? $model->titulo : ''; ?>">
        </label>
        <p class="input_error">
            <?php echo isset($model->errors['titulo']) ? $model->getFirstError('titulo') : ''; ?>
        </p>
    </div>
    <div class="group">
        <label>
            Descripción
            <textarea name="descripcion" id="descripcion" cols="30"
                rows="10"><?php echo isset($model->descripcion) ? $model->descripcion : ''; ?></textarea>
        </label>
        <p class="input_error">
            <?php echo isset($model->errors['descripcion']) ? $model->getFirstError('descripcion') : ''; ?>
        </p>
    </div>

    <label>
        Estado
        <select name="estado" id="estado">
            <option value="">Selecciona Una</option>
            <?php
            foreach ($estados as $estado) {
                ?>
                <option value="<?php echo $estado['id']; ?>" <?php echo $estado['id'] == $model->estado ? 'selected' : ''; ?>>
                    <?php echo $estado['estado']; ?>
                </option>
                <?php
            }
            ?>
        </select>
        <p class="input_error">
            <?php echo isset($model->errors['estado']) ? $model->getFirstError('estado') : ''; ?>
        </p>
    </label>
    <label id="markImportant">
        importante
        <input type="checkbox" name="importante" id="importante" value="1" <?php echo $model->importante == '1' ? 'checked' : ''; ?>>
        <span class="checkmark"></span>
    </label>
    <footer>
        <button type="button"><a href="/misNotas">Cancelar</a></button>
        <input type="submit" value="Aplicar Cambios">
    </footer>


    <div class="pencil_box">
        <div id="pencil_wrapper" class="green">
            <div class="eraser"></div>
            <div class="sleeve"></div>
            <div class="shaft"></div>
            <div class="point"></div>
            <div class="lead"></div>
        </div>
    </div>

</form>