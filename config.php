<?php
// Variables
$hostDB = '127.0.0.1';
$nombreDB = 'random';
$usuarioDB = 'root';
$contrasenyaDB = 'msmk1234#';
// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
?>