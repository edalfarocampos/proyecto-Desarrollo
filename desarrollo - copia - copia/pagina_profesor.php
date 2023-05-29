<?php
session_start(); // Iniciar la sesión

if (!isset($_SESSION['correo'])) { // Verificar si la sesión está iniciada
    header("Location: login.php"); // Si no está iniciada, redirigir al inicio de sesión
    exit;
}

// Establece la conexión con la base de datos
$host = "localhost";
$user = "edgar";
$password = "123";
$database = "bdproyecto";

$con = mysqli_connect($host, $user, $password, $database);

// Consulta SQL para obtener los datos de ubicaciones
$query = "SELECT id, nombre FROM ubicaciones";
$result = $con->query($query);
?>

<?php
// Verifica si se ha enviado el formulario de biografías
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['anio_nacimiento']) && isset($_POST['lugar_nacimiento']) && isset($_POST['lugar_estudios']) && isset($_POST['disciplina_estudios']) && isset($_POST['obras_principales']) && isset($_POST['elementos_obra'])) {
        // Recupera los datos enviados por el formulario
        $nombre = $_POST['nombre'];
        $anio_nacimiento = $_POST['anio_nacimiento'];
        $lugar_nacimiento_id = $_POST['lugar_nacimiento'];
        $lugar_estudios = $_POST['lugar_estudios'];
        $disciplina_estudios = $_POST['disciplina_estudios'];
        $obras_principales = $_POST['obras_principales'];
        $elementos_obra = $_POST['elementos_obra'];

        // Prepara la consulta SQL para insertar los datos en la tabla de biografías
        $sql = "INSERT INTO Biografias (nombre, anio_nacimiento, lugar_nacimiento_id, lugar_estudios, disciplina_estudios, obras_principales, elementos_caracterizan_obra)
                VALUES ('$nombre', '$anio_nacimiento', '$lugar_nacimiento_id', '$lugar_estudios', '$disciplina_estudios', '$obras_principales', '$elementos_obra')";

        // Ejecuta la consulta
if ($con->query($sql) === true) {
    // Redirige al usuario a la página de biografías
    header('Location: biografias.php');
    exit;
} else {
    echo "Error en el registro: " . $con->error;
}
    }
}

// Cierra la conexión con la base de datos
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

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
                </ul>
            </div>
        </header>
    </div>

    <div class="container-log">
        <div class="caja">
            <h2>Bienvenido, profesor <?php echo $_SESSION['correo']; ?></h2>
            <p>¡Has iniciado sesión correctamente como profesor!</p>

            <div class="menu-desplegable">
                <select id="opcion" onchange="mostrarFormulario()">
                    <option value="">Selecciona una opción</option>
                    <option value="biografia">Agregar Biografía</option>
                    <option value="espacio">Agregar Espacio Urbano</option>
                    <option value="edificio">Agregar Edificio</option>
                </select>
            </div>

            <div id="formulario-biografia" style="display: none;">
                <h3>Agregar Biografía</h3>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br>

                    <label for="anio_nacimiento">Año de nacimiento:</label>
                    <input type="text" id="anio_nacimiento" name="anio_nacimiento" required><br>

                    <label for="lugar_nacimiento">Lugar de nacimiento:</label>
                    <select name="lugar_nacimiento" required>
                        <?php
                        // Generar las opciones del menú desplegable
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select><br>

                    <label for="lugar_estudios">Lugar de estudios:</label>
                    <input type="text" id="lugar_estudios" name="lugar_estudios" required><br>

                    <label for="disciplina_estudios">Disciplinas estudiadas:</label>
                    <input type="text" id="disciplina_estudios" name="disciplina_estudios" required><br>

                    <label for="obras_principales">Obras principales:</label>
                    <textarea id="obras_principales" name="obras_principales" required></textarea><br>

                    <label for="elementos_obra">Elementos que caracterizan su obra:</label>
                    <textarea id="elementos_obra" name="elementos_obra" required></textarea><br>

                    <input type="submit" value="Agregar">
                </form>
            </div>
       
 
    <div id="formulario-espacio" style="display: none;">
        <h3>Agregar Espacio Urbano</h3>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="nombre_espacio">Nombre:</label>
    <input type="text" id="nombre_espacio" name="nombre_espacio" required><br>

    <label for="anio_establecimiento">Año de Establecimiento:</label>
    <input type="text" id="anio_establecimiento" name="anio_establecimiento" required><br>

    <label for="funcion">Función:</label>
    <input type="text" id="funcion" name="funcion" required><br>

    <label for="arquitecto_id">ID del Arquitecto:</label>
    <input type="text" id="arquitecto_id" name="arquitecto_id" required><br>

    <label for="ubicacion_id">ID de la Ubicación:</label>
    <input type="text" id="ubicacion_id" name="ubicacion_id" required><br>

    <label for="contexto_historico">Contexto Histórico:</label>
    <textarea id="contexto_historico" name="contexto_historico" required></textarea><br>

    <label for="plan_urbanistico_id">ID del Plan Urbanístico:</label>
    <input type="text" id="plan_urbanistico_id" name="plan_urbanistico_id" required><br>

    <label for="tipo_traza_urbana_id">ID del Tipo de Trazado Urbano:</label>
    <input type="text" id="tipo_traza_urbana_id" name="tipo_traza_urbana_id" required><br>

    <label for="tipo_planta_id">ID del Tipo de Planta:</label>
    <input type="text" id="tipo_planta_id" name="tipo_planta_id" required><br>

    <label for="origen_trazo">Origen del Trazo:</label>
    <input type="text" id="origen_trazo" name="origen_trazo" required><br>

    <label for="orientacion">Orientación:</label>
    <input type="text" id="orientacion" name="orientacion" required><br>

    <label for="dimensiones">Dimensiones:</label>
    <input type="text" id="dimensiones" name="dimensiones" required><br>

    <label for="secciones">Secciones:</label>
    <textarea id="secciones" name="secciones" required></textarea><br>

    <label for="elementos_imagen_urbana">Elementos de la Imagen Urbana:</label>
    <textarea id="elementos_imagen_urbana" name="elementos_imagen_urbana" required></textarea><br>

    <label for="tipos_edificaciones_rodean">Tipos de Edificaciones que Rodean:</label>
    <textarea id="tipos_edificaciones_rodean" name="tipos_edificaciones_rodean" required></textarea><br>

    <label for="transformaciones_espacio_urbano_id">ID de las Transformaciones del Espacio Urbano:</label>
    <input type="text" id="transformaciones_espacio_urbano_id" name="transformaciones_espacio_urbano_id" required><br>

    <label for="principios_diseno">Principios de Diseño:</label>
    <textarea id="principios_diseno" name="principios_diseno" required></textarea><br>

    <label for="importancia_espacio_urbano">Importancia del Espacio Urbano:</label>
    <input type="text" id="importancia_espacio_urbano" name="importancia_espacio_urbano" required><br>

    <input type="submit" value="Agregar">
