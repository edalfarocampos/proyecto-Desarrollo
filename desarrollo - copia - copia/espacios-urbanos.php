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
                    <li class="link"><a href="edificios.php">Edificios</a></li>
                    <li class="link">Espacios Urbanos</li>
                    <li class="link"><a href="biografias.php">Biografias</a></li>
                    <li class="link"><a href="login.php">Login</a></li>
                </ul>
            </div>

        </header>
    </div>

    <div class="container">
        <h2>Espacios Urbanos</h2>
        <p>Contenido de la página de Espacios Urbanos.</p>

        <?php
        // Conectar a la base de datos
        $conexion = mysqli_connect("localhost", "edgar", "123", "bdproyecto");

        // Verificar si se pudo conectar a la base de datos
        if (mysqli_connect_errno()) {
        echo "Error al conectar a la base de datos: " . mysqli_connect_error();
        exit();
        }

        // Obtener los datos de los espacios urbanos de la base de datos
        $resultados = mysqli_query($conexion, "SELECT id, nombre, anio_establecimiento, funcion, arquitecto_id,ubicacion_id,
        contexto_historico,plan_urbanistico_id,tipo_traza_urbana_id,tipo_planta_id,origen_trazo,orientacion,dimensiones
        ,secciones,elementos_imagen_urbana,tipos_edificaciones_rodean,transformaciones_espacio_urbano_id,
        principios_diseno,importancia_espacio_urbano FROM espacios_urbanos");

        // Mostrar los datos de los espacios urbanos en la página
        while ($espacio = mysqli_fetch_assoc($resultados)) {
        echo "<div class='arquitecto'>
            ";
            echo "<h3>" . $espacio['nombre'] . "</h3>";
            echo "<p>Año de establecimiento: " . $espacio['anio_establecimiento'] . "</p>";
            echo "<p>Función: " . $espacio['funcion'] . "</p>";
            echo "<p>Nombre del arquitecto: "  . obtenerNombrearquitecto($conexion, $espacio['arquitecto_id']) .  "</p>";
            echo "<p>Ubicacion: "  . obtenerNombreUbicacion($conexion, $espacio['ubicacion_id']) .  "</p>";
            echo "<p>Contexto historico: " . $espacio['contexto_historico'] . "</p>";
            echo "<p>Plan Urbanistico: "  . obtenerPlanUrbanistico($conexion, $espacio['plan_urbanistico_id']) .  "</p>";
            echo "<p>Tipo traza urbana: "  . obtenerTrazaUrbana($conexion, $espacio['tipo_traza_urbana_id']) .  "</p>";
            echo "<p>Tipo de planta: "  . obtenerTipoPlanta($conexion, $espacio['tipo_planta_id']) .  "</p>";
            echo "<p>Origen trazo: " . $espacio['origen_trazo'] . "</p>";
            echo "<p>Orientacion : " . $espacio['orientacion'] . "</p>";
            echo "<p>Dimensiones : " . $espacio['dimensiones'] . "</p>";
            echo "<p>Secciones : " . $espacio['secciones'] . "</p>";
            echo "<p>Elementos imagen urbana : " . $espacio['elementos_imagen_urbana'] . "</p>";
            echo "<p>Edificaciones que lo rodean : " . $espacio['tipos_edificaciones_rodean'] . "</p>";
            echo "<p>Transformaciones espacio urbano: "  . obtenerTransformaciones($conexion, $espacio['transformaciones_espacio_urbano_id']) .  "</p>";
            echo "<p>Principios diseno : " . $espacio['principios_diseno'] . "</p>";
            echo "<p>Importancia : " . $espacio['importancia_espacio_urbano'] . "</p>";

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
        
        // Función para obtener el plan Urbanistico a partir de su id
        function obtenerPlanUrbanistico($conexion, $id) {
        $query = "SELECT nombre FROM planes_urbanisticos WHERE id = " . $id;
        $resultado = mysqli_query($conexion, $query);
        $lugar = mysqli_fetch_assoc($resultado);
        return $lugar['nombre'];
        }

        // Función para obtener el trazo Urbanistico a partir de su id
        function obtenerTrazaUrbana($conexion, $id) {
        $query = "SELECT nombre FROM tipos_traza_urbana WHERE id = " . $id;
        $resultado = mysqli_query($conexion, $query);
        $lugar = mysqli_fetch_assoc($resultado);
        return $lugar['nombre'];
        }

        // Función para obtener el tipo de planta a partir de su id
        function obtenerTipoPlanta($conexion, $id) {
        $query = "SELECT nombre FROM tipos_planta WHERE id = " . $id;
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






