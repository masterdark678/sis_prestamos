<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title">
            <a href="<?=$this->config->base_url()?>principal" class="site_title"><i class="fa fa-money"></i>&nbsp; Sis Prestamos</a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="<?= $this->config->base_url();?>/assets/img/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido</span>
              <h2><?=$nombre_usuario?></h2>
            </div>
          </div>

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
           
             <li><a><i class="fa fa-users"></i>Clientes<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>cliente/grilla">Clientes Registrados</a>
                </li>
                  <li><a href="<?= $this->config->base_url();?>codeudor/grilla">Codeudores Registrados</a>
                </li>
               
              </ul>

            </li>
             <li><a><i class="fa fa-money"></i>Caja<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>caja/grilla">Movimientos de Caja</a>
                </li>
              </ul>
            </li>
             <li><a><i class="fa fa-globe"></i>Gastos<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>gasto/grilla">Gastos Registrados</a>
                </li>
              </ul>
            </li>
             <li><a><i class="fa fa-check-square-o"></i>Prestamos<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>prestamo/grilla_todos_estado_prestamo_por_aprobar">Por Aprobar</a>
                </li>
                  <li><a href="<?= $this->config->base_url();?>prestamo/grilla_todos_estado_prestamo_aprobado">Aprobados</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>prestamo/grilla_todos_estado_prestamo_rechazados">Rechazados</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>prestamo/grilla_todos_estado_prestamo_finalizado">Finalizados</a>
                </li>
              
              </ul>
            </li>
            
        </div>
        <div class="menu_section">
           <h3>Configuracion</h3>
          <ul class="nav side-menu">
           
             <li><a><i class="fa fa-edit"></i>Cierre por dia<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>cierre_x_cobrador/grilla">Cierre x cobrador</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>cierre/grilla">Cierre total</a>
                </li>
              </ul>
              
            </li>
             <li><a><i class="fa fa-edit"></i>Capital<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>capital/grilla">Capital</a>
                </li>
              </ul>
              
            </li>
            <li><a><i class="fa fa-building-o"></i>Empresa<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>empresa/grilla">Configuracion de Empresa</a>
                </li>
                  <li><a href="<?= $this->config->base_url();?>sucursal/grilla">Sucursales Registradas</a>
                </li>
              </ul>

            </li>
            <li><a><i class="fa fa-list"></i>Tipos de Gasto<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>tipo_gasto/grilla">Tipos de Gasto</a>
                </li>
              </ul>
            </li>
            <li><a><i class="fa fa-credit-card"></i>Cobradores<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>cobrador/grilla">Cobradores Registrados</a>
                </li>
              </ul>
            </li>
            <li><a><i class="fa fa-thumbs-up"></i>Socios<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>socio/grilla">Socios Registrados</a>
                </li>
              </ul>
            </li>
            <li><a><i class="fa fa-map-marker"></i>Zonas<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>zona/grilla">Zonas Registradas</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>zona_cobrador/grilla">Asignar Zonas</a>
                </li>
              </ul>
                 
            </li>
            <li><a><i class="fa fa-user"></i>Usuarios<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>usuario/grilla">Usuarios Registrados</a>
                </li>
                
              </ul>
                 
            </li>
             <li><a><i class="fa fa-file-text"></i>Reportes<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>reporte_todos_cobradores_fechas/add_reporte_todos_cobradores_fechas">Reporte x fechas</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>reporte_zona_fechas/add_reporte_zona_fechas">Reporte Zonas</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>reporte_cobrador_fecha/add_reporte_cobrador_fechas">Reporte x Cobradores</a>
                </li>
                 <li><a href="<?= $this->config->base_url();?>reporte_sucursal_fechas/add_reporte_sucursal_fechas">Reporte x Sucursal</a>
                </li>
              </ul>
            </li>
        </div>
        </ul>
          </div>
        </div>
      </div>