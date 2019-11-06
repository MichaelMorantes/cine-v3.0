<!-- Index -->
<div class="card">
  <div class="card-header"> 
    Listado de Prestamos
    <div class="float-right">
        <button class="btn btn-primary btn-sm" id="nuevo" title="Nuevo prestamo"><i class="fa fa-plus" aria-hidden="true"></i></button> 
    </div>
</div>
    <div class="card-body">
        <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha renta</th>
                    <th>Inventario</th>
                    <th>Cliente</th>
                    <th>Fecha retorno</th>
                    <th>Empleado</th>
                    <th>Ultima modificación</th>
                    <!-- <th>Estado</th> -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>	
            </tbody>
        </table>
    </div><!-- /.box-body -->  
    <script src="Funciones/funcionesPrestamo.js"></script>
    </div><!-- /.rental -->
    <script>
      $(document).ready(prestamo);
  </script>

<!-- Modal Nuevo -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Agregar nuevo prestamo</h4>
            </div>
            <form id="nuevoform">
                <div class="modal-body">
                    <fieldset>
                        <input type="hidden" class="rental_id" id="rental_id" value="" name="rental_id"/>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>  
                        <label for="inventory_id" class="col-lg-4 col-form-label form-control-label">ID Inventario</label>
                        <div class="col-lg-6">
                            <select class="form-control inventory_id" id="inventory_id" name="inventory_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>  
                        <label for="customer_id" class="col-lg-4 col-form-label form-control-label">Cliente</label>
                        <div class="col-lg-6">
                            <select class="form-control customer_id" id="customer_id" name="customer_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>  
                        <label for="staff_id" class="col-lg-4 col-form-label form-control-label">Empleado</label>
                        <div class="col-lg-6">
                            <select class="form-control staff_id" id="staff_id" name="staff_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>  
                        <label for="f_rental_nuevo" class="col-lg-4 col-form-label form-control-label">Fecha prestamo</label>
                        <div class="col-lg-7">
                            <div class="input-group date f_rental_nuevo" id="f_rental_nuevo" data-target-input="nearest">
                                <div class="input-group-append" data-target="#f_rental_nuevo" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control datetimepicker-input" placeholder="Click calendario" name="rental_date" data-target="#f_rental_nuevo"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div>  
                        <label for="f_return_nuevo" class="col-lg-3 col-form-label form-control-label">Fecha retorno</label>
                        <div class="col-lg-8">
                            <div class="input-group date f_return_nuevo" id="f_return_nuevo" data-target-input="nearest">
                            <div class="input-group-append" data-target="#f_return_nuevo" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                                <input type="text" class="form-control datetimepicker-input" placeholder="Click calendario" name="return_date" data-target="#f_return_nuevo"/>
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
            <h4 class="modal-title" id="exampleModalLabel">Editar prestamo</h4>
            </div>
            <form id="editarform">
                <div class="modal-body">
                    <div class="form-group row"> 
                        <div class="col-lg-1">
                        </div>  
                        <label for="rental_id" class="col-lg-4 col-form-label form-control-label">Codigo prestamo</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control rental_id" id="rental_id" name="rental_id" readonly="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div> 
                        <label for="inventory_id" class="col-lg-4 col-form-label form-control-label">ID Inventario</label>
                        <div class="col-lg-6">
                            <select class="form-control inventory_id" id="inventory_id" name="inventory_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div> 
                        <label for="customer_id" class="col-lg-4 col-form-label form-control-label">Cliente</label>
                        <div class="col-lg-6">
                            <select class="form-control customer_id" id="customer_id" name="customer_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div> 
                        <label for="staff_id" class="col-lg-4 col-form-label form-control-label">Empleado</label>
                        <div class="col-lg-6">
                            <select class="form-control staff_id" id="staff_id" name="staff_id">
                            
                            </select>	
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div> 
                        <label for="f_rental_editar" class="col-lg-4 col-form-label form-control-label">Fecha prestamo</label>
                        <div class="col-lg-7">
                            <div class="input-group date f_rental_editar" id="f_rental_editar" data-target-input="nearest">
                                <div class="input-group-append" data-target="#f_rental_editar" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control datetimepicker-input" placeholder="Click calendario" name="rental_date" data-target="#f_rental_editar"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1">
                        </div> 
                        <label for="f_return_editar" class="col-lg-3 col-form-label form-control-label">Fecha retorno</label>
                        <div class="col-lg-8">
                            <div class="input-group date f_return_editar" id="f_return_editar" data-target-input="nearest">
                                <div class="input-group-append" data-target="#f_return_editar" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control datetimepicker-input" placeholder="Click calendario" name="return_date" data-target="#f_return_editar"/>
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