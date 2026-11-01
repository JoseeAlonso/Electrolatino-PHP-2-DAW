<?php

// Implementa el modo estricto de PHP y fuerza la tipificación estricta (1 = activado; 0 = desactivado).
declare(strict_types=1);

// Evita que se pueda acceder a este archivo directamente (1 = activado; 0 = desactivado) ¡¡ACTIVAR SIEMPRE!!.
ini_set('session.use_strict_mode', '1');

// Evita que se pueda acceder a la sesión desde otro apartado distinto a las cookies (1 = activado; 0 = desactivado) ¡¡ACTIVAR SIEMPRE!!.
ini_set('session.use_only_cookies', '1');

// Permite la validación de la sesión (https) en el lado del servidor. Si es on, la sesión solo se enviará si la conexión es segura (HTTPS). Si es off, la sesión se enviará aunque la conexión no sea segura (HTTP).
$https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';



session_set_cookie_params([

    "lifetime" => 0, // La cookie de sesión se elimina al cerrar el navegador.

    "path" => "/", // La cookie de sesión es válida para to do el dominio, tulizando el / haciendo referencia a la raíz.

    "secure" => $https, // La cookie de sesión solo se enviará si la conexión es segura (HTTPS).

    "httponly" => true, // La cookie no es accesible mediante JS (medida de seguridad).

    "samesite" => "Lax", // Permite que en el mismo sitio y determinadas navegaciones, se puedan enviar cookies.
]);

session_start(); // Inicializar y/o recuperar el mecanismo de sesiones de php.


// Evalua si es posible recuperar el carrito previamente o crear uno de estar vacío.
if (!isset($_SESSION["carrito"]) || !is_array($_SESSION["carrito"])) {

    $_SESSION["carrito"] = [];
}

// Almacena en el servidor un token secreto y único asignado a la sesión actual del usuario, previniendo ataques CSRF.
if (empty ($_SESSION["csrf_token"])) {
    
    // Transforma el csrf_token en un código Hexadecimal de 32 bytes
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

// Carga las funciones reutilizables.
require_once __DIR__ . '/funciones.php';
