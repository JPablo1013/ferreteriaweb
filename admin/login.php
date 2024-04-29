<?php
include __DIR__ . '/sistema.class.php';
$app = new Sistema();
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
require_once __DIR__ . '/views/headerSinMenu.php';
switch ($action) {
    case "logout":
        $app->logout();
        $type = "success";
        $message = '<i class="fa-solid fa-circle-check"></i> Sesión cerrada correctamente';
        $app->alert($type, $message);
        break;
    case "login":
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $login = $app->login($correo, $password);
        if ($login) {
            header('Location: index.php');
        } else {
            $type = "danger";
            $message = '<i class="fa-solid fa-circle-xmark"></i> Usuario o contraseña incorrectos';
            $app->alert($type, $message);
        }
        break;
    case "forgot":
        include __DIR__.'/views/login/forgot.php';
        break;
    case "reset":
        $correo = $_POST['correo'];
        $reset = $app->reset($correo);
        if ($reset) {
            $type = "success";
            $message = '<i class="fa-solid fa-circle-check"></i> Contraseña cambiada correctamente';
            $app->alert($type, $message);
        } else {
            $type = "danger";
            $message = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado el correo especificado';
            $app->alert($type, $message);
        }
        break;
    case "recovery":
        if (isset($__GET__['token'])) {
            $token = $__GET__['token'];
            if ($app->recovery($token)) {
                if (isset($__POST__['password'])) {
                    $password = $_POST['password'];
                    if ($app->recovery($token,$password)) {
                        $type = "success";
                        $message = 'Contraseña cambiada correctamente';
                        $app->alert($type, $message);
                        include __DIR__ . '/views/login/index.php';
                    }
                }
            }
            $mensaje ='token no exist';
            $type = "danger";
            $app->alert($type, $mensaje);
            
        }
    break;
    default:
        include __DIR__ . '/views/login/index.php';
    break;
}
