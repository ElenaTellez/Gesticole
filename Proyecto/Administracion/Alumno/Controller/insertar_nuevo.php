<?php
require_once '../Model/GesticoleDB.php';
require_once '../Model/Alumno.php';

$alumnoAux = new Alumno($_POST['dniNuevo'],$_POST['nombreNuevo'],$_POST['colegioNuevo'], $_POST['edadNueva'], $_POST['cursoNuevo'],$_POST['actividadNueva']);
$alumnoAux->insert();

include "../View/lista_tabla.php";
?>

