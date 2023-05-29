<?php
// verifica si se ha enviado el formulario
if (isset($_POST['correo']) && isset($_POST['contrasena']) && isset($_POST['tipo'])) {

    // recupera el correo, la contraseña y el tipo de usuario enviados por el formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo'];

    // se establece la conexión con la base de datos
    $host = "localhost";
    $user = "edgar";
    $password = "123";
    $database = "bdproyecto";

    $con = mysqli_connect($host, $user, $password, $database);
    // Revisar si la conexión se realizó correctamente
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
    echo "Conexión exitosa";

    if ($tipo_usuario == 'estudiante') {
        // se prepara la consulta SQL para verificar las credenciales del estudiante
        $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'";
    } else if ($tipo_usuario == 'profesor') {
        // se prepara la consulta SQL para verificar las credenciales del profesor
        $sql = "SELECT * FROM profesores WHERE correo='$correo' AND contrasena='$contrasena'";
    } else {
        // si el usuario no especifica un tipo válido, muestra un mensaje de error
        $mensaje_error = 'Tipo de usuario no válido.';
    }

    if (!isset($mensaje_error)) {
        $result = $con->query($sql);

        // verifica si el correo y la contraseña son válidos para un usuario o profesor
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($tipo_usuario == 'estudiante') {
                // inicia sesión y redirige al estudiante a una página de bienvenida
                session_start();
                $_SESSION['correo'] = $correo;
                header('Location: ingreso.php');
                exit;
            } else if ($tipo_usuario == 'profesor') {
                // inicia sesión y redirige al profesor a una página de bienvenida para profesores
                session_start();
                $_SESSION['correo'] = $correo;
                header('Location: pagina_profesor.php');
                exit;
            }
        } else {
            // muestra un mensaje de error si las credenciales son incorrectas
            $mensaje_error = 'Correo o contraseña incorrectos.';
        }
    }

    $con->close();
}
?>

<?php
// Verifica si se ha enviado el formulario de registro
if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['contrasena']) && isset($_POST['num_equipo'])) {

    // Recupera los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $num_equipo = $_POST['num_equipo'];

    // Establece la conexión con la base de datos
    $host = "localhost";
    $user = "edgar";
    $password = "123";
    $database = "bdproyecto";

    $con = mysqli_connect($host, $user, $password, $database);
    // Revisar si la conexión se realizó correctamente
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
    echo "Conexión exitosa";

    // Prepara la consulta SQL para insertar los datos en la tabla de usuarios
    $sql = "INSERT INTO usuarios (nombre, apellidos, correo, contrasena, equipo_id)
            VALUES ('$nombre', '$apellidos', '$correo', '$contrasena', $num_equipo)";

    // Ejecuta la consulta
    if ($con->query($sql) === true) {
        echo "Registro exitoso";
        // Redirige al usuario a la página de ingreso
        session_start();
        $_SESSION['correo'] = $correo;
        header('Location: ingreso.php');
        exit;
    } else {
        echo "Error en el registro: " . $con->error;
    }

    // Cierra la conexión con la base de datos
    $con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="header-bg">
        <header class="header container">

            <div class="titulo-contenedor">
                <h1 class="titulo">Espacio Arquitectonico en México</h1>
            </div>

            <div class="navegacion">
                <ul class="links">
                    <li class="link"><a href="index.html">Inicio</a></li>
                    <li class="link"><a href="edificios.php">Edificios</a></li>
                    <li class="link"><a href="espacios-urbanos.php">Espacios Urbanos</a></li>
                    <li class="link"><a href="biografias.php">Biografias</a></li>
                    <li class="link">Login</li>
                </ul>
            </div>

        </header>
    </div>

    <div class="container-log">
        <div class="caja">
            <h2>Iniciar Sesion</h2>

            <?php if (isset($mensaje_error)) { ?>
      <p><?php echo $mensaje_error; ?></p>
    <?php } ?>
    <form method="POST">

                <label for="correo">Correo electrónico:</label>
      <input type="text" id="correo" name="correo">
      <label for="contrasena">Contraseña:</label>
      <input type="password" id="contrasena" name="contrasena">
      <div>
        <label for="estudiante">Estudiante</label>
        <input type="radio" id="estudiante" name="tipo" value="estudiante">
        <label for="profesor">Profesor</label>
        <input type="radio" id="profesor" name="tipo" value="profesor">
        </div>
      <input type="submit" value="Iniciar Sesión">
            </form>
        </div>
        <div class="caja">
            <h2>Registro</h2>
            <form method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre">
      <label for="apellidos">Apellidos:</label>
      <input type="text" id="apellidos" name="apellidos">
      <label for="correo">Correo electrónico:</label>
      <input type="email" id="correo" name="correo">
      <label for="contrasena">Contraseña:</label>
      <input type="password" id="contrasena" name="contrasena">
      <label for="num_equipo">Número de Equipo:</label>
      <input type="number" id="num_equipo" name="num_equipo" min="1" max="10">
      <input type="submit" value="Registrarse">
            </form>
        </div>
    </div>

</body>
</html>
