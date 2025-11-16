<?php
include_once "../configuracion.php";

$abm = new ABMUsuario();

$param["usnombre"] = $_POST["usnombre"];
$param["usmail"]   = $_POST["usmail"];
$param["uspass"]   = $_POST["uspass"];

$abm->registrar($param);

header("Location: ../Vista/login/login.php?ok=1");
