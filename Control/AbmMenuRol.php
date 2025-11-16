<?php

class AbmMenuRol {

    public function alta($param) {
        $resp = false;
        $obj = new MenuRol();

        $objMenu = new Menu();
        $objMenu->setIdMenu($param['idmenu']);
        $objMenu->cargar();

        $objRol = new Rol();
        $objRol->setIdRol($param['idrol']);
        $objRol->cargar();

        $obj->setear($objMenu, $objRol);

        if ($obj->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param) {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            $obj = new MenuRol();

            $objMenu = new Menu();
            $objMenu->setIdMenu($param['idmenu']);
            $objMenu->cargar();

            $objRol = new Rol();
            $objRol->setIdRol($param['idrol']);
            $objRol->cargar();

            $obj->setear($objMenu, $objRol);

            if ($obj->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function buscar($param) {
        $where = " true ";

        if ($param != null) {
            if (isset($param['idmenu'])) 
                $where .= " AND idmenu = " . $param['idmenu'];

            if (isset($param['idrol'])) 
                $where .= " AND idrol = " . $param['idrol'];
        }

        // CORRECCIÓN: crear objeto → llamar listar()
        $obj = new MenuRol();
        return $obj->listar($where);
    }

    private function seteadosCamposClaves($params) {
        return isset($params['idmenu']) && isset($params['idrol']);
    }
}
