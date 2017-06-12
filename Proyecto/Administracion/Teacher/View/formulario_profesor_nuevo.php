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
        Dni: <input type="text" id="dniNuevo"  size="10" maxlength="9" pattern="[0-9]{8}[A-Z]{1}" title="El dni debe tener 8 números y 1 letra." autofocus>
    </td>
    <td>
        Nombre: <input type="text" id="nombreNuevo" required>
    </td>
    <td>
        Direccion:<input type="text" id="direccionNueva" required >
    </td>
   <td>
        Telefono: <input type="text" id="telefonoNuevo" size="10" maxlength="9" pattern="[0-9]{9}" title="El telefono debe tener 9 números." >  
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
        <img id="guardarnuevo" src="View/images/floppy.png" width="35" height="35" alt="Guardar">    
    </td>
   <td>
        <br>
        <img id="cancelarnuevo" src="View/images/borrar.png" width="35" height="35" alt="Cancelar">
    </td>

    </tr>
    
 
    