</form>

    </div>
    <!-- Código del formulario de agregar edificios -->
<div id="formulario-edificios" class="formulario" style="display: none;">
    <h3>Agregar Edificio</h3>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="nombre_edificio">Nombre:</label>
    <input type="text" id="nombre_edificio" name="nombre_edificio" required><br>

    <label for="genero_tipologia">Género/Tipología:</label>
    <input type="text" id="genero_tipologia" name="genero_tipologia" required><br>

    <label for="uso_actual">Uso Actual:</label>
    <input type="text" id="uso_actual" name="uso_actual" required><br>

    <label for="anio_construccion">Año de Construcción:</label>
    <input type="text" id="anio_construccion" name="anio_construccion" required><br>

    <label for="arquitecto_id">ID del Arquitecto:</label>
    <input type="text" id="arquitecto_id" name="arquitecto_id" required><br>

    <label for="ubicacion_id">ID de la Ubicación:</label>
    <input type="text" id="ubicacion_id" name="ubicacion_id" required><br>

    <label for="contexto_historico">Contexto Histórico:</label>
    <textarea id="contexto_historico" name="contexto_historico" required></textarea><br>

    <label for="concepto">Concepto:</label>
    <textarea id="concepto" name="concepto" required></textarea><br>

    <label for="plantas_arquitectonicas">Plantas Arquitectónicas:</label>
    <textarea id="plantas_arquitectonicas" name="plantas_arquitectonicas" required></textarea><br>

    <label for="fachadas_ornamentos">Fachadas y Ornamentos:</label>
    <textarea id="fachadas_ornamentos" name="fachadas_ornamentos" required></textarea><br>

    <label for="corriente_estilistica">Corriente Estilística:</label>
    <input type="text" id="corriente_estilistica" name="corriente_estilistica" required><br>

    <label for="materiales_sistemas_constructivos">Materiales y Sistemas Constructivos:</label>
    <textarea id="materiales_sistemas_constructivos" name="materiales_sistemas_constructivos" required></textarea><br>

    <label for="contexto_urbano_situacion_emplazamiento">Contexto Urbano y Situación de Emplazamiento:</label>
    <textarea id="contexto_urbano_situacion_emplazamiento" name="contexto_urbano_situacion_emplazamiento" required></textarea><br>

    <label for="transformaciones_espacio_id">ID de las Transformaciones del Espacio:</label>
    <input type="text" id="transformaciones_espacio_id" name="transformaciones_espacio_id" required><br>

    <input type="submit" value="Agregar">
</form>

</div>

   <script>
    function mostrarFormulario() {
        var opcionSeleccionada = document.getElementById("opcion").value;
        var formularioBiografia = document.getElementById("formulario-biografia");
        var formularioEspacio = document.getElementById("formulario-espacio");
        var formularioEdificios = document.getElementById("formulario-edificios");

        if (opcionSeleccionada === "biografia") {
            formularioBiografia.style.display = "block";
            formularioEspacio.style.display = "none";
            formularioEdificios.style.display = "none";
        } else if (opcionSeleccionada === "espacio") {
            formularioBiografia.style.display = "none";
            formularioEspacio.style.display = "block";
            formularioEdificios.style.display = "none";
        } else if (opcionSeleccionada === "edificio") {
            formularioBiografia.style.display = "none";
            formularioEspacio.style.display = "none";
            formularioEdificios.style.display = "block";
        } else {
            formularioBiografia.style.display = "none";
            formularioEspacio.style.display = "none";
            formularioEdificios.style.display = "none";
        }
    }

    function actualizarLugarNacimiento() {
        var lugarNacimiento = document.querySelector("select[name=lugar_nacimiento]").value;
        document.getElementById("lugar_nacimiento").value = lugarNacimiento;
    }

    // Llamar a la función actualizarLugarNacimiento al cargar la página
    actualizarLugarNacimiento();
</script>

</body>
</html>