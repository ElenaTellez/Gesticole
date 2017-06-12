<?php
require_once '../Model/Castillo.php'; 
?>


<form id="formulario" method="post">
    Id: <input type="number" id="idNuevo"   value="<?=$castillo->getId()?>" readonly> <br>
    Titulo: <input type="text" name="titulo" size="10" id="tituloNuevo" value="<?= $castillo->getTitulo()?>" required> <br>
    Descripción: <input type="text" id="descripcionNueva" name="descripcion" value="<?= $castillo->getDescripcion() ?>" required> <br>  
</form>

<script>
$(document).ready(function() { 
        $("#formulario").validate({
            onfocusout: true,
            rules: {              
              titulo: "required",
              descripcion: "required"
            },
            messages: {
              titulo: {
                required: "<br>Usuario requerido"
              },
              descripcion: {
                required:  "<br>Contraseña requerida"  
              }
            }
        });        
});

 </script>
 