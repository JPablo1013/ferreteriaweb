<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información de el rol' : 'Agregar nuevo rol'; ?></h1>
    <form action="roles.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_rol=' . $datos['id_rol'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="rol" placeholder="rol" name="rol" value="<?php echo (isset($datos['rol'])) ? $datos['rol'] : '' ?>">
                        <label for="rol">Rol</label>
                    </div>
                </div>
                
                
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>