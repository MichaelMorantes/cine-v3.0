<!-- Index -->
<div class="card">
  <div class="card-header"> 
    Listado de Inventarios
    <div class="float-right">
        <button class="btn btn-primary btn-sm" id="nuevo" title="Nueva registro"><i class="fa fa-plus" aria-hidden="true"></i></button> 
    </div>
  </div>
    <div class="card-body">
        <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelicula</th>
                    <th>Tienda</th>
                    <th>Ultima modificación</th>
                    <!-- <th>Estado</th> -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>	
            </tbody>
        </table>
    </div><!-- /.box-body -->  
    <script src="Funciones/funcionesInventario.js"></script>
    </div><!-- /.tiendas -->
    <script>
      $(document).ready(inventario);
  </script>

<!-- Modal Nuevo -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Agregar registro</h4>
      </div>
      <form id="nuevoform">
        <div class="modal-body">
          <fieldset>
          <input type="hidden" class="inventory_id" id="inventory_id" value="" name="inventory_id"/>
          </fieldset>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="film_id" class="col-lg-2 col-form-label form-control-label">Pelicula</label>
            <div class="col-lg-9">
              <select class="form-control film_id" id="film_id" name="film_id">
                
              </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="store_id" class="col-lg-2 col-form-label form-control-label">Tienda</label>
            <div class="col-lg-9">
              <select class="form-control store_id" id="store_id" name="store_id">
                
              </select>	
            </div>
          </div>
          <fieldset>
              <input type="hidden" id="nuevo" value="nuevo" name="accion"/>
          </fieldset>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" id="btnnuevo" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Editar inventario</h4>
      </div>
      <form id="editarform">
        <div class="modal-body">
          <div class="form-group row">
          <div class="col-lg-1">
          </div> 
          <label for="inventory_id" class="col-lg-4 col-form-label form-control-label">Codigo inventario</label>
            <div class="col-lg-3">
              <input type="text" class="form-control inventory_id" id="inventory_id" name="inventory_id" readonly="true">
            </div>
          </div>
          <div class="form-group row">
          <div class="col-lg-1">
          </div>
          <label for="film_id" class="col-lg-2 col-form-label form-control-label">Pelicula</label>
            <div class="col-lg-8">
              <select class="form-control film_id" id="film_id" name="film_id">
              
              </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="store_id" class="col-lg-2 col-form-label form-control-label">Tienda</label>
              <div class="col-lg-8">
                <select class="form-control store_id" id="store_id" name="store_id">
                    
                </select>	
              </div>
          </div>
          <fieldset>
            <input type="hidden" id="editar" value="editar" name="accion"/>
          </fieldset>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-warning" id="btnactualizar" >Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>