<div class="container">
    <h1>Roles</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
                <a href="roles.php?action=CREATE" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato) : ?>
                        <tr>
                            <th scope="row"><?php echo $dato['id_rol']; ?></th>
                            <td><?php echo $dato['rol']; ?></td>
                            
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="roles.php?action=UPDATE&id_rol=<?php echo $dato['id_rol']; ?>" class="btn btn-primary">Actualizar</a>
                                    <a href="roles.php?action=DELETE&id_rol=<?php echo $dato['id_rol']; ?>" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron ".$app->getCount()." Roles" : "Se encontró ".$app->getCount()." roles"?></p>
        </div>
    </div>
</div>