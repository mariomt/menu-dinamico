<nav class="first-nav">
    <a>Eliminar Menú</a>
</nav>

<?php require VIEWS_PATH.'shared/feedback.php' ?>

<h2 class="text-center">¿Seguro que desea eliminar el siguiente Menú?</h2>

<form action="<?= getURL($action); ?>" method="POST" class="form-container">
    <input type="text" name="id" hidden>
    <div class="form">
        <div class="lbl">
            <label for="padre">Menú Padre</label>
        </div>
        <div>
            <?php
                if($select && is_array($select)) {
                    for ($i=0; $i < sizeof($select) ; $i++) {
                        if ($select[$i]['id'] == $data['parent_id']) {
            ?>
                            <input type="text" value="<?= $select[$i]['name']?>">
            <?php
                            break;
                        }
                    }
                }
            ?>
        </div>
        <div class="lbl">
            <label for="nombre">Nombre</label>
        </div>
        <div>
            <input type="text" id="nombre" name="nombre" value="<?= (isset($data['name'])? $data['name']:'')?>" readonly>
        </div>
        <div class="lbl">
            <label for="descripcion">Descripción</label>
        </div>
        <div>
            <textarea id="descripcion" name="descripcion" readonly><?=(isset($data['description'])? $data['description']:'')?></textarea>
        </div>
    </div>
    <div class="form-controls">
        <a href="<?= getURL('/Menus'); ?>" class="btn btn-withe btn-md">Cancelar</a>
        <button type="submit" class="btn btn-danger btn-md">Eliminar</button>
    </div>
</form>