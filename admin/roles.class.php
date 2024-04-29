<?php
require_once __DIR__ . '\\sistema.class.php';
class Rol extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_rol, rol FROM rol;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_rol)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_rol, rol FROM rol WHERE id_rol = :id_rol;");
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = array();
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }

    function insert($datos)
    {
        $this->connect();
        
        if ($this->validateRol($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO rol(rol) VALUES (:rol);");
            $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
    
       
    }

    function delete($id_rol)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM rol WHERE id_rol = :id_rol;");
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    function update($id_rol, $datos)
    {
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE rol SET rol = :rol WHERE id_rol = :id_rol;");
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function validateRol($datos)
    {
        if (empty($datos["rol"])) {
            return false;
        }
        return true;
    }
}
