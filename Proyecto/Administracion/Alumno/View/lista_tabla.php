<?php 

error_reporting(E_ALL ^ E_NOTICE); //no muestra error de variables indefinida
session_start(); // Inicia la sesión 

try {
                $conexion = new PDO("mysql:host=mysql.hostinger.es;dbname=u368726118_gesti;charset=utf8", "u368726118_root", "gesti_root");
            } catch (PDOException $e) {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die("Error: " . $e->getMessage());
            }

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

$listadoAlumnos = "SELECT a.dni, a.nombre, a.idColegio, a.edad, a.curso, a.idActividad, b.idActividad, b.nomActiv as actividad, c.idColegio, c.Nombre as nomColegio FROM alumno a, actividad b, colegio c
WHERE a.idActividad = b.idActividad and a.idColegio = c.idColegio";



//Filtra por input
if (!empty($_POST["id"])) {
    sleep(1); //simula retraso de 1 seg en servidor
    $listadoAlumnos .=  " and a.dni='" . $_POST["id"] . "' ";
}

//Consulta en función de nombre de colegio
if (!empty($_GET["busquedausuario"])) {
    $listadoAlumnos .= " and c.Nombre LIKE '%" . $_GET["busquedausuario"] . "%' ";
}

//Ordena por click en los th
//Si llega el parametro ordenapor se ordena por ese campo

if (empty($_POST["ordenapor"])) {
    $listadoAlumnos .= " ORDER BY nombre asc ";
} else if ($_POST["ordenapor"] == "actividad") {
    sleep(1); //simula retraso de 1 seg en servidor
    $ordena = "actividad";
    $listadoAlumnos .= " ORDER BY $ordena desc ";
} else if ($_POST["ordenapor"] == "nombre") {
    sleep(1); //simula retraso de 1 seg en servidor
    $ordena = "nombre";
    $listadoAlumnos .= " ORDER BY $ordena asc";
} else {
    sleep(1); //simula retraso de 1 seg en servidor
    $ordena = "curso";
    $listadoAlumnos .= " ORDER BY $ordena asc";
}

//PAGINACION---------------------------------------------------------------------------   
//saca listado de 5 alumnos por pagina

$paginacion = " LIMIT " . $pagcomienzo . "," . $numFilaPorPag;
$consulta = $conexion->query($listadoAlumnos . $paginacion);

//---------------------------------------------------------------------------

if ($consulta->rowCount() > 0) {
    ?>
    
    <table id="tabladatos" class="table table-responsive">
        <tr data-tabla="alumno">
            <th name="dni">DNI</th>
            <th class="ordena" name="nombre">Nombre</th>
            <th name="colegio">Colegio</th>
            <th name="edad">Edad</th>
            <th class="ordena" name="curso">Curso</th>
            <th class="ordena" name="actividad">Actividad</th>
            <th> </th>
            <th></th>
        </tr> 
        <?php
        while ($unAlumno = $consulta->fetchObject()) {
            ?>
            <tr id="dni_<?= $unAlumno->dni ?>" data-id="<?= $unAlumno->dni ?>" data-tabla="alumno">
                <td class="dni"><?= $unAlumno->dni ?></td>
                <td class="nombre"><?= $unAlumno->nombre ?></td>
                <td class="colegio" value="<?= $unAlumno->idColegio ?>"><?= $unAlumno->nomColegio ?></td>
                <td class="edad"><?= $unAlumno->edad ?></td>
                <td class="curso"><?= $unAlumno->curso ?></td>
                <td class="actividad" value="<?= $unAlumno->idActividad ?>"><?= $unAlumno->actividad ?></td>
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
<div class="text-center"> Alumnos por pagina: <?php echo $consulta->rowCount() ?></div>

<div class="text-center">  
  <ul  class="pagination">
    <?php if ($paginaactual != 1) { ?>
      <li><a href="#" data-page="1" data-tabla="alumno">Primero</a></li>
      <li><a href="#" data-page="<?php echo ($paginaactual - 1) ?>" data-tabla="alumno"><<</a></li>
      <?php
    }
     
    //Cuantas páginas
    $consultaSinPaginacion = $conexion->query($listadoAlumnos);
    $numfilas = $consultaSinPaginacion->rowCount();
    //obtener el valor entero con intval
    $numpaginas = ceil($numfilas / $numFilaPorPag);
    
    if ($numpaginas <= 3) {
      for ($i = 1; $i <= $numpaginas; $i++) {
        ?>  
        <li><a href="#" data-tabla="alumno" data-page="<?php echo $i ?>" 
          <?php if ($i == $paginaactual) { ?> 
                 style="background: #337ab7; color: white" <?php }
    ?>> <!--ciera la etiqueta a-->
            <?php echo $i ?></a></li>
        <?php
      }
    } else if ($paginaactual < $numpaginas - 2) {
      if ($paginaactual > $numpaginas - $paginaactual) {
        ?>
        <li><a href="#" data-page="1" data-tabla="alumno"> 1 </a></li>
        <li><a href="#" data-page="<?php echo $paginaactual ?>" data-tabla="alumno"> ... </a></li>
        <?php
      }
      for ($i = 1; $i <= $paginaactual + 2; $i++) {
        ?>  
        <li><a href="#" data-tabla="alumno" data-page="<?php echo $i ?>" 
          <?php if ($i == $paginaactual) { ?> 
                 style="background: #337ab7; color: white" <?php }
    ?>> <!--ciera la etiqueta a-->
            <?php echo $i ?></a></li>
        <?php
      }
    } else if ($paginaactual <= $numpaginas && $paginaactual >= $numpaginas - 2) {
      if ($paginaactual > $numpaginas - $paginaactual) {
        ?>
        <li><a href="#" data-page="1" data-tabla="alumno"> 1 </a></li>
        <li><a href="#" data-page="<?php echo $paginaactual ?>" data-tabla="alumno"> ... </a></li>
        <?php
      }
      for ($i = $paginaactual - 1; $i <= $numpaginas; $i++) {
        ?>  
        <li><a href="#" data-tabla="alumno" data-page="<?php echo $i ?>" 
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
        <li><a href="#" data-page="<?php echo $paginaactual ?>" data-tabla="alumno"> ... </a></li>
        <li><a href="#" data-page="<?php echo $numpaginas ?>" data-tabla="alumno"> <?php echo $numpaginas ?> </a></li>
        <?php
      }
      ?>
      <li><a href="#" data-page="<?php echo ($paginaactual + 1) ?>" data-tabla="alumno"> >> </a></li>
      <li><a href="#" data-page="<?php echo $numpaginas ?>" data-tabla="alumno"> Ultimo </a></li>
      <?php
    }
    ?>
  </ul>
</div>
  