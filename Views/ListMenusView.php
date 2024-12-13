<nav class="first-nav">
    <a href="/menu">Menú</a>
    <a href="/alta" class="btn bg-success">+ Nuevo</a>
</nav>

<?php require VIEWS_PATH.'shared/feedback.php' ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Menú Padre</th>
                <th>Descripción</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($data && is_array($data)) {
                    for ($i=0; $i < sizeof($data) ; $i++) {
            ?>
            <tr>
                <td><?= $data[$i]['id']?></td>
                <td><?= $data[$i]['name']?></td>
                <td><?= $data[$i]['parent_name'] ?></td>
                <td><?= $data[$i]['description']?></td>
                <td class="actions">
                    <a href="/editar/<?= $data[$i]['id']?>" class="btn bg-warning"><span class="action-button-span"><img src="/public/imgs/pencil-fill.svg" width="14"> Editar</span></a>
                    <a href="/elimina/<?= $data[$i]['id']?>" class="btn bg-danger"><span class="action-button-span"><img src="/public/imgs/trash3-fill.svg" width="14"> Eliminar</span></a>
                </td>
            </tr>
            <?php
                    }
                }
            ?>

        </tbody>
    </table>
</div>