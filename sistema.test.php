<?php
class Sistema
{
    var $conn;
    var $count = 0;
    function connect()
    {
        $servername = "127.0.0.1";
        $username = "ferreteria";
        $password = "@admin";
        $mydb = "ferreteria";
        $this->conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
    }

    function setCount($count)
    {
        $this->count = $count;
    }

    function getCount()
    {
        return $this->count;
    }

    function upload($carpeta)
    {
        $alert = array();
        if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] === UPLOAD_ERR_OK) {
            $permitidos = array('image/jpeg', 'image/png');
            if (in_array($_FILES['fotografia']['type'], $permitidos)) {
                if ($_FILES['fotografia']['size'] <= 1024000) {
                    $nombre_archivo = md5(uniqid(rand(), true)) . '.' . pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);
                    $ruta = '..\\uploads\\' . $carpeta . '\\' . $nombre_archivo;
                    if (!file_exists($ruta)) {
                        if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $ruta)) {
                            chmod($ruta, 0777);
                            return $nombre_archivo;
                        } else {
                            // Manejar error al mover el archivo
                            $alert = [
                                'type' => 'danger',
                                'message' => 'Error al mover el archivo.'
                            ];
                            include 'views/alert.php';
                            return false;
                        }
                    } else {
                        // Manejar archivo duplicado
                        $alert = [
                            'type' => 'danger',
                            'message' => 'Ya existe un archivo con ese nombre.'
                        ];
                        include 'views/alert.php';
                        return false;
                    }
                } else {
                    // Manejar archivo demasiado grande
                    $alert = [
                        'type' => 'danger',
                        'message' => 'El archivo es demasiado grande.'
                    ];
                    include 'views/alert.php';
                    return false;
                }
            } else {
                // Manejar tipo de archivo no permitido
                $alert = [
                    'type' => 'danger',
                    'message' => 'Tipo de archivo no permitido.'
                ];
                include 'views/alert.php';
                return false;
            }
        } else {
            // Manejar error de subida de archivo
            $alert = [
                'type' => 'danger',
                'message' => 'Error al subir el archivo.'
            ];
            include 'views/alert.php';
            return false;
        }
    }
}
