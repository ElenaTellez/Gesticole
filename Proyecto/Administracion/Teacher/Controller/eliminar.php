<?php
require_once '../Model/GesticoleDB.php';
require_once '../Model/Teacher.php';

    $profesorAux = new Teacher($_GET['dni']);
    $profesorAux->delete();
?>
