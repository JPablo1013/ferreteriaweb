<div class="container">
    <h1>Productos</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="index.php" class="btn btn-primary">Regresar</a>
                <a href="productos.php?action=CREATE" class="btn btn-success">Nuevo</a>
                <a href="reporte.php" target="_blank" class ="btn btn-success ">Reportes</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Fotografia</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato) : ?>
                        <tr>
                            <th scope="row"><?php echo $dato['id_producto']; ?></th>
                            <td><?php echo $dato['producto']; ?></td>
                            <td>$ <?php echo $dato['precio']; ?></td>
                            <td><?php echo $dato['marca']; ?></td>
                            <td><?php echo $dato['fotografia']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="productos.php?action=UPDATE&id_producto=<?php echo $dato['id_producto']; ?>" class="btn btn-primary">Actualizar</a>
                                    <a href="productos.php?action=DELETE&id_producto=<?php echo $dato['id_producto']; ?>" class="btn btn-danger">Eliminar</a>
                                    <form action = card.add.php?_idproducto method="get">
                                        <input type="number" name="cantidad" min = "1">
                                        <input type="hidden" name="_idproducto" value="<?php echo $dato['id_producto'];?>">
                                        <button type="submit" class="btn btn-success">Agregar</button>
                                    </form> 
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
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron " . $app->getCount() . " productos" : "Se encontró " . $app->getCount() . " producto" ?></p>
        </div>
    </div>
</div>