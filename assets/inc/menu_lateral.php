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
            <li><a><i class="fa fa-edit"></i>Formularios<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>caja">Caja</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>capital">Capital</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>cliente">Clientes</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>codeudor">Codeudores</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>cobrador">Cobradores</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>empresa">Config de Empresa</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>sucursal">Sucursales</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>gasto">Gastos</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>penalidad">Penalidad</a>
                </li>
                 <li><a href="<?= $this->config->base_url();?>socio">Socios</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>tipo">Tipo</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>tipo_gasto">Tipo de Gastos</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>usuario">Usuarios</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>zona">Zonas</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>zona_cobrador">Zonas asignadas a Cobradores</a>
                </li>
                 <li><a href="<?= $this->config->base_url();?>prestamo">Prestamos Registrados</a>
                </li>
              </ul>
            </li>
            
          </ul>
        </div>
            
          </div>
         
        </div>
      </div>