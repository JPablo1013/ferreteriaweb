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

            include __DIR__.'\views\reportes\productos.php';
            
            ob_start();
            if (file_exists(__DIR__.'/views/reportes/productos.php')) {
                include __DIR__.'/views/reportes/productos.php';
                //$content = ob_get_clean();
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

    
    public function marcas() {
        try {
            $this->Connect();
            $sql = 'SELECT m.marca
                    FROM marca';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            
            ob_start();
            if (file_exists(__DIR__.'/views/reportes/marcas.php')) {
                include __DIR__.'/views/reportes/marcas.php';
                $content = ob_get_clean();
                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->writeHTML($content);
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
}
$app = new Reportes();
$app->productos();
?>
