<?php
// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
    $nombre1 = isset($_REQUEST['nombre1']) ? $_REQUEST['nombre1'] : null;
    $nombre2 = isset($_REQUEST['nombre2']) ? $_REQUEST['nombre2'] : null;
    $apellido1 = isset($_REQUEST['apellido1']) ? $_REQUEST['apellido1'] : null;
    $apellido2 = isset($_REQUEST['apellido2']) ? $_REQUEST['apellido2'] : null;
    $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

    $hostDB = '127.0.0.1';
    $nombreDB = 'random';
    $usuarioDB = 'root';
    $contrasenyaDB = 'msmk1234#';
    // Conecta con base de datos
    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO personas (codigo, nombre1, nombre2, apellido1, apellido2, username, password) VALUES (:codigo, :nombre1, :nombre2, :apellido1, :apellido2, :username, :password)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array (
            ':codigo' => $codigo, 
            ':nombre1' => $nombre1,
            ':nombre2' => $nombre2, 
            ':apellido1' => $apellido1, 
            ':apellido2' => $apellido2,
            ':username' => $username,
            ':password' => $password,
        )
    );
    // Redireccionamos a Leer
    header('Location: leer.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear - CRUD PHP</title>
</head>
<body>
    <form action="" method="post">
        <p>
            <label for="codigo">Codigo</label>
            <input id="codigo" type="text" name="codigo">
        </p>
        <p>
            <label for="nombre1">Nombre</label>
            <input id="nombre1" type="text" name="nombre1">
        </p>
        <p>
            <label for="nombre2">Segundo Nombre</label>
            <input id="nombre2" type="text" name="nombre2">
        </p>
        <p>
            <label for="apellido1">Primer Apellido</label>
            <input id="apellido1" type="text" name="apellido1">
        </p>
        <p>
            <label for="apellido2">Segundo Apellido</label>
            <input id="apellido2" type="text" name="apellido2">
        </p>
        <p>
            <label for="username">Nombre de Usuario</label>
            <input id="username" type="text" name="username">
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input id="password" type="text" name="password">
        </p>
        <p>
            <input type="submit" value="Guardar">
        </p>
    </form>
</body>
</html>