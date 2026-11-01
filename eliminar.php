<?php
/** eliminar producto mediante la sesión. */
require_once __DIR__ . '/includes/config.php';
exigirPostValido();

cabecera('Eliminar producto');

/*Capturamos el id del elemento en cuestión al pulsar el botón. Creamos el enlace entre el id del producto afiliado al botón */
$id = filter_input(
    INPUT_POST,
    'producto_id',
    FILTER_VALIDATE_INT
);

if ($id === false || $id === null){
    http_response_code(400);
    /*exit() para la ejecución y envía un mensaje al cliente, no por pantalla */
    exit('Identificador no válido');
}

unset($_SESSION['carrito'][$id]);

volver('carrito.php');

