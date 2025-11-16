<?php

class AbmMenu {

  
    public function alta($param) {
        $resp = false;

        $objMenu = new Menu();
        $idpadre = empty($param['idpadre']) ? null : $param['idpadre'];

        $objMenu->setear(
            null,
            $param['menombre'],
            $param['medescripcion'],
            $idpadre,
            $param['medeshabilitado'] ?? null
        );

        if ($objMenu->insertar()) {
            $resp = true;
        }
        return $resp;
    }

   
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $objMenu = new Menu();
            $objMenu->setIdMenu($param['idmenu']);   

            if ($objMenu->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    
    public function modificacion($param) {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {

            $objMenu = new Menu();
            $idpadre = empty($param['idpadre']) ? null : $param['idpadre'];

            $objMenu->setear(
                $param['idmenu'],
                $param['menombre'],
                $param['medescripcion'],
                $idpadre,
                $param['medeshabilitado'] ?? null
            );

            if ($objMenu->modificar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function buscar($param) {
        $where = " true ";

        if ($param != null) {

            if (isset($param['idmenu'])) {
                $where .= " AND idmenu = " . intval($param['idmenu']);
            }

            if (isset($param['menombre'])) {
                $nombre = addslashes($param['menombre']);
                $where .= " AND menombre LIKE '%{$nombre}%'";
            }

            if (isset($param['idpadre'])) {
                $where .= " AND idpadre = " . intval($param['idpadre']);
            }

            if (isset($param['medeshabilitado'])) {
                $where .= " AND medeshabilitado = '" . $param['medeshabilitado'] . "'";
            }
        }

        return Menu::listar($where);
    }

    /* Obtiene los menús accesibles por un usuario */
    public function obtenerMenuPorUsuario($idUsuario) {

        $sql = "idmenu IN (
                    SELECT idmenu
                    FROM menurol
                    INNER JOIN usuario ON usuario.idrol = menurol.idrol
                    WHERE usuario.idusuario = " . intval($idUsuario) . "
                ) 
                AND (medeshabilitado = '0000-00-00 00:00:00' 
                     OR medeshabilitado IS NULL)";

        return Menu::listar($sql);
    }

    /* Verifica existencia de clave primaria */
    private function seteadosCamposClaves($params) {
        return isset($params['idmenu']);
    }
}
