<!-- Index -->
<div class="card">
  <div class="card-header"> 
    Listado de Tiendas
    <div class="float-right">
      <button class="btn btn-primary btn-sm" id="nuevo" title="Nueva tienda"><i class="fa fa-plus" aria-hidden="true"></i></button> 
    </div>
  </div>
  <div class="card-body">
    <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Admin</th>
                <th>Empleados</th>
                <!-- <th>Estado</th> -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>	
        </tbody>
    </table>
  </div><!-- /.box-body -->  
  <script src="Funciones/funcionesTienda.js"></script>
</div>
  <script>
      $(document).ready(Tienda);
  </script>

<!-- Modal Nuevo -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Agregar nueva tienda</h4>	
      </div>
      <form id="nuevoform">
        <div class="modal-body">
          <fieldset>
              <input type="hidden" class="store_id" id="store_id" value="" name="store_id"/>
          </fieldset>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="country_id" class="col-lg-2 col-form-label form-control-label">País</label>
            <div class="col-lg-9">
            <select class="form-control country_id" id="country_id" name="country_id">
                
            </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="city_id" class="col-lg-2 col-form-label form-control-label">Ciudad</label>
            <div class="col-lg-9">
              <select class="form-control city_id" id="city_id" name="city_id">
              
              </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="address_id" class="col-lg-2 col-form-label form-control-label">Dirección</label>
            <div class="col-lg-9">
              <select class="form-control address_id" id="address_id" name="address_id">
              
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
          <h4 class="modal-title" id="exampleModalLabel">Editar tienda</h4>
        </div>
        <form id="editarform">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-lg-1">
              </div>  
                <label for="store_id" class="col-lg-3 col-form-label form-control-label">Codigo tienda</label>
                <div class="col-lg-3">
                  <input type="text" class="form-control store_id" id="store_id" name="store_id" readonly="true">
                </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-1">
              </div>
                <label for="manager_staff_id" class="col-lg-2 col-form-label form-control-label">Manager</label>
                <div class="col-lg-8">
                  <select class="form-control manager_staff_id" id="manager_staff_id" name="manager_staff_id">
                  
                  </select>	
                </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-1">
              </div> 
              <label for="country_ide" class="col-lg-2 col-form-label form-control-label">País</label>
              <div class="col-lg-8">
              <select class="form-control country_ide" id="country_ide" name="country_ide">
                  
              </select>	
              </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label class="col-lg-2 col-form-label form-control-label">Ciudad</label>
                <div class="col-lg-8">
                  <select class="form-control city_ide" id="city_ide" name="city_ide">
                  
                  </select>	
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="address_id" class="col-lg-2 col-form-label form-control-label">Dirección</label>
                <div class="col-lg-8">
                  <select class="form-control address_id" id="address_id" name="address_id">
                  
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