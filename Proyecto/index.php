<?php
//si la session esta iniciada la destruye
if(session_start() == true){
  session_destroy();
}
error_reporting(E_ALL ^ E_NOTICE); //no muestra error de variables indefinida
session_start();// Inicia la sesión

if(!isset($_SESSION['usuario']) && !isset($_SESSION['logueado'])) {//comprueba que la variable no esta iniciada.
$_SESSION['usuario'] = " ";
$_SESSION['logueado'] = false;
$_SESSION['tipoUsuario'] = " ";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gesticole</title>
    <!--css propio-->   
        <link rel="stylesheet" type="text/css" href="css/estilos.css" />   
    <!-- Todos los plugins JavaScript de Bootstrap y archivos JavaScript individuales-->
        <script src="bootstrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/funciones_acceso.js"></script>    
    <!--Estos dos enlaces son para el cuadro de dialogo-->
        <script src="js/jquery-ui.js"></script> 
        <link rel="stylesheet" href="js/jquery-ui.css">        
    <!--bootstrap-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">           
    </head>
    <body>
<div id="accesoDos" title="Mostrar/ocultar menú"><a href="#" id="flecha"> </a></div>        
<div id="fijo">  
    <div id="menu">
                 <div><img src="img/bitmap.png" alt="" class="logo"/></div>
                    <ul>
                    <li><a href="#" onclick="$('div.contenido').addClass('oculto');$('#inicio.contenido').removeClass('oculto');">Incio</a></li>   
                    <li><a href="#"  onclick="$('div.contenido').addClass('oculto');$('#deporte.contenido').removeClass('oculto');">Actividades deportivas</a></li>
                    <li><a href="#">Refuerzo educativo</a></li>
                    <li><a href="#">Viaje fin de curso</a></li>					
                    <li><a href="#"  onclick="$('div.contenido').addClass('oculto');$('#castillo.contenido').removeClass('oculto');">Novedad: Alquiler de castillos hinchables</a></li>
                    <li><a href="#"  onclick="$('div.contenido').addClass('oculto');$('#campamento.contenido').removeClass('oculto');">Campamentos de Verano</a></li>
                    <li><a href="#">Contacto</a></li> 
                    <li><a href="#" ><span id="acceso"></span> </a></li>                                        
                </ul>   
    </div>  
 </div>     
<div id="login">
                <div id="formulario">
                    <form id="formularioLogin" action="index.php" method="post">
                        <table>    
                            <tr> 
                                <td>
                                  <input type="reset" value="x"  id="x">
                                </td>                                
                            </tr>
                            <tr> 
                                <td>
                                    <input type="text" size="10" name="usuario" placeholder="Usuario">
                                </td>                                
                            </tr>
                            <tr>                                                   
                                <td><input type="password" size="10" name="contrasena" placeholder="Password"></td>
                            </tr> 
                            <tr>                                                   
                                <td><input type="submit" value="Iniciar sesión" ></td>
                            </tr> 
                        </table>                     
                    </form>
                </div> 
</div>
<div id="contenedor_encabezado">
    <div id="encabezado">
         <div id="galeria">
                <div id="portaFoto">
                    <div class="foto1"></div>
                    <div class="foto2"></div>
                    <div class="foto3"></div>
                    <div class="foto4"></div>
                    <div class="foto1"></div>
                    <div class="foto2"></div>
                    <div class="foto3"></div>
                    <div class="foto4"></div>
                    <div class="foto1"></div>
                    <div class="foto2"></div>
                    <div class="foto3"></div>
                    <div class="foto4"></div>
                    <div class="foto1"></div>
                </div>     
        </div> 
</div>
    
</div>
             <?php
      //comprueba si se establece conexion con mysql
      //incluye la conexion con la base de datos
       try {
                $conexion = new PDO("mysql:host=mysql.hostinger.es;dbname=u368726118_gesti;charset=utf8", "u368726118_root", "gesti_root");
            } catch (PDOException $e) {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die("Error: " . $e->getMessage());
            }
      //con esto se realiza una consulta
      $usuarioBBDD = $conexion -> query("select usuario, clave, tipo from acceso");
    
      $_SESSION['usuario'] = $_POST['usuario'];
      $contraseñaIntroducida = $_POST['contrasena'];
      
   if (!empty( $_POST['usuario']) && !empty( $_POST['contrasena'])){//evita que carge alert al iniciar
            while (($usuario = $usuarioBBDD->fetchObject())) {
                if($usuario->usuario == $_SESSION['usuario'] && $usuario->clave == $contraseñaIntroducida && $usuario->tipo == "administra"){ 
                    $_SESSION['logueado'] = true;
                    $_SESSION['tipoUsuario'] = $usuario->tipo;
                    header("Refresh: 0; url=Administracion/index.php");//esto redirecciona a otra pagina
                    break;
                } else if ($usuario->usuario == $_SESSION['usuario'] && $usuario->clave == $contraseñaIntroducida && $usuario->tipo == "profesor"){
                    $_SESSION['logueado'] = true;
                    $_SESSION['tipoUsuario'] = $usuario->tipo;
                    echo '<script>alert("Contraseña correcta");</script>';
                    break;
                }  else if ($usuario->usuario == $_SESSION['usuario'] && $usuario->clave != $contraseñaIntroducida) {
                    echo '<script>alert("Contraseña Incorrecta");</script>';
                    break;
                }   else if ($usuario->usuario != $_SESSION['usuario']) {
                    echo '<script>alert("Usuario no registrado");</script>';
                    break;
                }   

            }
        }
    ?>      
    </div>
</div>
<div id="inicio" class="flex-container contenido">            
        <div id="izquierda"><img src="img/logo.jpg" alt=""/></div>
        <p id="titulo"><br><h1 style="text-align:center;">GESTICOLE</h1></p><br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><br><br>
</div>
<div id="deporte" class="flex-container contenido oculto">            
        <div id="izquierda"><img src="img/gesti_sport.jpg" alt=""/></div>
        <p id="titulo"><br><h1 style="text-align:center;">ACTIVIDADES DEPORTIVAS</h1></p><br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><br><br>
</div>
              
<div id="campamento" class="flex-container contenido oculto">             
        <div id="titulo"><br><h1 style="text-align:center;">CAMPAMENTOS DE VERANO</h1></div><br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><br><br>
</div>

<div id="castillo" class="flex-container contenido oculto"> 
         <p id="titulo"><br><h1 style="text-align:center;">ALQUILER DE CASTILLOS HINCHABLES</h1></p><br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do   eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad   minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in   voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur   sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt   mollit anim id est laborum.
</p>  <br><br><br>

<div id="muestroFotos1" class="flex-container"> </div>
<div id="muestroFotos2" class="flex-container"> </div>

<div class="container ocultoCarrusel" class="flex-container">  
     <div class="next"><<</div>
        <div class="prev">>></div>   
             
        <div class="carousel">
            <div class="item a"></div>
            <div class="item b"></div>
            <div class="item c"></div>
            <div class="item d"></div>
            <div class="item e"></div>
            <div class="item f"></div>
        </div>    
    </div>
        
</div>     
 
<a class="scrollup" href="#">Scroll</a>   

 
<script>
$(document).ready(function() { 
        $("#formularioLogin").validate({
            onfocusout: true,
            rules: {                
              usuario: "required",
              contrasena: "required"
            },
            messages: {
              usuario: {
                required: "<br>Usuario requerido"
              },
              contrasena: {
                required:  "<br>Contraseña requerida"  
              }
            }
        });        
});

      </script>
                
       


    </body>
</html>

