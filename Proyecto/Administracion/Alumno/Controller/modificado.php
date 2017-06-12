<?php
require_once '../Model/GesticoleDB.php';
require_once '../Model/Alumno.php';
     
$alumnoAux = new Alumno($_POST['dniModificar'],$_POST['nombreModificar'],$_POST['colegioModificar'],$_POST['edadModificar'], $_POST['cursoModificar'],$_POST['actividadModificar']);
$alumnoAux->update();

include "../View/lista_tabla.php";
?>