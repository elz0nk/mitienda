<?php
// Variables
$hostDB = '127.0.0.1';
$nombreDB = 'random';
$usuarioDB = 'root';
$contrasenyaDB = 'msmk1234#';
// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
// Prepara SELECT
$miConsulta = $miPDO->prepare('SELECT * FROM personas;');
// Ejecuta consulta
$miConsulta->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color:steelblue;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td {
            border: 3px solid orange;
            text-align: center;
            padding: 0.7rem;
        }
        .button {
            border-radius: .5rem;
            color:orangered;
            background-color: orange;
            padding: 0.7rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <p><a class="button" href="indexregistrado.html">Volver</a></p>
    <p><a class="button" href="nuevo.php">Nuevo</a></p>
    <table>

        <tr>
            <th>Codigo</th>
            <th>Primer Nombre</th>
            <th>Segundo Nombre</th>
            <th>Primer apellido</th>
            <th>Segundo apellido</th>
            <th>Nombre de Usuario</th>
            <th>Contraseña</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </tr>
    <?php foreach ($miConsulta as $clave => $valor): ?>
        <tr>
            <td><?= $valor['codigo']; ?></td>
            <td><?= $valor['nombre1']; ?></td>
            <td><?= $valor['nombre2']; ?></td>
            <td><?= $valor['apellido1']; ?></td>
            <td><?= $valor['apellido2']; ?></td>
            <td><?= $valor['username']; ?></td>
            <td><?= $valor['password']; ?></td>
            <td><?= $valor['email']; ?></td>

            <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
            <td><a class="button" href="modificar.php?codigo=<?= $valor['codigo'] ?>">Modificar</a></td>
            <td><a class="button" href="borrar.php?codigo=<?= $valor['codigo'] ?>">Borrar</a></td> 
        </tr>
    <?php endforeach; ?>
    </table>
    <p><a class="button" href="register.php">Registrar</a></p>
</body>
</html>