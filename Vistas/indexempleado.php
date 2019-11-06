<!-- Index -->
<div class="card">
  <div class="card-header"> 
    Listado de Empleados
    <div class="float-right">
        <button class="btn btn-primary btn-sm" id="nuevo" title="Nueva categoría"><i class="fa fa-plus" aria-hidden="true"></i></button> 
    </div>
  </div>
    <div class="card-body">
        <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Tienda</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>	
            </tbody>
        </table>
    </div><!-- /.box-body -->  
    <script src="Funciones/funcionesEmpleado.js"></script>
  </div><!-- /.categorias -->
  <script>
      $(document).ready(empleado);
  </script>

<!-- Modal Nuevo -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Agregar nuevo empleado</h4>
      </div>
      <form id="nuevoform" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <fieldset>
          <input type="hidden" class="staff_id" id="staff_id" value="" name="staff_id"/>
          </fieldset>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="first_name" class="col-lg-2 col-form-label form-control-label">Nombres</label>
            <div class="col-lg-7">
            <input type="text" class="form-control input first_name" name="first_name" id="first_name" placeholder="Ingrese nombre">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="last_name" class="col-lg-2 col-form-label form-control-label">Apellidos</label>
            <div class="col-lg-7">
            <input type="text" class="form-control input last_name" name="last_name" id="last_name" placeholder="Ingrese apellidos">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="country_id" class="col-lg-2 col-form-label form-control-label">País</label>
            <div class="col-lg-6">
            <select class="form-control country_id" id="country_id" name="country_id">
                
            </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="city_id" class="col-lg-2 col-form-label form-control-label">Ciudad</label>
            <div class="col-lg-6">
            <select class="form-control city_id" id="city_id" name="city_id">
                
            </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="address_id" class="col-lg-2 col-form-label form-control-label">Dirección</label>
            <div class="col-lg-6">
            <select class="form-control address_id" id="address_id" name="address_id">
                
            </select>	
            </div>
          </div>
          <div class="form-group row"> 
            <div class="col-lg-1">
            </div>  
            <label for="email" class="col-lg-2 col-form-label form-control-label">Email</label>
            <div class="col-lg-6">
                <input type="text" class="form-control email" id="email" name="email" placeholder="Ingrese email">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="store_id" class="col-lg-2 col-form-label form-control-label">Tienda</label>
            <div class="col-lg-6">
            <select class="form-control store_id" id="store_id" name="store_id">
                
            </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="rol_id" class="col-lg-2 col-form-label form-control-label">Rol</label>
            <div class="col-lg-6">
            <select class="form-control rol_id" id="rol_id" name="rol_id">
                
            </select>	
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="username" class="col-lg-2 col-form-label form-control-label">Username</label>
            <div class="col-lg-6">
            <input type="text" class="form-control input username" name="username" id="username" placeholder="Ingrese usuario">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="password" class="col-lg-2 col-form-label form-control-label">Contraseña</label>
            <div class="col-lg-7">
            <input type="password" class="form-control input password" name="password" id="password" placeholder="Ingrese contraseña">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="password_com" class="col-lg-3 col-form-label form-control-label">Confirmar contraseña</label>
            <div class="col-lg-7">
            <input type="password" class="form-control input password_com" name="password_com" id="password_com" placeholder="Ingrese contraseña">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <div class="col-lg-8">
                <label for="picture" class="col-form-label form-control-label">Seleccione la foto de usuario</label>
                <input name="picture" type="file" class="form-control-file picture" id="picture">
            </div>
          </div>
          <fieldset>
              <input type="hidden" value="nuevo" name="accion"/>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Editar empleado</h4>
      </div>
      <form id="editarform" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group row">  
            <div class="col-lg-1">
            </div>
            <label for="staff_id" class="col-lg-4 col-form-label form-control-label">Codigo empleado</label>
            <div class="col-lg-3">
              <input type="text" class="form-control staff_id" id="staff_id" name="staff_id" readonly="true">
            </div>
          </div>
          <fieldset>
          <input type="hidden" class="staff_id" id="staff_id" value="" name="staff_id"/>
          </fieldset>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="first_name" class="col-lg-2 col-form-label form-control-label">Nombres</label>
            <div class="col-lg-7">
            <input type="text" class="form-control input first_name" name="first_name" id="first_name" placeholder="Ingrese nombre">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="last_name" class="col-lg-2 col-form-label form-control-label">Apellidos</label>
            <div class="col-lg-7">
            <input type="text" class="form-control input last_name" name="last_name" id="last_name" placeholder="Ingrese apellidos">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="country_ide" class="col-lg-2 col-form-label form-control-label">País</label>
            <div class="col-lg-6">
            <select class="form-control country_ide" id="country_ide" name="country_ide">
                
            </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="city_ide" class="col-lg-2 col-form-label form-control-label">Ciudad</label>
            <div class="col-lg-6">
            <select class="form-control city_ide" id="city_ide" name="city_ide">
                
            </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="address_id" class="col-lg-2 col-form-label form-control-label">Dirección</label>
            <div class="col-lg-6">
            <select class="form-control address_ide" id="address_id" name="address_id">
                
            </select>	
            </div>
          </div>
          <div class="form-group row"> 
            <div class="col-lg-1">
            </div>  
            <label for="email" class="col-lg-2 col-form-label form-control-label">Email</label>
            <div class="col-lg-6">
                <input type="text" class="form-control email" id="email" name="email" placeholder="Ingrese email">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="store_id" class="col-lg-2 col-form-label form-control-label">Tienda</label>
            <div class="col-lg-6">
            <select class="form-control store_id" id="store_id" name="store_id">
                
            </select>	
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <label for="rol_id" class="col-lg-2 col-form-label form-control-label">Rol</label>
            <div class="col-lg-6">
            <select class="form-control rol_id" id="rol_id" name="rol_id">
                
            </select>	
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="username" class="col-lg-2 col-form-label form-control-label">Username</label>
            <div class="col-lg-6">
            <input type="text" class="form-control input usernamee" name="username" id="username" placeholder="Ingrese usuario">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="password" class="col-lg-2 col-form-label form-control-label">Contraseña</label>
            <div class="col-lg-7">
            <input type="password" class="form-control input passworde" name="password" id="password" placeholder="Ingrese contraseña">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div>
            <label for="password_com" class="col-lg-3 col-form-label form-control-label">Confirmar contraseña</label>
            <div class="col-lg-7">
            <input type="password" class="form-control input password_com" name="password_com" id="password_com" placeholder="Ingrese contraseña">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-1">
            </div> 
            <div class="col-lg-8">
                <label for="picture" class="col-form-label form-control-label">Seleccione la foto de usuario</label>
                <input name="picture" type="file" class="form-control-file pictured" id="picture">
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