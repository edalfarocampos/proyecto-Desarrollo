<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espacios Urbanos</title>

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
                    <li class="link">Edificios</li>
                    <li class="link"><a href="espacios-urbanos.php">Espacios Urbanos</a></li>
                    <li class="link"><a href="biografias.php">Biografias</a></li>
                    <li class="link"><a href="login.php">Login</a></li>
                </ul>
            </div>

        </header>
    </div>

    <div class="container">
        <h2>edificaciones</h2>
        <p>Contenido de la página de edificaciones.</p>

        <?php
        // Conectar a la base de datos
        $conexion = mysqli_connect("localhost", "edgar", "123", "bdproyecto");

        // Verificar si se pudo conectar a la base de datos
        if (mysqli_connect_errno()) {
        echo "Error al conectar a la base de datos: " . mysqli_connect_error();
        exit();
        }

        // Obtener los datos de los espacios urbanos de la base de datos
        $resultados = mysqli_query($conexion, "SELECT id, nombre, genero_tipologia, uso_actual
        , anio_construccion, arquitecto_id,ubicacion_id,contexto_historico,
        concepto,plantas_arquitectonicas,fachadas_ornamentos,corriente_estilistica,
        materiales_sistemas_constructivos, contexto_urbano_situacion_emplazamiento, transformaciones_espacio_id FROM edificaciones");

        // Mostrar los datos de los espacios urbanos en la página
        while ($espacio = mysqli_fetch_assoc($resultados)) {
        echo "<div class='arquitecto'>
            ";
            echo "<h3>" . $espacio['nombre'] . "</h3>";
            echo "<p>Género/Tipología: " . $espacio['genero_tipologia'] . "</p>";
            echo "<p>Uso Actual: " . $espacio['uso_actual'] . "</p>";
            echo "<p>Año de Construcción: " . $espacio['anio_construccion'] . "</p>";
            echo "<p>Nombre del arquitecto: "  . obtenerNombrearquitecto($conexion, $espacio['arquitecto_id']) .  "</p>";
            echo "<p>Ubicacion: "  . obtenerNombreUbicacion($conexion, $espacio['ubicacion_id']) .  "</p>";
            echo "<p>Contexto histórico: " . $espacio['contexto_historico'] . "</p>";
            echo "<p>Concepto: " . $espacio['concepto'] . "</p>";
            echo "<p>Plantas Arquitectónicas: " . $espacio['plantas_arquitectonicas'] . "</p>";
            echo "<p>Fachadas y Ornamentos: " . $espacio['fachadas_ornamentos'] . "</p>";
            echo "<p>Corriente Estilística: " . $espacio['corriente_estilistica'] . "</p>";
            echo "<p>Materiales y Sistemas Constructivos: " . $espacio['materiales_sistemas_constructivos'] . "</p>";
            echo "<p>Contexto Urbano y Situación de Emplazamiento: " . $espacio['contexto_urbano_situacion_emplazamiento'] . "</p>";
             echo "<p>Transformaciones espacio urbano: "  . obtenerTransformaciones($conexion, $espacio['transformaciones_espacio_id']) .  "</p>";
            

            echo "
        </div>";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);


        // Función para obtener el nombre del arquitecto a partir de su id
        function obtenerNombrearquitecto($conexion, $id) {
        $query = "SELECT nombre FROM biografias WHERE id = " . $id;
        $resultado = mysqli_query($conexion, $query);
        $lugar = mysqli_fetch_assoc($resultado);
        return $lugar['nombre'];
        }

        // Función para obtener el nombre de la ubicacion a partir de su id
        function obtenerNombreUbicacion($conexion, $id) {
        $query = "SELECT nombre FROM Ubicaciones WHERE id = " . $id;
        $resultado = mysqli_query($conexion, $query);
        $lugar = mysqli_fetch_assoc($resultado);
        return $lugar['nombre'];
        }
        
        // Función para obtener Transformaciones espacio urbano a partir de su id
        function obtenerTransformaciones($conexion, $id) {
        $query = "SELECT descripcion FROM transformaciones_espacio_urbano WHERE id = " . $id;
        $resultado = mysqli_query($conexion, $query);
        $lugar = mysqli_fetch_assoc($resultado);
        return $lugar['descripcion'];
        }
     

        ?>


    </div>

</body>
</html>






