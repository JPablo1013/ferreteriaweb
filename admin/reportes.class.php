<?php
include __DIR__. '\sistema.class.php';
include __DIR__. '..\..\vendor\autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Reportes extends Sistema {
    function productos() {
        try {
            $this->connect();
            $sql=("SELECT p.id_producto AS id_producto, m.id_marca AS id_marca, m.marca AS marca, p.producto AS producto,p.precio AS precio 
            FROM producto p 
            LEFT JOIN marca m ON p.id_marca = m.id_marca 
            ORDER BY 2,3;");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos=array();
            $datos = $stmt->fetchAll();
            //$this->datos = $stmt->fetchAll();

            include __DIR__.'\views\reportes\productos.php';
            
            ob_start();
            if (file_exists(__DIR__.'/views/reportes/productos.php')) {
                include __DIR__.'/views/reportes/productos.php';
                //$contenido = ob_get_clean();
                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->writeHTML($contenido);
                $html2pdf->output('productos.pdf');
            } 
            else {
                throw new Exception('Archivo de vista productos.php no encontrado.');
            }
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        } 
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    
    function marcas() {
        try {
            $this->Connect();
            $sql = 'SELECT marca
                    FROM marca';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            $this->datos = $stmt->fetchAll();

            include __DIR__.'\views\reportes\marcas.php';
            
            ob_start();
            if (file_exists(__DIR__.'/views/reportes/marcas.php')) {
                include __DIR__.'/views/reportes/marcas.php';
                //$contenido = ob_get_clean();
                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->writeHTML($contenido);
                $html2pdf->output('marcas.pdf');
            } else {
                throw new Exception('Archivo de vista marcas.php no encontrado.');
            }
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function clientes() {
        try {
            $this->Connect();
            $sql = 'SELECT c.primer_apellido, c.segundo_apellido, c.nombre as NombreCliente,
            c.rfc as RFC, u.correo as Correo
                    FROM cliente c join usuario u on c.id_usuario = c.id_usuario';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            
            ob_start();
            if (file_exists(__DIR__.'/views/reportes/clientes.php')) {
                include __DIR__.'/views/reportes/clientes.php';
                $contenido = ob_get_clean();
                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->writeHTML($contenido);
                $html2pdf->output('clientes.pdf');
            } else {
                throw new Exception('Archivo de vista clientes.php no encontrado.');
            }
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function empleados() {
        try {
            $this->Connect();
            $sql = 'SELECT primer_apellido, segundo_apellido, nombre as NombreEmpleado,
            rfc as RFC, curp as CURP
                    FROM empleado';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
             //$this->datos = $stmt->fetchAll();

            include __DIR__.'/views/reportes/empleados.php';
            
            ob_start();
            if (file_exists(__DIR__.'/views/reportes/empleados.php')) {
                include __DIR__.'/views/reportes/empleados.php';
                //$contenido = ob_get_clean();
                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->writeHTML($contenido);
                $html2pdf->output('empleados.pdf');
            } else {
                throw new Exception('Archivo de vista empleados.php no encontrado.');
            }
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}

$app = new Reportes();
$app->productos();
$app->marcas();
$app->clientes();
$app->empleados();
?>
