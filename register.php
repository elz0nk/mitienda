<?php
// Incluir el archivo de configuración
require_once "config.php";

// Iniciar una sesión
session_start();

// Comprobar si el usuario ya ha iniciado sesió
if (isset($_SESSION["codigo"]) && $_SESSION["codigo"] !== "") {
    // Redirigir al usuario a la página de bienvenida
    header("location: welcome.php");
    exit;
}

// Definir variables e inicializar con valores vacíos
$codigo = $nombre1 = $nombre2 = $apellido1 = $apellido2 = $username = $email = $password = $confirm_password = "";
$codigo_err = $nombre1_err = $nombre2_err = $apellido1_err = $apellido2_err = $username_err = $email_err = $password_err = $confirm_password_err = "";

// Procesar los datos del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar el codigo
    if (empty(trim($_POST["codigo"]))) {
        $codigo_err = "Por favor, introduzca un Numero de Identificación.";
    } else {
        // Preparar una consulta SELECT
        $sql = "SELECT codigo FROM personas WHERE codigo = ?";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(1, $param_codigo, PDO::PARAM_STR);

            // Establecer el parámetro
            $param_codigo = trim($_POST["codigo"]);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
                // Comprobar si el usuario existe
                if ($stmt->rowCount() == 1) {
                    // Mostrar un mensaje de error si el usuario ya existe
                    $codigo_err = "Este Numero de Identificación ya está en uso.";
                } else {
                    // Asignar el usuario a la variable
                    $codigo = trim($_POST["codigo"]);
                }
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }
    }

    // Validar el nombre1
    if (empty(trim($_POST["nombre1"]))) {
        $nombre1_err = "Por favor, introduzca su Nombre.";
    } else {
        // Preparar una consulta SELECT
        $sql = "SELECT codigo FROM personas WHERE nombre1 = ?";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(1, $param_nombre1, PDO::PARAM_STR);

            // Establecer el parámetro
            $param_nombre1 = trim($_POST["nombre1"]);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
            $nombre1 = trim($_POST["nombre1"]);
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }
    }
    
    // Validar el nombre2
        // Preparar una consulta SELECT
        $sql = "SELECT codigo FROM personas WHERE nombre2 = ?";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(1, $param_nombre2, PDO::PARAM_STR);

            // Establecer el parámetro
            $param_nombre2 = trim($_POST["nombre2"]);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
            $nombre2 = trim($_POST["nombre2"]);
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }

    // Validar el apellido1
    if (empty(trim($_POST["apellido1"]))) {
        $apellido1_err = "Por favor, introduzca su Primer Apellido.";
    } else {
        // Preparar una consulta SELECT
        $sql = "SELECT codigo FROM personas WHERE apellido1 = ?";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(1, $param_apellido1, PDO::PARAM_STR);

            // Establecer el parámetro
            $param_apellido1 = trim($_POST["apellido1"]);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
            $apellido1 = trim($_POST["apellido1"]);
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }
    }

    // Validar el apellido2
    if (empty(trim($_POST["apellido2"]))) {
        $apellido2_err = "Por favor, introduzca su Segundo Apellido.";
    } else {
        // Preparar una consulta SELECT
        $sql = "SELECT codigo FROM personas WHERE apellido2 = ?";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(1, $param_apellido2, PDO::PARAM_STR);

            // Establecer el parámetro
            $param_apellido2 = trim($_POST["apellido2"]);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
            $apellido2 = trim($_POST["apellido2"]);
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }
    }

    // Validar el usuario
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, introduzca un nombre de usuario.";
    } else {
        // Preparar una consulta SELECT
        $sql = "SELECT codigo FROM personas WHERE username = ?";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(1, $param_username, PDO::PARAM_STR);

            // Establecer el parámetro
            $param_username = trim($_POST["username"]);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
                // Comprobar si el usuario existe
                if ($stmt->rowCount() == 1) {
                    // Mostrar un mensaje de error si el usuario ya existe
                    $username_err = "Este nombre de usuario ya está en uso.";
                } else {
                    // Asignar el usuario a la variable
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }
    }


    // Validar el email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, introduzca un email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Por favor, introduzca un email válido.";
    } else {
        // Preparar una consulta SELECT
        $sql = "SELECT codigo FROM personas WHERE email = ?";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(1, $param_email, PDO::PARAM_STR);

            // Establecer el parámetro
            $param_email = trim($_POST["email"]);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
                // Comprobar si el email existe
                if ($stmt->rowCount() == 1) {
                    // Mostrar un mensaje de error si el email ya está en uso
                    $email_err = "Este email ya está en uso.";
                } else {
                    // Asignar el email a la variable
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }
    }

    // Validar la contraseña
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduzca una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Asignar la contraseña a la variable
        $password = trim($_POST["password"]);
    }

    // Validar la confirmación de la contraseña
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirme la contraseña.";
    } else {
        // Asignar la confirmación de la contraseña a la variable
        $confirm_password = trim($_POST["confirm_password"]);
        // Comprobar si la contraseña y la confirmación coinciden
        if ($password != $confirm_password) {
            // Mostrar un mensaje de error si no coinciden
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Comprobar los errores de entrada antes de insertar en la base de datos
    if (empty($codigo_err) && empty($nombre1_err) && empty($nombre2_err) && empty($apellido1_err) && empty($apellido2_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Preparar una consulta INSERT
        $sql = "INSERT INTO personas (codigo, nombre1, nombre2, apellido1, apellido2, username, email, password) VALUES (:codigo, :nombre1, :nombre2, :apellido1, :apellido2, :username, :email, :password)";

        if ($stmt = $miPDO->prepare($sql)) {
            // Vincular variables a la consulta preparada como parámetros
            $stmt->bindParam(":codigo", $param_codigo, PDO::PARAM_STR);
            $stmt->bindParam(":nombre1", $param_nombre1, PDO::PARAM_STR);
            $stmt->bindParam(":nombre2", $param_nombre2, PDO::PARAM_STR);
            $stmt->bindParam(":apellido1", $param_apellido1, PDO::PARAM_STR);
            $stmt->bindParam(":apellido2", $param_apellido2, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Establecer los parámetros
            $param_codigo = $codigo;
            $param_nombre1 = $nombre1;
            $param_nombre2 = $nombre2;
            $param_apellido1 = $apellido1;
            $param_apellido2 = $apellido2;
            $param_username = $username;
            $param_email = $email;
            // Crear una contraseña con hash
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Intentar ejecutar la consulta preparada
            if ($stmt->execute()) {
                // Redirigir al usuario a la página de login
                header("location: login.php");
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt = null;
        }
    }

    // Cerrar la conexión
    $miPDO = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse - CRUD PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Estilo general del cuerpo de la página */
body {
    font-family:monospace;
    background-color: #333333;
    
}

/* Estilo del enlace para volver a la página principal */
a {
    display: block;
    width: 100px;
    margin: 10px auto;
    text-align: center;
    text-decoration: none;
    color: white;
    background-color: #333333;
    padding: 5px;
    border-radius: 5px;
}

/* Estilo del contenedor principal del formulario */
.wrapper {
    width: 500px;
    margin: 20px auto;
    background-color: #f0f0f0;
    padding: 20px;
    box-shadow: 0 0 30px rgba(0,0,0,1);
}

/* Estilo del título del formulario */
h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2em;
}

/* Estilo del párrafo de instrucciones */
p {
    text-align: center;
    margin-bottom: 10px;
    font-family:monospace;
}

/* Estilo de los elementos del formulario */
.form-group {
    margin-bottom: 10px;
    margin-right:20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"], input[type="email"], input[type="password"] {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px solid #cccccc;
    padding-left:-10px;
}

.help-block {
    color: red;
    font-style: italic;
}

input[type="submit"] {
    display: block;
    width: 150px;
    margin: 10px auto;
    color: white;
    background-color: #333333;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}


/* Estilo de los elementos con la clase has-error */
.has-error input {
    border-color: red;
}
    </style>
</head>
<body>
    <a href="index.html">Volver</a>
    <div class="wrapper">
        <h2>Registrarse</h2>
        <p>Por favor, rellene este formulario para crear una cuenta.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($apellido11_err)) ? 'has-error' : ''; ?>">
                    <label>Numero de Identificación</label>
                    <input type="text" name="codigo" class="form-control" value="<?php echo $codigo; ?>">
                    <span class="help-block"><?php echo $codigo_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($nombre1_err)) ? 'has-error' : ''; ?>">
                    <label>Nombre</label>
                    <input type="text" name="nombre1" class="form-control" value="<?php echo $nombre1; ?>">
                    <span class="help-block"><?php echo $nombre1_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($nombre2_err)) ? 'has-error' : ''; ?>">
                <label>Segundo Nombre</label>
                <input type="text" name="nombre2" class="form-control" value="<?php echo $nombre2; ?>">
                <span class="help-block"><?php echo $nombre2_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($apellido11_err)) ? 'has-error' : ''; ?>">
                <label>Primer Apellido</label>
                <input type="text" name="apellido1" class="form-control" value="<?php echo $apellido1; ?>">
                <span class="help-block"><?php echo $apellido1_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($apellido2_err)) ? 'has-error' : ''; ?>">
                <label>Segundo Apellido</label>
                <input type="text" name="apellido2" class="form-control" value="<?php echo $apellido2; ?>">
                <span class="help-block"><?php echo $apellido2_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Registrarse">
            </div>
            <a href="login.php">¿Ya tienes una cuenta?</a>
        </form>
    </div>
</body>
</html>