<?php
  require_once '../Model/Castillo.php';
  // Obtiene todos los castillos
  $data['castillos'] = Castillo::getCastillos();
?>

 <!DOCTYPE html>
<html>
     <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PERFIL USUARIO DE ADMINISTRACION GESTICOLE</title> 
    <!-- Todos los plugins JavaScript de Bootstrap y archivos JavaScript individuales--> 
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/jquery.validate.js"></script> 
        <script src="../../js/jquery-ui.js"></script>  <!--Estos dos enlaces son para el cuadro de dialogo-->
        <script src="../../js/funciones.js"></script>
        <link rel="stylesheet" href="../../js/jquery-ui.css">        
    <!--bootstrap-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS de Bootstrap -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">  
    <!--css propio-->        
        <link href="../../css/estilos_admin.css" rel="stylesheet">        
    </head>
    <body>
       
    <?php        
        include "../View/menu.php";     
        include '../View/listado.php'; 
    ?>  
 </body>
</html>