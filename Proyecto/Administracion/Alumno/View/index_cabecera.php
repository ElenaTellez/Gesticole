<?php
try {
                $conexion = new PDO("mysql:host=mysql.hostinger.es;dbname=u368726118_gesti;charset=utf8", "u368726118_root", "gesti_root");
            } catch (PDOException $e) {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die("Error: " . $e->getMessage());
            }
?>
<table>
    <tr> 
        <td>
            <label align="center">Buscar por DNI</label>
                <select id="idtipo">
                    <option value="">------</option>
                        <?php
                        $consulta2 = $conexion->query("SELECT dni, nombre FROM alumno ORDER BY nombre");
                        while ($fila2 = $consulta2->fetchObject()) {
                        ?>
                        <option value="<?= $fila2->dni ?>"
                        <?php if (!empty($_POST["id"]) && $_POST["id"] == $fila2->dni) echo ' selected="selected" ' ?>
                                ><?= $fila2->dni ?></option>
                    <?php } ?>
                </select>    
                <input id="filtrar" type="button" value="Buscar" />
            
        </td>
        <td>
            <label  align="center">Buscar por Colegio:</label> <input type="text" id="buscausuario">
        </td> 
        <td>
            <a href="#" id="nuevo"><img src="images/anadir.png" width="35" height="35" alt="AgregarNuevo" title="AgregarNuevo"></a>
        </td> 
    </tr>
</table>