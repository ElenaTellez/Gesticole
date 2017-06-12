<?php
try {
                $conexion = new PDO("mysql:host=mysql.hostinger.es;dbname=u368726118_gesti;charset=utf8", "u368726118_root", "gesti_root");
            } catch (PDOException $e) {
                echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
                die("Error: " . $e->getMessage());
            }
$consulta2 = $conexion->query("SELECT dni, nombre FROM profesor ORDER BY nombre");
?>

<table>
    <tr>
        <td>
            <label align="center">Buscar por Dni</label>
                <select id="idtipo"> 
                    <option value="">------</option>
                        <?php                      
                        while ($fila2 = $consulta2->fetchObject()) {
                        ?>
                        <option value="<?= $fila2->dni ?>"
                        <?php if (!empty($_POST["dni"]) && $_POST["dni"] == $fila2->dni) echo ' selected="selected" ' ?>
                                ><?= $fila2->dni ?></option>
                    <?php } ?>
                </select>    
                <input id="filtrar" type="button" value="Filtrar por DNI"/>
           
        </td>
        <td>
            <label align="center">Buscar por profesor:</label> <input type="text" id="buscausuario" value="">
        </td>   
        <td>
            <a href="#" id ="nuevo"><img src="View/images/anadir.png" width="35" height="35" title="AgregarNuevo"></a>
        </td>     
    </tr>
</table>