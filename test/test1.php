<?php 
session_start(); 
$_SESSION['x'] = 'Hola mundo';
print_r($_SESSION);
?>