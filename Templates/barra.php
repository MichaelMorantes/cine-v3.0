<?php include_once ("./Funciones/sessiones.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="adminper.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fas fa-home"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fas fa-home"></i><b> Gui Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><i class="fas fa-bars fa-lg"></i></a>
      <hr>
      <div class="topbar-divider d-none d-sm-block"></div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img class="user-image" alt="User Image"
              <?php 
              // echo $_SESSION['foto'];
              if ($_SESSION['foto']!=null) {
                echo 'src="data:image/jpeg;base64,'.base64_encode( $_SESSION['foto'] ).'"';
              }else {
                echo 'src="Recursos\img\avatar.png"';
              }
              ?>>
              <span class="hidden-xs"> <?php echo $_SESSION["nombre"]; ?></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" id="btnupdatedatos">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Configuración
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logs
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Ya te vas?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">¿Estas seguro que quieres cerrar sesion?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-warning" href="login.php?cerrar_session=true">Cerrar sesion</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Update data Modal-->
  <div class="modal fade" id="datosactualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">¡Modifica tu info!</h4> <i class="fas fa-cat fa-2x"></i>
      </div>
      <form id="actualizarform" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <fieldset>
          <input type="hidden" class="staff_id" id="staff_id" <?php echo 'value="'.$_SESSION['id'].'"';?> name="staff_id"/>
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
            <label for="email" class="col-lg-2 col-form-label form-control-label">Email</label>
            <div class="col-lg-6">
                <input type="text" class="form-control email" id="email" name="email" placeholder="Ingrese email">
            </div>
          </div>
          <fieldset>
            <input type="hidden" class="rol_id" <?php echo 'value="'.$_SESSION['rol'].'"';?> id="rol_id" name="rol_id">
          </fieldset>
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
  <!-- =============================================== -->