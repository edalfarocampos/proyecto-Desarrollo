<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biografias</title>
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
                    <li class="link">Biografias</li>
                    <li class="link"><a href="login.php">Login</a></li>
                </ul>
            </div>
        </header>
    </div>

    <div class="container">
        <h2>Biografías</h2>
        <p>Conoce más sobre los arquitectos que han dejado huella en México:</p>

        <?php
        // Conectar a la base de datos
        $conexion = mysqli_connect("localhost", "edgar", "123", "bdproyecto");

        // Verificar si se pudo conectar a la base de datos
        if (mysqli_connect_errno()) {
            echo "Error al conectar a la base de datos: " . mysqli_connect_error();
            exit();
        }

        // Obtener los datos de los arquitectos de la base de datos
        $resultados = mysqli_query($conexion, "SELECT nombre, anio_nacimiento, lugar_nacimiento_id, lugar_estudios, disciplina_estudios, obras_principales, elementos_caracterizan_obra FROM Biografias");

        // Mostrar los datos de los arquitectos en la página
        while ($arquitecto = mysqli_fetch_assoc($resultados)) {
            echo "<div class='arquitecto'>";
            echo "<h3>" . $arquitecto['nombre'] . "</h3>";
            echo "<p>Año de nacimiento: " . $arquitecto['anio_nacimiento'] . "</p>";
            echo "<p>Lugar de nacimiento: " . obtenerNombreLugar($conexion, $arquitecto['lugar_nacimiento_id']) . "</p>";
            echo "<p>Lugar de estudios: " . $arquitecto['lugar_estudios'] . "</p>";
            echo "<p>Disciplinas estudiadas: " . $arquitecto['disciplina_estudios'] . "</p>";
            echo "<p>Obras principales: " . $arquitecto['obras_principales'] . "</p>";
            echo "<p>Elementos que caracterizan sus obras: " . $arquitecto['elementos_caracterizan_obra'] . "</p>";
            echo "</div>";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);

        // Función para obtener el nombre del lugar de nacimiento a partir de su id
        function obtenerNombreLugar($conexion, $id) {
            $query = "SELECT nombre FROM Ubicaciones WHERE id = " . $id;
            $resultado = mysqli_query($conexion, $query);
            $lugar = mysqli_fetch_assoc($resultado);
            return $lugar['nombre'];
        }
        ?>
    </div>
</body>

</html>






