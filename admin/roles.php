<?php
include __DIR__ . '\\roles.class.php';
$app = new Rol();
include __DIR__ . '\\views\\header.php';
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_rol = (isset($_GET['id_rol'])) ? $_GET['id_rol'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case "DELETE":
        if ($app->delete($id_rol)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Rol eliminada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar la rol';
        }
        $datos = $app->getAll();
        include __DIR__ . '\\views\\alert.php';
        include __DIR__ . '\\views\\roles\\index.php';
        break;
    case "UPDATE":
        $datos = $app->getOne($id_rol);
        if (isset($datos['id_rol'])) {
            include __DIR__ . '\\views\\roles\\form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado el rol especificada';
            $datos = $app->getAll();
            include __DIR__ . '\\views\\alert.php';
            include __DIR__ . '\\views\\roles\\index.php';
        }
        break;
    case "CREATE":
        include __DIR__ . '\\views\\roles\\form.php';
        break;
    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> rol registrada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar el rol';
        }
        $datos = $app->getAll();
        include __DIR__ . '\\views\\alert.php';
        include __DIR__ . '\\views\\roles\\index.php';
        break;
    case "EDIT":
        $datos = $_POST;
        if ($app->update($id_rol, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> rol actualizada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar la rol';
        }
        $datos = $app->getAll();
        include __DIR__ . '\\views\\alert.php';
        include __DIR__ . '\\views\\roles\\index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '\\views\\roles\\index.php';
        break;
}
include __DIR__ . '\\views\\footer.php';
