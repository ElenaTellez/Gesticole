<?php 

error_reporting(E_ALL ^ E_NOTICE); //no muestra error de variables indefinida
session_start(); // Inicia la sesión
if(!isset($_SESSION['paginas'])) {
    $_SESSION['paginas'] = 1;
}

?>

<!DOCTYPE html>
<html>
     <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PERFIL USUARIO DE ADMINISTRACION GESTICOLE</title>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/jquery.validate.js"></script>
    <!-- Todos los plugins JavaScript de Bootstrap y archivos JavaScript individuales--> 
        <script src="../../js/funciones.js"></script>        
    <!--Estos dos enlaces son para el cuadro de dialogo-->
        <script src="../../js/jquery-ui.js"></script> 
        <link rel="stylesheet" href="../../js/jquery-ui.css">        
    <!--bootstrap-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS de Bootstrap -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">  
    <!--css propio-->        
        <link href="../../css/estilos_admin.css" rel="stylesheet">         
    </head>
    <body>
        <div class="container-fluid" style="margin-top: 10px;">                
            <div class="container">
                <div id="menu_visible" class="col-xs-6 col-md-4" >
                    <div id="personal" class="jumbotron">
                        <h2 class="text-center">Alumnos</h2>
                    </div> 
                </div>  
                <div id="cambio" title="Abrir menu" class="dropdown">  
                        <div id="personal" class="jumbotron dropdown-content">
                            <a href="../Teacher/index.php" title="Ir a la sección de Profesores">Profesores</a><hr>
                            <a href="../../Alquiler de Castillos/index.php" title="Ir a la sección de Castillos Hinchables">Castillos Hinchables</a><hr>
                            <a href="../index.php" title="Volver al inicio">Inicio</a><hr>
                            <a href="../../index.php" title="Salir del Sistema">Salir</a><hr>
                        </div>
                </div>  
                <div id="menu_visible" class="col-xs-12  col-md-8" >                  
                    <?php include "View/menu.php" ?>    
                </div>                  
            </div>
            
            <div class="container">
                <?php include "View/index_cabecera.php" ?>
            </div>
            
             <!-- CAPA DE DIALOGO ELIMINAR ALUMNO -->
             <div id="dialogoborrar" title="Eliminar Usuario">
                <p>¿Esta seguro que desea eliminar el usuario?</p>
             </div>
                <!-- CAPA DE DIALOGO MODIFICAR ALUMNO -->
                <div id="dialogomodificar" title="Modificar Usuario">
                    <?php include "View/modificar_alumno.php" ?>
                </div> 
             <div id="contenedor" class="container">
                    <?php include "View/lista_tabla.php" ?>
            </div>
        </div>
   </body>
</html>
