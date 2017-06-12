<?php
error_reporting(E_ALL ^ E_NOTICE); //no muestra error de variables indefinida
session_start(); // Inicia la sesión
try {
                $conexion = new PDO("mysql:host=mysql.hostinger.es;dbname=u368726118_gesti;charset=utf8", "u368726118_root", "gesti_root");
            } catch (PDOException $e) {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die("Error: " . $e->getMessage());
            }

//---------------------------------------------------------------------------
//-PAGINACION-------------------------------------------------------------
//Constante con el número de regitros por página:
$numFilaPorPag = 5;
$paginaactual = 1;

//En caso de que no me llegen parámetros de paginación
//Inicializamos valores de la paginación como página 1
if (empty($_GET["page"]) || ($_GET["page"] == 1)) {
  $pagcomienzo = 0;
} else {
  $pagcomienzo = (($_GET["page"] - 1) * $numFilaPorPag);
  $paginaactual = $_GET["page"];
} 

$listadoProfesores = "SELECT a.dni, a.nombre, a.direccion, a.telefono, a.idActividad, b.idActividad, b.nomActiv FROM profesor a, actividad b WHERE a.idActividad=b.idActividad";


//$listadoProfesores = "SELECT a.dni, a.nombre, a.direccion, a.telefono, a.actividad  FROM profesor a   ";


//Filtra por input
if (!empty($_POST["dni"])) {
    sleep(1); //simula retraso de 1 seg en servidor
    $listadoProfesores .=  " and a.dni='" . $_POST["dni"] . "' ";
}

//Consulta en función de nombre de colegio
if (!empty($_GET["busquedausuario"])) {   
    $listadoProfesores .= " and
     a.nombre LIKE '%" . $_GET["busquedausuario"] . "%' ";
}

//Ordena por click en los th
//Si llega el parametro ordenapor se ordena por ese campo

if (empty($_POST["ordenapor"])) {
    $listadoProfesores .= " ORDER BY a.nombre asc ";
} else {
    sleep(1); //simula retraso de 1 seg en servidor
    $ordena = "nomActiv";
    $listadoProfesores .= " ORDER BY $ordena desc ";
}

//PAGINACION---------------------------------------------------------------------------   
//saca listado de 5 alumnos por pagina

$paginacion = " LIMIT " . $pagcomienzo . "," . $numFilaPorPag;
$consulta = $conexion->query($listadoProfesores . $paginacion);

//---------------------------------------------------------------------------

if ($consulta->rowCount() > 0) {
    ?>
 
    <table id="tabladatos" class="table table-responsive">
        <tr data-tabla="profesor">
            <th> DNI</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th class="ordena" name="actividad">Actividad</th>
            <th></th>
            <th></th>
        </tr>

        <?php
        while ($unProfesor = $consulta->fetchObject()) {
            ?>
            <tr id="dni_<?= $unProfesor->dni ?>" data-id="<?= $unProfesor->dni ?>" data-tabla="profesor">
                <td class="dni"><?= $unProfesor->dni ?></td>
                <td class="nombre"><?= $unProfesor->nombre ?></td>
                <td class="direccion"><?= $unProfesor->direccion ?></td>
                <td class="telefono"><?= $unProfesor->telefono ?></td>
                <td class="actividad" data-cod="<?= $unProfesor->idActividad ?>"><?= $unProfesor->nomActiv?></td>
                <td>            
                    <a class="borrar btn btn-danger glyphicon glyphicon-trash" title="Eliminar"></a>

                </td>
                <td> 
                    <a class="modificar btn btn-danger glyphicon glyphicon-pencil" title="Modificar"></a> 
                </td>            
            </tr>

            <?php
        }
        ?>
    </table>
    
    <?php
}//while
?> 
<div class="text-center"> Profesores por pagina: <?php echo $consulta->rowCount() ?></div>

<div class="text-center">  
  <ul  class="pagination">
    <?php if ($paginaactual != 1) { ?>
      <li><a href="#" data-page="1" data-tabla="profesor">Primero</a></li>
      <li><a href="#" data-page="<?php echo ($paginaactual - 1) ?>" data-tabla="profesor"><<</a></li>
      <?php
    }
     
    //Cuantas páginas
    $consultaSinPaginacion = $conexion->query($listadoProfesores);
    $numfilas = $consultaSinPaginacion->rowCount();
    //obtener el valor entero con intval
    $numpaginas = ceil($numfilas / $numFilaPorPag);
    
    if ($numpaginas <= 3) {
      for ($i = 1; $i <= $numpaginas; $i++) {
        ?>  
        <li><a href="#" data-tabla="profesor" data-page="<?php echo $i ?>" 
          <?php if ($i == $paginaactual) { ?> 
                 style="background: #337ab7; color: white" <?php }
    ?>> <!--ciera la etiqueta a-->
            <?php echo $i ?></a></li>
        <?php
      }
    } else if ($paginaactual < $numpaginas - 2) {
      if ($paginaactual > $numpaginas - $paginaactual) {
        ?>
        <li><a href="#" data-page="1" data-tabla="profesor"> 1 </a></li>
        <li><a href="#" data-page="<?php echo $paginaactual ?>" data-tabla="profesor"> ... </a></li>
        <?php
      }
      for ($i = 1; $i <= $paginaactual + 2; $i++) {
        ?>  
        <li><a href="#" data-tabla="profesor" data-page="<?php echo $i ?>" 
          <?php if ($i == $paginaactual) { ?> 
                 style="background: #337ab7; color: white" <?php }
    ?>> <!--ciera la etiqueta a-->
            <?php echo $i ?></a></li>
        <?php
      }
    } else if ($paginaactual <= $numpaginas && $paginaactual >= $numpaginas - 2) {
      if ($paginaactual > $numpaginas - $paginaactual) {
        ?>
        <li><a href="#" data-page="1" data-tabla="profesor"> 1 </a></li>
        <li><a href="#" data-page="<?php echo $paginaactual ?>" data-tabla="profesor"> ... </a></li>
        <?php
      }
      for ($i = $paginaactual - 1; $i <= $numpaginas; $i++) {
        ?>  
        <li><a href="#" data-tabla="profesor" data-page="<?php echo $i ?>" 
          <?php if ($i == $paginaactual) { ?> 
                 style="background: #337ab7; color: white" <?php }
    ?>> <!--ciera la etiqueta a-->
            <?php echo $i ?></a></li>
        <?php
      }
    }
    ?>
    <?php
    if ($paginaactual != $numpaginas) {
      if ($paginaactual < $numpaginas - $paginaactual && $numpaginas > 3) {
        ?>
        <li><a href="#" data-page="<?php echo $paginaactual ?>" data-tabla="profesor"> ... </a></li>
        <li><a href="#" data-page="<?php echo $numpaginas ?>" data-tabla="profesor"> <?php echo $numpaginas ?> </a></li>
        <?php
      }
      ?>
      <li><a href="#" data-page="<?php echo ($paginaactual + 1) ?>" data-tabla="profesor"> >> </a></li>
      <li><a href="#" data-page="<?php echo $numpaginas ?>" data-tabla="profesor"> Ultimo </a></li>
      <?php
    }
    ?>
  </ul>
</div>
  