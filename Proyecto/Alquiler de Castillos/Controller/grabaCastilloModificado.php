 <?php
  require_once '../Model/Castillo.php';
  
  $castilloAux = new Castillo($_POST['id'],$_POST['titulo'],"", $_POST['descripcion']);
  
  $castilloAux-> update();  
