<?php
// Variables
$hostDB = '127.0.0.1';
$nombreDB = 'random';
$usuarioDB = 'root';
$contrasenyaDB = 'msmk1234#';
// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
// Prepara DELETE
$miConsulta = $miPDO->prepare('DELETE FROM personas WHERE codigo = ?');
// Obtiene codigo del libro a borrar
$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;

$miConsulta->execute([$codigo]);
    // Si se ejecuta correctamente, redireccionar a leer.php
    header('Location: leer.php');
?>