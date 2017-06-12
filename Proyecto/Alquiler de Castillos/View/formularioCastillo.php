<div class="col-xs-6  col-md-6 filaNueva">
    <form action="../Controller/grabaCastillo.php"  enctype="multipart/form-data" method="POST">
        <table class="table table-responsive filaNueva">  
            <tr> 
                <td>
                <label>Título</label> 
                <br>
                <input type="text" size="10" name="titulo" required="">
                </td> 
                <td>
                <label>Imagen</label> 
                <input type="file" name="imagen">
                </td> 
                <td>
                <label>Descripción</label>
                <br>
                <textarea name="descripcion" cols="9" rows="2" required="">
                </textarea>
                </td> 
                <td> 
                <br><input type="submit" value="Aceptar"> 
                </td>
                <td>
                <br><input type="reset" value="Cancelar" id="cerrar">
                </td>    
             </tr>
        </table>
     </form>
  </div>
     


