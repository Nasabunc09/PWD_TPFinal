<?php

class Session {

    private $usuario;
    private $rol;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si existe la sesión, cargo el usuario
        if (isset($_SESSION['idusuario'])) {
            $abmUsuario = new AbmUsuario();
            $usuario = $abmUsuario->buscar(['idusuario' => $_SESSION['idusuario']]);

            if (!empty($usuario)) {
                $this->usuario = $usuario[0];
            }
        }
    }

    /**
     * Inicia sesión si usuario y contraseña son correctos
     */
    public function iniciar($nombreUsuario, $psw) {
        $abmUsuario = new AbmUsuario();

        // Buscar usuario por nombre (NO por mail)
        $usuario = $abmUsuario->buscar(['usnombre' => $nombreUsuario]);

        if (!empty($usuario)) {
            $usuario = $usuario[0];

            // Comparar contraseña hasheada
            if (password_verify($psw, $usuario->getUsPass())) {

                $_SESSION['idusuario'] = $usuario->getIdUsuario();
                $this->usuario = $usuario;

                return true; // login OK
            }
        }

        return false; // login fallido
    }

    /**
     * Valida si la sesión está activa
     */
    public function validar() {
        return isset($_SESSION['idusuario']);
    }

    /**
     * Devuelve el usuario logueado
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Cerrar sesión
     */
    public function cerrar() {
        session_destroy();
        $_SESSION = [];
        $this->usuario = null;
    }

    
    public function activa() {
        return isset($_SESSION['idusuario']);
    }
}
