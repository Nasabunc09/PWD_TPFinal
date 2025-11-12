<?php
//acá voy a guardar las funciones auxiliares

define('ROOT', dirname(__DIR__) . '/'); //esto es la raiz del proyecto q tengo, el dir me devuelve el directorio del archivo actual(.../trabajos_practicos/Utils/) ; dirname sube un nivel, o sea, me lleva a .../trabajos_practicos/ ; x lo q root pasa a ser una constante con el valor de la ruta base del proyecto !!

//////DATA_SUBMITTED: esta funcion es para encapsular los envios de post/get de la info del formulario
function data_submitted()
{
    $datos = [];

    if (!empty($_POST)) {
        $datos = $_POST;
    } elseif (!empty($_GET)) {
        $datos = $_GET;
    } //evaluo si vienen por post o get

    foreach ($datos as $clave => $valor) {
        $datos[$clave] = ($valor === "") ? null : $valor;
    }

    if (!empty($_FILES)) { //para poder usarla con ls ejercicios que tienen archivos
        foreach ($_FILES as $clave => $archivo) {
            $datos[$clave] = $archivo;
        }
    }

    return $datos; //retorno los datos del arreglo en un array con la clve siendo el name de la etiqueta y el valor siendo el contenido
}



//////AUTOLOAD: esta funcion es para incluir 'dinamicamente' los objetos del control y del modelo, en lugar de hacer include_once todo el tiempo
spl_autoload_register(function ($className) {
    $directorios = [ //las sgtes son las rutas donde buscar las clases
        ROOT . 'Modelo/', //acá buscaria a auto y persona
        ROOT . 'Modelo/conector/', //acá a la clase bd con el pdo
        ROOT . 'Control/TP4/', //acá a abmauto y abmpersona
    ];

    foreach ($directorios as $directorio) {
        $archivo = $directorio . $className . '.php';
        if (file_exists($archivo)) {
            require_once $archivo;
            return;
        }
    }

    error_log("Autoload: Clase '$className' no encontrada."); //msj por si falla
});
