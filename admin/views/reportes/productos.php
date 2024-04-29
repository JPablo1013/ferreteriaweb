<?php
$contenido = "
<h1><img src=\"../uploads/productos/default.png\" height=\"25px\" width=\"25px\">
Listado de productos</h1>
<br/><br/>
<style>
    h1{
        font-weight: 300;
        color: #00205b;
        text-transform: uppercase;
        margin-bottom: 48px;
        font-size: 32px;
        margin-top: 0;
        text-align: center;
    }
    table {
        margin: top 20%;
        width: 100%; /* Ocupa el ancho completo de la página */
        border-collapse: collapse; /* Elimina el espacio entre bordes */
        font-family: Arial, sans-serif; /* Estilo de fuente más moderno */
        font-size: 15px; /* Tamaño de la fuente */
    }
    th, td {
        border: 0px solid black; /* Añade bordes a las celdas */
        padding: 25px; /* Espaciado interno para el texto en las celdas */
        text-align: center; /* Alinea el texto a la izquierda */
    }
    th {
        background-color: #f3f3f3; /* Color de fondo para los encabezados */
        font-weight: bold; /* Hace el texto en negrita */
        font-size: 20px; /*
    }
    tr:nth-child(even) {
        background-color: #f9f9f9; /* Color de fondo para filas pares */
    }
    tr:hover {
        background-color: #ddd; /* Color de fondo al pasar el mouse */
    }
</style>
<table>
    <thead> 
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Producto</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>"; // Inicio del contenido del cuerpo de la tabla

foreach ($datos as $dato) {
    $contenido .= "
        <tr>
            <td>" . $dato['id_producto'] . "</td>
            <td>" . $dato['marca'] . "</td>
            <td>" . $dato['producto'] . "</td>
            <td>" . $dato['precio'] . "</td>
        </tr>";
}

$contenido .= "
    </tbody>
</table>"; // Finaliza el contenido HTML
?>