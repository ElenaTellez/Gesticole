<?php
try {
                $conexion = new PDO("mysql:host=mysql.hostinger.es;dbname=u368726118_gesti;charset=utf8", "u368726118_root", "gesti_root");
            } catch (PDOException $e) {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die("Error: " . $e->getMessage());
            }
 ?>
 
 <tr class="filaNueva">
    <td>
        Dni: <input type="text" id="dniNuevo" name="dni" size="10" maxlength="9"  pattern="^[0-9]{8}[A-Z]{1}" title="El dni debe tener 8 números y 1 letra." autofocus>
    </td>
    <td>
        Nombre: <input type="text" id="nombreNuevo" name"nombre">
    </td> 
     <td>
        Colegio:  
        <select id="colegioNuevo">
        <?php
        $consulta3 = $conexion->query("SELECT idColegio, Nombre FROM colegio ORDER BY idColegio");
        while ($fila = $consulta3->fetchObject()){
            ?>
       <option value="<?=$fila->idColegio?>"><?=$fila->Nombre?></option>
        <?php } ?>
         </select>
    </td>
    <td>
        Edad: <input type="text" id="edadNueva" size="10" maxlength="10" name="edad">  
    </td>
    <td>
        Curso: <input type="text" id="cursoNuevo" size="1" maxlength="1" name="curso">
    </td>
    <td>
        Actividad:  
        <select id="actividadNueva">
        <?php
        $consulta2 = $conexion->query("SELECT nomActiv, idActividad FROM actividad ORDER BY idActividad");
        while ($fila2 = $consulta2->fetchObject()){
            ?>
       <option value="<?=$fila2->idActividad?>"><?=$fila2->nomActiv?></option>
        <?php } ?>
        </select>
    </td>
    <td>
        <br>
        <img id="guardarnuevo" src="../Alumno/images/floppy.png" width="35" height="35" alt="Guardar">    
    </td>
    <td>
        <br>
        <img id="cancelarnuevo" src="../Alumno/images/borrar.png" width="35" height="35" alt="Cancelar">
    </td> 
    </tr>
    
 
    <script>
    $(document).ready(function () {
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };


    $(function () {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#edadNueva").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "2000:2017"
        });
    });

  
  });
   </script> 