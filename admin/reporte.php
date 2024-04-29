<?php
include __DIR__."/reportes.class.php";
$app = new Reportes();
//$app->checkRole('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
switch ($action) {
    case 'productos':
        $app->productos();
        break;
    default:
        include __DIR__ . '\\views\\header.php';
        break;
}        
?>
