<!-- Index -->
<div class="card">
  <div class="card-header"> 
    Listado de Roles
    <div class="float-right">
      <button class="btn btn-primary btn-sm" id="nuevo" title="Nuevo rol"><i class="fa fa-plus" aria-hidden="true"></i></button> 
    </div>
  </div><!-- /.categorias -->
  <div class="card-body">
    <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rol</th>
                <!-- <th>Estado</th> -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>	
        </tbody>
    </table>
  </div><!-- /.box-body -->  
  <script src="Funciones/funcionesRol.js"></script>
</div>
  <script>
    $(document).ready(rol);
  </script>

<!-- Modal Nuevo -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Agregar nuevo rol</h4>
      </div>
      <form id="nuevoform">
        <div class="modal-body">
            <fieldset>
              <input type="hidden" class="rol_id" id="rol_id" value="" name="rol_id"/>
            </fieldset>
            <div class="form-group row">
              <div class="col-lg-1">
              </div>
              <label for="rol_name" class="labeltablas col-lg-2 col-form-label form-control-label">Rol</label>
              <div class="col-lg-8">
                <input type="text" class="labeltablas form-control input rol_name" name="rol_name" id="rol_name" placeholder="Ingrese rol">
              </div>
            </div>
            <fieldset>
              <input type="hidden" id="nuevo" value="nuevo" name="accion"/>
            </fieldset>
        </div>
        <div class="modal-footer">
          <button type="button" class="labeltablas btn btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" id="btnnuevo" class="labeltablas btn btn-success" value="Guardar">
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
          <h4 class="modal-title" id="exampleModalLabel">Editar rol</h4>
        </div>
        <form id="editarform">
          <div class="modal-body">
            <div class="form-group row">  
              <div class="col-lg-1">
              </div>
              <label for="rol_id" class="col-lg-3 col-form-label form-control-label">Codigo rol</label>
              <div class="col-lg-2">
                <input type="text" class="form-control text-center rol_id" id="rol_id" name="rol_id" readonly="true">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-1">
              </div>
              <label for="rol_name" class="col-lg-3 col-form-label form-control-label">Rol</label>
              <div class="col-lg-8">
                <input type="text" class="form-control input rol_name" name="rol_name" id="rol_name" placeholder="Ingrese rol">
              </div>
            </div>
            <fieldset>
              <input type="hidden" id="editar" value="editar" name="accion"/>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <input type="submit" id="btnactualizar" class="btn btn-warning" value="Actualizar"/>
          </div>
        </form>
      </div>
    </div>
</div>