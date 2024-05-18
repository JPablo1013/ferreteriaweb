<?php
include __DIR__."/reportes.class.php";
$app = new Reportes();
//$app->checkRole('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
switch ($action) {
    case 'productos':
        $app->productos();
        break;

    case 'marcas':
        $app->marcas();
    break;

    case 'empleados':
        $app->empleados();
    break;

    case 'clientes':
        $app->clientes();
    break;
    
    default:
        include __DIR__ . '\\views\\header.php';
        break;
}        
?>
