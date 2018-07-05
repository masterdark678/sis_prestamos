      <!-- page content -->
      <div class="right_col" role="main">

        <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <?php if ($cliente_registrados): ?>
                     <div class="count" align="left"><?=$cliente_registrados?></div>
                     <?php else: ?>
                    <div class="count" align="left">0</div>

                  <?php endif ?>
                  
                  <h3>Clientes</h3>
                  <div align="center">
                    <a href="<?=$this->config->base_url()?>cliente/grilla"><i class="fa fa-users"></i>&nbsp;&nbsp;Ir a Clientes</a>
                  </div>
                </div>
              </div>
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"></div>
                  <?php foreach ($dinero_capital as $key): ?>
                    <?php if ($key->total_caja): ?>
                      <div class="count" align="center"><?=$key->total_caja?></div>
                      
                      <?php else: ?>
                        <div class="count" align="left">0</div>
                    
                    <?php endif ?>
                  <?php endforeach ?>
                  <h3>D. Disponible</h3>
                 <div align="center">
                    <a href="<?=$this->config->base_url()?>caja/grilla"><i class="fa fa-money"></i>&nbsp;&nbsp;Ir a Caja</a>
                  </div>
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-money"></i></div>
                  <?php foreach ($dinero_x_recolectar as $key): ?>
                    <?php if ($key->monto_x_cuotas): ?>
                      <div class="count" align="left"><?=ceil($key->monto_x_cuotas)?></div>
                      
                      <?php else: ?>
                        <div class="count" align="left">0</div>
                    
                    <?php endif ?>
                  <?php endforeach ?>
                  <h3>X Cobrar Hoy</h3>
                 <div align="center">
                    <a href="<?=$this->config->base_url()?>prestamo/grilla_todos_x_cobrar"><i class="fa fa-money"></i>&nbsp;&nbsp;Ir a prestamos x Cobrar</a>
                  </div>
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-money"></i></div>
                  <?php foreach ($dinero_recogido as $key): ?>
                    <?php if ($key->monto): ?>
                      <div class="count" align="left"><?=ceil($key->monto)?></div>
                      
                      <?php else: ?>
                        <div class="count" align="left">0</div>
                    
                    <?php endif ?>
                  <?php endforeach ?>
                  <h3>Cobrado Hoy</h3>
                 <div align="center">
                    <a href="<?=$this->config->base_url()?>prestamo/grilla_todos_x_cobrado"><i class="fa fa-money"></i>&nbsp;&nbsp;Ir a prestamo cobrados</a>
                  </div>
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-globe"></i></div>
                    <?php if ($prestamos_x_aprobar): ?>
                      <div class="count" align="left"><?=$prestamos_x_aprobar?></div>
                      
                      <?php else: ?>
                        <div class="count" align="left">0</div>
                    
                    <?php endif ?>
                  
                  <h3>P. x Aprobar</h3>
                 <div align="center">
                    <a href="<?=$this->config->base_url()?>prestamo/grilla_todos_estado_prestamo_por_aprobar"><i class="fa fa-globe"></i>&nbsp;&nbsp;Ir a P. x Aprobar</a>
                  </div>
                </div>
              </div>
              <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-arrow-circle-left"></i></div>
                    <?php if ($prestamos_atrasados): ?>
                      <div class="count" align="left"><?=$prestamos_atrasados?></div>
                      
                      <?php else: ?>
                        <div class="count" align="left">0</div>
                    
                    <?php endif ?>
                  
                  <h3>P. Atrasados</h3>
                 <div align="center">
                    <a href="<?=$this->config->base_url()?>prestamo/grilla_todos_atrasados"><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Ir a P. x Atrasados</a>
                  </div>
                </div>
              </div>
            </div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile">
            <h3 class="box-title"></h3>
                <div id="grafico" style="width:100%; height:400px;">
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />

        <div class="row">


          <div class="col-md-6 col-sm-6 col-xs-12">
             <div class="x_panel tile">
            <h3 class="box-title"></h3>
                <div id="grafico2" style="width:100%; height:400px;">
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <div class="x_panel tile">
            <h3 class="box-title"></h3>
                <div id="grafico3" style="width:100%; height:400px;">
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

        </div>


        <!-- footer content -->

        <footer>
          <div class="copyright-info">
           <p class="pull-right"><i class="fa fa-money"></i>&nbsp;&nbsp;Sistema de Prestamos &nbsp;&nbsp; ©2016 Todos los Derechos Reservados  a (Nombre de Empresa)</p>
                 
           
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>