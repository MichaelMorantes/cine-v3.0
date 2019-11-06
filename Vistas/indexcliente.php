<!-- Index -->
<div class="card">
    <div class="card-header"> 
    Listado de Clientes
        <div class="float-right">
            <button class="btn btn-primary btn-sm" id="nuevo" title="Nuevo cliente"><i class="fa fa-plus" aria-hidden="true"></i></button> 
        </div>
    </div>
    <div class="card-body">
        <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Tienda</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Fecha creación</th>
                    <!-- <th>Estado</th> -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>	
            </tbody>
        </table>
    </div><!-- /.box-body -->  
    <script src="Funciones/funcionesCliente.js"></script>
</div><!-- /.cliente -->
<script>
    $(document).ready(cliente);
</script>

<!-- Modal Nuevo -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Agregar nuevo cliente</h4>	
      </div>
      <form id="nuevoform">
        <div class="modal-body">
            <fieldset>
                <input type="hidden" class="customer_id" id="customer_id" value="" name="customer_id"/>
            </fieldset>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="store_id" class="col-lg-3 col-form-label form-control-label">ID Tienda</label>
                <div class="col-lg-8">
                    <select class="form-control store_id" id="store_id" name="store_id">
                    
                    </select>		
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="first_name" class="col-lg-3 col-form-label form-control-label">Nombres</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control first_name" id="first_name" name="first_name" placeholder="Ingrese nombre">	
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="last_name" class="col-lg-3 col-form-label form-control-label">Apellidos</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control last_name" id="last_name" name="last_name" placeholder="Ingrese apellido">		
                </div>
            </div>
            <div class="form-group row">  
                <div class="col-lg-1">
                </div>
                <label for="email" class="col-lg-3 col-form-label form-control-label">Email</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control email" id="email" name="email" placeholder="Ingrese email">	
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="country_id" class="col-lg-3 col-form-label form-control-label">País</label>
                <div class="col-lg-8">
                    <select class="form-control country_id" id="country_id" name="country_id">
                    
                    </select>		
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="city_id" class="col-lg-3 col-form-label form-control-label">Ciudad</label>
                <div class="col-lg-8">
                    <select class="form-control city_id" id="city_id" name="city_id">
                    
                    </select>		
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="address_id" class="col-lg-3 col-form-label form-control-label">Dirección</label>
                <div class="col-lg-8">
                    <select class="form-control address_id" id="address_id" name="address_id">
                    
                    </select>		
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-1">
                </div>
                <label for="f_crea_nuevo" class="col-lg-4 col-form-label form-control-label">Fecha creación</label>
                <div class="col-lg-7">
                    <div class="input-group date f_crea_nuevo" id="f_crea_nuevo" data-target-input="nearest">
                        <div class="input-group-append" data-target="#f_crea_nuevo" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" name="create_date"  placeholder="Click calendario" data-target="#f_crea_nuevo"/>
                    </div>		
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
            <h4 class="modal-title" id="exampleModalLabel">Editar cliente</h4>
            </div>
            <form id="editarform">
                <div class="modal-body">
                    <div class="form-group row">  
                        <div class="col-lg-1">
                        </div>
                        <label for="customer_id" class="col-lg-4 col-form-label form-control-label">Codigo cliente</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control customer_id" id="customer_id" name="customer_id" readonly="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>
                        <label for="store_id" class="col-lg-3 col-form-label form-control-label">ID Tienda</label>
                        <div class="col-lg-8">
                            <select class="form-control store_id" id="store_id" name="store_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>
                        <label for="first_name" class="col-lg-3 col-form-label form-control-label">Nombres</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control first_name" id="first_name" name="first_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>
                        <label for="last_name" class="col-lg-3 col-form-label form-control-label">Apellidos</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control last_name" id="last_name" name="last_name">	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>  
                        <label for="email" class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control email" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>
                        <label for="country_ide" class="col-lg-3 col-form-label form-control-label">País</label>
                        <div class="col-lg-8">
                            <select class="form-control country_ide" id="country_ide" name="country_ide">
                            
                            </select>		
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>
                        <label for="city_ide" class="col-lg-3 col-form-label form-control-label">Ciudad</label>
                        <div class="col-lg-8">
                            <select class="form-control city_ide" id="city_ide" name="city_ide">
                            
                            </select>		
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>
                        <label for="address_id" class="col-lg-3 col-form-label form-control-label">Dirección</label>
                        <div class="col-lg-8">
                            <select class="form-control address_id" id="address_id" name="address_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>
                        <label for="f_crea_editar" class="col-lg-4 col-form-label form-control-label">Fecha creación</label>
                        <div class="col-lg-7">
                            <div class="input-group date f_crea_editar" id="f_crea_editar" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="create_date" placeholder="Click calendario" data-target="#f_crea_editar"/>
                                <div class="input-group-append" data-target="#f_crea_editar" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
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