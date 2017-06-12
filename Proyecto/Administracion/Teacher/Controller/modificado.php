<?php
require_once '../Model/GesticoleDB.php';
require_once '../Model/Teacher.php';
     
$profesorAux = new Teacher($_POST['dniModificar'],$_POST['nombreModificar'],$_POST['direccionModificar'],$_POST['telefonoModificar'],$_POST['actividadModificar']);
$profesorAux->update();

include "../View/lista_tabla.php";
?>