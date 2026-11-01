<?php
/**inspección y regeneración de sesión. */
require_once __DIR__ . '/includes/config.php';

if (($_SERVER["REQUEST_METHOD"] ?? "") === "POST") {

    // Verifica que el método es POST.
    exigirPostValido();

    // true => los datos anteriores de elemento con id anterior, se regeneran a un nuevo id.
    // false => Se recuperan los datos del anterior elemento con el mismo id.
    session_regenerate_id(true);

    // Función de reedireccionamiento (volver()). Sirve para que el usuario sea redirigido automáticamente a otra página y evita que pueda duplicarse el envío de un formulario o inicio de sesión.
    volver("sesion.php");
}
cabecera('Inspección de sesión');
?>
<section class="intro">
    <p class="etiqueta">LABORATORIO</p>
    <h1>¿Cómo funciona una sesión?</h1>
</section>
<div class="panel">

    <p><strong>Nombre de la cookie de sesión: </strong>
        <code class="romper"><?= e(session_name()) ?></code>
    </p>
    <p><strong>ID de sesión: </strong>
        <code class="romper"><?= e(session_id()) ?></code>
    </p>

    <p> <?= e(print_r($_SESSION["carrito"], true)) ?> </p>

    <p>Unidades: <?=unidadesCarrito() ?> </p>

    <form method="post">

    <?= campoCsrf() ?>

        <button type="submit">Regenerar Identificador de Sesión</button>

    </form>

    <form action="cerrar.php" method="post" class="separado">

       <?= campoCsrf() ?>

        <button type="submit">Cerrar Sesión y Borrar Carrito</button>

    </form>


</div>
<?php pie(); ?>