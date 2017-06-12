$(document).ready(function() {
    var idtipo;
    var dni;
    var ordenapor;

    //VENTANA DIALOGO DE BORRAR
    $("#dialogoborrar").dialog({
        autoOpen: false,
        resizable: false,
        modal: true,
        buttons: {
            "Borrar": function() {
                $.get("Controller/eliminar.php", { dni: dni }, function() {
                    $("#dni_" + dni).fadeOut(1000);
                     $.get("View/lista_tabla.php", function(data) {
                        $("#contenedor").html(data);
                    }); 
                });
                //get cierra ventana dialogo				
                $(this).dialog("close");
            },
            "Cancelar": function() {
                $(this).dialog("close");
            } 
        } //buttons 
    });
    //---------------------------------------------
    //BORRAR
    $(document).on("click", ".borrar", function() {
        dni = $(this).parents("tr").data("id"); 
        $("#dialogoborrar").dialog("open");
    });

    //---- NUEVO --------------
    //Boton de añadir nuevo crea nueva fila al final de la tabla Con dos nuevos botones (guardarnuevo y cancelarnuevo)

    $(document).on("click", "#nuevo", function() {
        $.post("View/formulario_profesor_nuevo.php", function(data) {
                //Añade a la tabla de datos una nueva fila
                $("#tabladatos").prepend(data);
                //Ocultamos boton de nuevo inmueble para evitar añadir mas de uno a la vez
                $("#nuevo").hide();
                $("#oculto").fadeOut(1000);
            }) //get	
    });

    //Boton de cancelar nuevo
    $(document).on("click", "#cancelarnuevo", function() {
        //Elimina la nueva fila creada
        $(".filaNueva").remove();
        //vuelve a mostrar el botón de nuevo
        $("#nuevo").show();
        $("#oculto").fadeIn("slow");
    });

    //Boton de guardar nuevo
    $(document).on("click", "#guardarnuevo", function() {      
        dni=$("#dniNuevo").val(); 
        nombre=$("#nombreNuevo").val(),
        direccion=$("#direccionNueva").val(), 
        telefono=$("#telefonoNuevo").val(),
        actividad=$("#actividadNueva").val()
        
        if ((dni=="") || (nombre=="") || (direccion=="")||(telefono=="")||(actividad=="")) {
            alert("Por favor, rellene todos los campos."); 
        } else {
        $.post("Controller/insertar_nuevo.php", {
                "dniNuevo": dni,
                "nombreNuevo": nombre,
                "direccionNueva": direccion,
                "telefonoNuevo": telefono,
                "actividadNueva": actividad
            }, function(data) {
                //Pinta de nuevo la tabla
                $.get("View/lista_tabla.php", function(data) {
                    $("#contenedor").html(data); 
                });
                //Vuelve a mostrar el boton de nuevo
                $("#nuevo").show();
                $("#oculto").show();
            }) //post	
        } 
    });
    //---------------------------------------------------
    //MODIFICAR
    $("#dialogomodificar").dialog({  
        autoOpen: false,
        resizable: false,
        modal: true,
        buttons: { 
            "Guardar": function() {
                $.post("Controller/modificado.php", { 
                        dniModificar: $("#dniModificar").val(),
                        nombreModificar: $("#nombreModificar").val(),
                        direccionModificar: $("#direccionModificar").val(),
                        telefonoModificar: $("#telefonoModificar").val(),
                        actividadModificar: $("#actividadModificar").val()
                    }, function(data, status) {
                        $("#contenedor").html(data);
                    }) //get			

                $(this).dialog("close");
            },
            "Cancelar": function() {
                $(this).dialog("close");
            }
        } //buttons
    });
    //Boton Modificar	
    $(document).on("click", ".modificar", function() {
        //Obtenemos el id de la fila
        id = $(this).parents("tr").data("id");
        //Para que ponga cada campo con su valor
        $("#dniModificar").val($(this).parent().siblings("td.dni").html());
        $("#nombreModificar").val($(this).parent().siblings("td.nombre").html());
        $("#direccionModificar").val($(this).parent().siblings("td.direccion").html());
        $("#telefonoModificar").val($(this).parent().siblings("td.telefono").html());
        $("#actividadModificar").val($(this).parent().siblings("td.actividad").attr("data-cod")); 
        //Muestro el dialogo
        $("#dialogomodificar").dialog("open");
    });
    //Ordenar pulsando th
    //-------------------------------------------------------

    $(document).on("click", ".ordena", function() { 
        //obtener el ordenapor
        ordenadelth = $(this).attr("name");
        $.ajax({
            url: "View/lista_tabla.php",
            data: { ordenapor: ordenadelth },
            type: "post",
            beforeSend: cargar,
            success: rellenar,
            complete: final,
            cache: false
        });
    });
    //Se ejecuta en el tiempo de espera del servidor
    function cargar() {
        //Muestra el gráfico de cargar
        var cargando = '<span><img src="images/loader.gif" id="cargando" /></span>';
        $("#contenedor").html(cargando);
    }

    function rellenar(data) {
        $("#contenedor").html(data);
    }

    //Una vez cargado vuelve a ocultar el gif animado			
    function final() {
        $("#cargando").hide();
    }
    //----------------------------------------------------
    //AUTOCOMPLETADO
    $(document).on("keypress keyup", "#buscausuario", function() {
        $("#idtipo").val("");//dejo sin valor el otro input que busca por DNI
        var valor = $("#buscausuario").val();
        $.get("View/lista_tabla.php", {
                busquedausuario: valor
            },
            function(data) {
                //vuelve a pintar el listado
                $("#contenedor").html(data);
            }); //get

    });
    //----------------------------------------------------
    // FILTRAR				
    $(document).on("click", "#filtrar", function() {
        $("#buscausuario").val("");
        ////Cargo en la vble global el tipo seleccionado			
        dni = $("#idtipo").val();
        //Llamo Ajax con la función ajax
        $.ajax({
            url: "View/lista_tabla.php",
            data: { dni: dni },
            type: "post",
            beforeSend: cargar,
            success: filtratabla,
            complete: fin,
            cache: false
        }); //ajax														

    });
    //Se ejecuta en el tiempo de espera del servidor
    function cargar() {
        //Muestra el gráfico de cargar
        var cargando = '<span><img src="View/images/loader.gif" id="cargando" /></span>';
        $("#contenedor").html(cargando);
    }

    //Cargar en el contenedor el resultado de la tabla con filtro				
    function filtratabla(data) {
        $("#contenedor").html(data);
    }

    //Una vez cargado vuelve a ocultar el gif animado			
    function fin() {
        $("#cargando").hide();
    }

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

    $(function() {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#edad").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "2000:2017"
        });
    });

    $(function() {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#edadNueva").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "2000:2017"
        });
    });

    $(function() {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#edadModificar").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "2000:2017"
        });
    });


    //--- PAGINACION -----
    $(document).on("click", ".pagination li a", function() {
        var numpage = $(this).data("page");
        tabla = $(this).data("tabla");
        if (tabla == "profesor") {
            $.get("View/lista_tabla.php", { page: numpage }, function(data) {
                $("#contenedor").html(data);
            });
        }
    }); 
});