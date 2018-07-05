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
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
           
        <div class="menu_section">
          
          <h3>General</h3>
          <ul class="nav side-menu">
           
             <li><a><i class="fa fa-edit"></i>Clientes<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>cliente/grilla">Clientes Registrados</a>
                </li>
                  <li><a href="<?= $this->config->base_url();?>codeudor/grilla">Codeudores Registrados</a>
                </li>
               
              </ul>
            </li>
             <li><a><i class="fa fa-edit"></i>Prestamos<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>prestamo/grilla_cobrador_estado_prestamo_por_aprobar">Por Aprobar</a>
                </li>
                  <li><a href="<?= $this->config->base_url();?>prestamo/grilla_cobrador_estado_prestamo_aprobado">Aprobados</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>prestamo/grilla_cobrador_estado_prestamo_rechazados">Rechazados</a>
                </li>
                <li><a href="<?= $this->config->base_url();?>prestamo/grilla_cobrador_estado_prestamo_finalizado">Finalizados</a>
                </li>
              
              </ul>
            </li>
            <li><a><i class="fa fa-globe"></i>Gastos<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="<?= $this->config->base_url();?>gasto/grilla">Gastos</a>
                </li>
              </ul>
            </li>
        </div>
        </ul>
            
          </div>
         
        </div>
      </div>