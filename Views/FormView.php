<nav class="first-nav">
    <a>Formulario</a>
</nav>
<?php require VIEWS_PATH . 'shared/feedback.php' ?>
<form action="<?= getURL($action); ?>" method="POST" class="form-container">
    <input type="text" name="id" hidden>
    <div class="form">
        <div class="lbl">
            <label for="padre">Menú Padre</label>
        </div>
        <div>
            <select name="padre" id="padre" value="<?=  $data->parent_id ?? '' ?>">
                <option value="0" disabled <?= (isset($data->parent_id)) ? '' : 'selected'?>>Seleciona una opción</option>
            <?php
            if ($select && is_array($select)) {
                for ($i = 0; $i < sizeof($select); $i++) {
                    if(!isset($data->id) || $data->id != $select[$i]->id) {
                    ?>
                    <option value="<?= $select[$i]->id ?>" <?= (isset($data->parent_id) && $select[$i]->id == $data->parent_id) ? 'selected' : ''?>><?=$select[$i]->name?></option>
                        <?php
                    }
                }
            }
            ?>
            </select>
        </div>
        <div class="lbl">
            <label for="nombre">Nombre</label>
        </div>
        <div>
            <input type="text" id="nombre" name="nombre" value="<?= $data->name ?? '' ?>">
        </div>
        <div class="lbl">
            <label for="descripcion">Descripción</label>
        </div>
        <div>
            <textarea id="descripcion" name="descripcion"><?= $data->description ?? '' ?></textarea>
        </div>
    </div>
    <div class="form-controls">
        <a href="<?= getURL('/Menus'); ?>" class="btn btn-withe btn-md">Cancelar</a>
        <button type="submit" class="btn btn-primary btn-md">Guardar</button>
    </div>
</form>