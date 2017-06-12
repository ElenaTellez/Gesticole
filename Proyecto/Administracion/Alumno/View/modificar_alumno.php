<?php
try {
                $conexion = new PDO("mysql:host=mysql.hostinger.es;dbname=u368726118_gesti;charset=utf8", "u368726118_root", "gesti_root");
            } catch (PDOException $e) {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die("Error: " . $e->getMessage());
            }

 
?>
<form id="formulario" method="POST">
  Dni:<input id="dniModificar" readonly><br>
  Nombre:<input id="nombreModificar" required><br>
  Colegio:<select id="colegioModificar" required>
        <?php
        $consulta3 = $conexion->query("SELECT idColegio, Nombre FROM colegio ORDER BY idColegio");
        while ($fila = $consulta3->fetchObject()){
            ?>
       <option value="<?=$fila->idColegio?>"><?=$fila->Nombre?></option>
        <?php } ?>
         </select><br>
  Edad:<input id="edadModificar" required><br>
  Curso:<input id="cursoModificar" required><br>
  Actividad: <select id="actividadModificar">  
        <?php       
        $consulta2 = $conexion->query("SELECT nomActiv, idActividad FROM actividad ORDER BY idActividad");
        while ($fila2 = $consulta2->fetchObject()){
        ?>
       <option value="<?=$fila2->idActividad?>" name="actividad"><?=$fila2->nomActiv?></option>
<?php } ?>
           </select> 
</form>
 
