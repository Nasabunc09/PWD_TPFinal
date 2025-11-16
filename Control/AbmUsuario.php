<?php

class AbmUsuario{

    
    public function registrar($param) {
        $obj = new Usuario();
        $obj->setear(0, $param["usnombre"], $param["uspass"], $param["usmail"], null);
        return $obj->insertar();
    }

    public function buscar($param) {
        $obj = new Usuario();
        return $obj->buscar($param);
    }

}