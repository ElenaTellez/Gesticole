<?php
require_once '../Model/GesticoleDB.php';
require_once '../Model/Alumno.php';

    $alumnoAux = new Alumno($_GET['dni']);
    $alumnoAux->delete();
?>
