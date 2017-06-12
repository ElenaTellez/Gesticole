<?php
require_once '../Model/Castillo.php';
require_once '../Model/GesticoleDB.php';
?>

<div class="container-fluid" style="margin-top: 25px;">
     <div class="container" class="anadir"> 
          <!-- CAPA DE DIALOGO INSERTAR -->
          <div id="tabladatos"></div>
     </div>
</div>          

<div class="container-fluid" style="margin-left: 50px;">
     <div class="container">
                <table id="tablaCatillos" class="table table-responsive">
                   <?php
                    foreach ($data['castillos'] as $castillo) {
                    ?>
                        <tr id="castillo_<?= $castillo->getId()?>" data-id="<?= $castillo->getId()?>" data-titulo = "<?= $castillo->getTitulo()?>" data-descripcion = "<?= $castillo->getDescripcion()?>"> 
                            <td>
                                <img src="../View/images/<?= $castillo->getImagen() ?>" width="250" class="imagen">
                            </td>
                            <td class="titulo" >
                                <p class="texto"><?= $castillo->getTitulo()?></p> 
                            </td>    
                            <td class="descripcion">    
                                <p class="texto"><?= $castillo->getDescripcion()?></p>
                            </td> 
                            <td> 
                                <a class="borrar btn btn-danger glyphicon glyphicon-trash" title="borrar"></a> 
                            </td>
                            <td> 
                                <a class="modificar btn btn-danger glyphicon glyphicon-pencil" title="modificar"></a>
                            </td>  
                        </tr>     
                     <?php
                    }
                    ?>
                </table>
            </div>
            <!-- CAPA DE DIALOGO ELIMINAR -->
            <div id="dialogoborrar" title="Eliminar Castillo">
                <p>¿Esta seguro que desea eliminar el Castillo?</p>
            </div>
            <!-- CAPA DE DIALOGO MODIFICAR -->
            <div id="dialogomodificar" title="Modificar Castillo">
                <?php include "../Controller/modificaCastillo.php" ?>
            </div>
         
        </div>
  </div>      
       
    
   <script type="text/javascript">

$(document).ready(function () {
 var id; 
                
//DIALOGO DE BORRADO
                $("#dialogoborrar").dialog({
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    buttons: {
                        //BOTON DE BORRAR
                        "Borrar": function () {
                            //Ajax con get
                            $.get("../Controller/borraCastillo.php", {"id": id}, function () {
                                $("#castillo_" + id).fadeOut(500);
                            })//get			
                            //Cerrar la ventana de dialogo				
                            $(this).dialog("close");
                        },
                        "Cancelar": function () {
                            //Cerrar la ventana de dialogo
                            $(this).dialog("close");
                        }
                    }//buttons
                });

                //Evento click que pulsa el boton borrar
                $(document).on("click", ".borrar", function () {
                    //Obtenemos el id a eliminar a traves del atributo id del tr
                    id = $(this).parents("tr").data("id");
                    //Accion para mostrar el dialogo de borrar
                    $("#dialogoborrar").dialog("open");
                });
                
        
//---- NUEVO --------------Boton de nuevo Castillo..... 
                $(document).on("click","#nuevo", function () {
                    $.post("../Controller/nuevoCastillo.php", function (data) {
                         //Añade a la tabla de datos una nueva fila
                        $("#tabladatos").append(data); 
                        $("#tabladatos").removeAttr("style");
                        //Ocultamos boton de nuevo castillo para evitar añadir mas de uno a la vez
                        $("#nuevo").hide(); 
                    })//get	
                }); 
                 
                 $(document).on("click","#cerrar", function () { 
                     //Elimina la nueva fila creada
                    $(".filaNueva").remove(); 
                    $("#nuevo").show(); 
                });  //Cancelar Nuevo
                
//---- NUEVO --------------Boton de nuevo Castillo de menu responsive..... 
                  $(document).on("click","#nuevoDos", function () {
                    $.post("../Controller/nuevoCastillo.php", function (data) {
                         //Añade a la tabla de datos una nueva fila
                        $("#tabladatos").append(data); 
                        $("#tabladatos").removeAttr("style");
                        //Ocultamos boton de nuevo castillo para evitar añadir mas de uno a la vez
                        $("#nuevoDos").hide(); 
                    })//get	
                }); 
                 
                 $(document).on("click","#cerrar", function () { 
                     //Elimina la nueva fila creada
                    $(".filaNueva").remove(); 
                    $("#nuevoDos").show(); 
                });  //Cancelar Nuevo 


//-------------------------------------//MODIFICAR-------------- 
                $("#dialogomodificar").dialog({
                    autoOpen: false,
                    resizable: true,
                    modal: true,
                    buttons: {
                        "Guardar": function () {

                            var titulo = $("#tituloNuevo").val();
                            var descripcion =  $("#descripcionNueva").val(); 
                            $.post("grabaCastilloModificado.php", {
                                
                                id: id,
                                titulo: titulo,
                                descripcion: descripcion

                            }, function (data, status) {
                                $("#contenedor").html(data);
                                 window.location.reload();

                            })//get			

                            $(this).dialog("close");
                           
                            
                        },
                        "Cancelar": function () {
                            $(this).dialog("close");
                        }
                    }//buttons
                });      

                 //Boton Modificar	
                $(document).on("click", ".modificar", function () {  
                    id = $(this).parents("tr").data("id"); 
                    var titulo = $(this).parents("tr").data("titulo"); 
                    var descripcion = $(this).parents("tr").data("descripcion");     
                //Rescato los valores del objeto seleccionado y lo asigno a los imput del dialog            
                    $("#idNuevo").val(id);            
                    $("#tituloNuevo").val(titulo);
                    $("#descripcionNueva").val(descripcion);                    
                    //Muestro el dialogo
                    $("#dialogomodificar").dialog("open");
                });    
       });//ready

        </script>   
</html>
