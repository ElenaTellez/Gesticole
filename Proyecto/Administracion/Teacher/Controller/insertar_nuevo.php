<?php
require_once '../Model/GesticoleDB.php';
require_once '../Model/Teacher.php';

$profesorAux = new Teacher($_POST['dniNuevo'],$_POST['nombreNuevo'],$_POST['direccionNueva'],$_POST['telefonoNuevo'],$_POST['actividadNueva']);
$profesorAux->insert();

include "../View/lista_tabla.php";
?>

