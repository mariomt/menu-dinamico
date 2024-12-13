<nav class="first-nav">
    <a>Eliminar Menú</a>
</nav>

<?php require VIEWS_PATH.'shared/feedback.php' ?>

<h2 class="text-center">¿Seguro que desea eliminar el siguiente Menú?</h2>

<form action="" class="form-container">
    <input type="text" name="id" hidden>
    <div class="form">
        <div class="lbl">
            <label for="padre">Menú Padre</label>
        </div>
        <div>
            <select name="padre" id="padre">
                <option value="0" disabled selected>Seleciona una opción</option>
            </select>
        </div>
        <div class="lbl">
            <label for="nombre">Nombre</label>
        </div>
        <div>
            <input type="text" id="nombre" name="nombre" value="nombre de menú" readonly>
        </div>
        <div class="lbl">
            <label for="descripcion">Descripción</label>
        </div>
        <div>
            <textarea id="descripcion" name="descripcion" readonly>la descripción
            </textarea>
        </div>
    </div>
    <div class="form-controls">
        <a href="/Menus" class="btn btn-withe btn-md">Cancelar</a>
        <button type="submit" class="btn btn-danger btn-md">Eliminar</button>
    </div>
</form>