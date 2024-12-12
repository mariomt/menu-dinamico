<nav class="first-nav">
    <a>Formulario</a>
</nav>

<form action="/guarda" method="POST" class="form-container">
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
            <input type="text" id="nombre" name="nombre">
        </div>
        <div class="lbl">
            <label for="descripcion">Descripción</label>
        </div>
        <div>
            <textarea id="descripcion" name="descripcion"></textarea>
        </div>
    </div>
    <div class="form-controls">
        <a href="/Menus" class="btn btn-withe btn-md">Cancelar</a>
        <button type="submit" class="btn btn-primary btn-md">Guardar</button>
    </div>
</form>