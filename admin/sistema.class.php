<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require __DIR__ . '\\config.php';
class Sistema extends Config
{
    var $conn;
    var $count = 0;
    function connect()
    {
        $this->conn = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function query($sql)
    {
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $datos = array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        return $datos;
    }

    function getRol($correo){
        $sql = "SELECT r.rol FROM usuario u
        JOIN usuario_rol ur on u.id_usuario = ur.id_usuario
        JOIN rol r on ur.id_rol = r.id_rol
        WHERE u.correo = '" . $correo . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['rol']);
        return $info;
    }
    function getPrivilegio($correo){
        $sql = "SELECT p.privilegio FROM usuario u
        JOIN usuario_rol ur on u.id_usuario = ur.id_usuario
        JOIN rol_privilegio rp on ur.id_rol = rp.id_rol
        JOIN privilegio p on rp.id_privilegio = p.id_privilegio
        WHERE u.correo = '" . $correo . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['privilegio']);
        return $info;
    }
    function login($correo, $password){
        $password = md5($password);
        $this->connect();
        $sql = "SELECT * FROM usuario
        WHERE correo = :correo AND password = :password;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $datos = array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $roles = array();
            $roles = $this->getRol($correo);
            $privilegios = array();
            $privilegios = $this->getPrivilegio($correo);
            $_SESSION['validado'] = true;
            $_SESSION['correo'] = $correo;
            $_SESSION['roles'] = $roles;
            $_SESSION['privilegios'] = $privilegios;
            return $datos[0];
        } else {
            $this->logout();
        }
        return false;
    }
    function logout(){
        unset($_SESSION);
        session_destroy();
    }

    function checkRol($rol, $kill = false){
        if (isset($_SESSION['roles'])) {
            if ($_SESSION['validado']) {
                if (in_array($rol, $_SESSION['roles'])) {
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alert('danger', 'Permiso denegado');
            die;
        }
        return false;
    }

    function checkPrivilegio($privilegio, $kill = false){
        if (isset($_SESSION['privilegios'])) {
            if ($_SESSION['validado']) {
                if (in_array($privilegio, $_SESSION['privilegios'])) {
                    return true;
                }
            }
        }
        if ($kill) {
            $this->logout();
            $this->alert('danger', 'Permiso denegado');
            die;
        }
        return false;
    }

    function alert($type, $message){
        $alert = array();
        $alert['type'] = $type;
        $alert['message'] = $message;
        include __DIR__ . '/views/alert.php';
    }

    function setCount($count){
        $this->count = $count;
    }

    function getCount(){
        return $this->count;
    }

    function upload($carpeta) {
        if (in_array($_FILES['fotografia']['type'], $this->getImageType())) {
            if ($_FILES['fotografia']['size'] <= $this->getImageSize()) {
                $n = rand(1, 1000000);
                $nombre_archivo = $n . $_FILES['fotografia']['size'] . $_FILES['fotografia']['name'];
                $nombre_archivo = md5($nombre_archivo);
                $extension = pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);
                $nombre_archivo = $nombre_archivo . "." . $extension;
                $ruta = '..\\uploads\\' . $carpeta . '\\' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    move_uploaded_file($_FILES['fotografia']['tmp_name'], $ruta);
                    return $nombre_archivo;
                }
            }
        }
        return false;
    }
    function reset($correo){
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->connect();
            $sql = "Select * FROM usuario WHERE correo = :correo;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $datos = array();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if (isset($datos[0])) {
                $token1= md5($correo.'ALeaToRio52');
                $token2= md5($correo.date('Y-m-d H:i:s').rand(1,1000000));
                $token= $token1.$token2;
                $sql = "UPDATE usuario SET token = :token WHERE correo = :correo;";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt->execute();
                $destinatario = $correo;
                $nombre_persona = "Juanito Bananas";
                $asunto = "Recuperación de contraseña";
                $mensaje = "Hola " . $nombre_persona . ", se ha solicitado un cambio de contraseña para tu cuenta <br/>" .
           "Para ello haz click en el siguiente enlace <br/>" .
           "<a href='http://localhost/ferreteria/admin/login.php?action=recovery&token=" . $token . "'>Recuperar contraseña</a>" .
           "<br/>" .
           "Gracias por preferirnos";

                if ($this->sendMail($destinatario,$nombre_persona,$asunto,$mensaje)) {
                    return true;
                }else {
                    return false;
                }
                return true;
            }
        }

    }
    function sendMail($destinatario,$nombre_persona,$asunto,$mensaje){
        require '../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        //Enable SMTP debugging
        //SMTP::DEBUG_OFF = off (for production use)
        //SMTP::DEBUG_CLIENT = client messages
        //SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = '20030373@itcelaya.edu.mx';
        $mail->Password = 'epybnbyjnfkngcxm';
        $mail->setFrom('20030373@itcelaya.edu.mx', 'Ana Karen Vargas Hernandez');
        $mail->addAddress($destinatario, $nombre_persona);
        $mail->Subject = $asunto;
        $mail->msgHTML($mensaje);
        $mail->addAttachment('images/phpmailer_mini.png');
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }

    }
    function recovery($token,$password=null){
        $this->connect();
        if (strlen($token)==64) {
            $sql = "Select * FROM usuario WHERE token = :token;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
            $datos = array();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if (isset($datos[0])) {
                if (!is_null ($password )) {
                    $password = md5($_POST['password']);
                    $sql = "UPDATE usuario SET password = :password, token=null WHERE correo = :correo;";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt ->execute();
                }return true;
            }
        }
    }
    function register($datos){
        if(!filter_var($datos['correo'],FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this->connect();

        try{
            $this->conn->beginTransaction();
            $sql = 'select * from usuario where correo=:correo';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetchAll();
            if(isset($usuario[0])){
                $this->conn->rollBack();
                return false;
            }
            $sql = 'insert into usuario (correo,password) values (:correo,:password)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $password = $datos['password'];
            $password = md5($password);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $sql = 'select * from usuario where correo = :correo';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetchAll();
            if($usuario[0]){
                $id_usuario = $usuario[0]['id_usuario'];
                $sql = 'insert into usuario_rol (id_usuario,id_rol) values (:id_usuario,22)';
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $sql = 'insert into cliente (nombre,primer_apellido,segundo_apellido,rfc,id_usuario) values (:nombre,:primer_apellido,:segundo_apellido,:rfc,:id_usuario)';
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $sql = 'select * from cliente c join usuario u on u.id_usuario = c.id_usuario where c.id_usuario = :id_usuario;';
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $info = $stmt->fetchAll();
                if(isset($info[0])){
                    $this->conn->commit();
                    return true;
                }
                $this->conn->rollBack();
                return false;
            }else{
                $this->conn->rollBack();
                return false;        
            }
        }catch(PDOException $e){
            $this->conn->rollBack();
            return false;
        }
    }

}
