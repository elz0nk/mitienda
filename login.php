<?php
// Crear conexión
$link = new mysqli("127.0.0.1", "root", "msmk1234#", "random", 3306);

// Verificar conexión
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
// Iniciar una sesión
session_start();

// Comprobar si el usuario ya ha iniciado sesión
if (isset($_SESSION["codigo"]) && $_SESSION["codigo"] !== "") {
    // Redirigir al usuario a la página de bienvenida
    header("location: welcome.html");
    exit;
}

// Definir variables e inicializar con valores vacíos
$username = $password = "";
$username_err = $password_err = "";

// Procesar los datos del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar el usuario
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, introduzca un nombre de usuario.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validar la contraseña
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduzca una contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar las credenciales
    if (empty($username_err) && empty($password_err)) {
        // Preparar una consulta SELECT
        $sql = "SELECT codigo, username, password FROM personas WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Vincular variables a la consulta preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Establecer el parámetro
            $param_username = $username;

            // Intentar ejecutar la consulta preparada
            if (mysqli_stmt_execute($stmt)) {
                // Almacenar el resultado
                mysqli_stmt_store_result($stmt);

                // Comprobar si el usuario existe, si es así, verificar la contraseña
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Vincular las variables de resultado
                    mysqli_stmt_bind_result($stmt, $codigo, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // La contraseña es correcta, iniciar una nueva sesión
                            session_start();

                            // Almacenar los datos en variables de sesión
                            $_SESSION["codigo"] = $codigo;
                            $_SESSION["username"] = $username;

                            // Redirigir al usuario a la página de bienvenida
                            header("location: welcome.html");
                        } else {
                            // Mostrar un mensaje de error si la contraseña no es válida
                            $password_err = "La contraseña que has introducido no es válida.";
                        }
                    }
                } else {
                    // Mostrar un mensaje de error si el usuario no existe
                    $username_err = "No se ha encontrado ninguna cuenta con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            mysqli_stmt_close($stmt);
        }
    }

    // Cerrar la conexión
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - CRUD PHP</title>
    <style>
        /* Estilo general del cuerpo de la página */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
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
    width: 360px; /* Cambia el ancho del contenedor a 360px para que coincida con el HTML */
    margin: 20px auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Estilo del título del formulario */
h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Estilo del párrafo de instrucciones */
p {
    text-align: center;
    margin-bottom: 10px;
}

/* Estilo de los elementos del formulario */
.form-group {
    margin-bottom: 10px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"], input[type="email"], input[type="password"] {
    display: block;
    width: 100%; /* Cambia el ancho de los inputs a 100% para que ocupen todo el espacio disponible */
    padding: 10px;
    border: 1px solid #cccccc;
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
        <h2>Iniciar sesión</h2>
        <p>Por favor, rellene sus credenciales para iniciar sesión.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Iniciar sesión">
            </div>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>
        </form>
    </div>
</body>
</html>