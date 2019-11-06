<!-- Index -->
<div class="card">
  <div class="card-header"> 
    Listado de Paises
    <div class="float-right">
        <button class="btn btn-primary btn-sm" id="nuevo" title="Nueva país"><i class="fa fa-plus" aria-hidden="true"></i></button> 
    </div>
  </div>
  <div class="card-body">
    <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>País</th>
                <th>Ultima modificación</th>
                <!-- <th>Estado</th> -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>	
        </tbody>
    </table>
  </div><!-- /.box-body -->  
  <script src="Funciones/funcionesPais.js"></script>
</div><!-- /.pais -->
<script>
      $(document).ready(pais);
</script>

<!-- Modal Nuevo -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Agregar nuevo país</h4>
      </div>
      <form id="nuevoform">
        <div class="modal-body">
          <fieldset>
          <input type="hidden" class="country_id" id="country_id" value="" name="country_id"/>
          </fieldset>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="country" class="col-lg-2 col-form-label form-control-label">País</label>
            <div class="col-lg-9">
              <input type="text" class="form-control input country" name="country" id="country" placeholder="Ingrese pais">
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
        <h4 class="modal-title" id="exampleModalLabel">Editar país</h4>
      </div>
      <form id="editarform">
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="country_id" class="col-lg-3 col-form-label form-control-label">Codigo país</label>
            <div class="col-lg-3">
              <input type="text" class="form-control text-center country_id" id="country_id" name="country_id" readonly="true">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="country" class="col-lg-2 col-form-label form-control-label">País</label>
            <div class="col-lg-8">
              <input type="text" class="form-control input country" name="country" id="country" placeholder="Ingrese pais">
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