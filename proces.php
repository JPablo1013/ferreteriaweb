<?php 
$datos = $_POST;
require_once __DIR__ . '/admin/sistema.class.php';
$app=new Sistema();
if ($app->register($datos)) {
    $type = "success";
    $message = 'Usuario registrado correctamente';
    $app->alert($type, $message);
    # code...
}else{
    $type = "danger";
    $message = 'No se pudo registrar el usuario';
    $app->alert($type, $message);
}

?>