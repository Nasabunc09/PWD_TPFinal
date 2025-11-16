<?php
// Nombre del proyecto (carpeta bajo document_root)
$PROYECTO = 'PWD_TPFinal';

// ---------------------------
// RUTA FÍSICA (para PHP)
// ---------------------------
// Ej: C:\xampp\htdocs\PWD_TPFinal\
$GLOBALS['ROOT_PROYECTO'] = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $PROYECTO . DIRECTORY_SEPARATOR;

// ---------------------------
// URL PÚBLICA (para el navegador)
// ---------------------------
// Ej: /PWD_TPFinal/
$GLOBALS['BASE_URL']  = '/' . trim($PROYECTO, '/') . '/';

// ---------------------------
// RUTAS DERIVADAS
// ---------------------------
$GLOBALS['VISTA_URL'] = $GLOBALS['BASE_URL'] . 'Vista/';
$GLOBALS['CSS_URL']   = $GLOBALS['BASE_URL'] . 'Vista/css/';
$GLOBALS['IMG_URL']   = $GLOBALS['BASE_URL'] . 'Vista/imagenes/';

// Rutas físicas útiles
$GLOBALS['MODELO_PATH'] = $GLOBALS['ROOT_PROYECTO'] . 'Modelo' . DIRECTORY_SEPARATOR;
$GLOBALS['CONTROL_PATH'] = $GLOBALS['ROOT_PROYECTO'] . 'Control' . DIRECTORY_SEPARATOR;
$GLOBALS['VISTA_PATH'] = $GLOBALS['ROOT_PROYECTO'] . 'Vista' . DIRECTORY_SEPARATOR;
?>
