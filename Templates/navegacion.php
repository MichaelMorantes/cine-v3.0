<?php include_once ("./Funciones/sessiones.php"); ?>
<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <hr class="sidebar-divider my-0">
    <hr class="sidebar-divider my-0">
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <hr class="sidebar-divider my-0">
      <hr class="sidebar-divider my-0">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      if ($_SESSION["rol"]!=3) {
        echo '<ul class="sidebar-menu" data-widget="tree">';
        echo '<li class="header">MENÚ DE ADMINSITRACIÓN</li>';
        echo '<li class="treeview">';
          echo '<a href="#">';
            echo '<i class="fas fa-fw fa-table"></i>';
            echo '<span>Entidades Pricipales</span>';
              echo '</a>';
            echo '<ul class="treeview-menu">';
            
            if ($_SESSION["rol"]==0) {
              echo '<li><a href="Vistas/indexrol.php" role="button"><i class="fas fa-users-cog"></i> Roles</a></li>';
              echo '<li><a href="Vistas/indexciudad.php" role="button"><i class="fas fa-city"></i> Ciudades</a></li>';
              echo '<li><a href="Vistas/indexpais.php" role="button"><i class="fas fa-globe-americas"></i> Países</a></li>';
              echo '<li><a href="Vistas/indextienda.php" role="button"><i class="fas fa-store"></i> Tiendas</a></li>';
              echo '<li><a href="Vistas/indexcliente.php" role="button"><i class="fas fa-portrait"></i> Clientes</a></li>';
              echo '<li><a href="Vistas/indexidioma.php" role="button"><i class="fas fa-video"></i> Peliculas</a></li>';
              echo '<li><a href="Vistas/indexidioma.php" role="button"><i class="fas fa-language"></i> Idiomas</a></li>';
            } 
              echo '<li><a href="Vistas/indexcategoria.php" role="button"><i class="fas fa-filter"></i> Categorías</a></li>';
              echo '<li><a href="Vistas/indexinventario.php" role="button"><i class="fas fa-boxes"></i> Inventario</a></li>';
              echo '<li><a href="Vistas/indexempleado.php" role="button"><i class="fas fa-people-carry"></i> Empleados</a></li>';
              echo '<li><a href="Vistas/indexprestamo.php" role="button"><i class="fas fa-calendar-week"></i> Prestamos</a></li>';
              echo '<li><a href="Vistas/indexpago.php" role="button"><i class="fas fa-money-bill-wave"></i> Pago de prestamos</a></li>';
      }
      ?>
            </ul>
          </li>
          
        <hr class="sidebar-divider my-0">
        <hr class="sidebar-divider my-0">
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->