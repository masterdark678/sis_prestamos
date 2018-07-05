<div class="modal fade "id="m_cliente">
		        <div class="modal-dialog modal-md">
		          <div class="modal-content">
		            <div class="modal-header">
		             <button type="button" class="close" data-dismiss="modal">&times;</button>
		               <strong><h3><span class ="label label-warning">Ficha Cliente</span></h3></strong>
		            </div> <!-- termina el header -->
					<div class="container">
						<div class="row">
		<div class="form-container table-container">
		<p></p>
				<?php if ($cliente): ?>
						<?php foreach ($cliente as $key): ?>
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cliente/guardar_cliente" method="POST"  enctype="multipart/form-data">
		<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-6 col-sm-6 col-xs-6 col-lg-offset-3 col-sm-offset-3 col-xs-offset-3 " >
					<?php if ($key->adjunto_cliente): ?>
							<a data-toggle="modal" href="#" class="thumbnail thumbnail-warning" style="height:auto;">
      <img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_cliente?>"> </a>
						
  					<?php else: ?>
  						<a data-toggle="modal" href="#" class="thumbnail" style="height:auto;">
      <img src="<?=$this->config->base_url()?>assets/img/user.png"> </a>
					<?php endif ?>
				</div>
<div class="col-md-12 col-sm-12 col-xs-12">

	<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5" align="right">
							<h4><label>Dni:</label></h4>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-7">
						<h4><?=$key->dni_cliente?></h4>
						</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5" align="right">
							<h4><label>Nombre:</label></h4>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-7">
						<h4><?=$key->nombre_cliente?></h4>
						</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5" align="right">
								<h4><label>Direccion:</label></h4></P>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-7">
							<h4><?=$key->direccion_cliente?></h4>
						</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-5 col-sm-5 col-xs-5" align="right">
						<h4><label>D. Cobro:</label></h4></P>
						</div>
					  <div class="col-md-7 col-sm-7 col-xs-7">
					<h4><?=$key->direccion_cobro_cliente?></h4>
						</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5" align="right">
							<h4><label>Negocio:</label></h4>
						</div>
					  <div class="col-md-7 col-sm-7 col-xs-7">
							<h4><?=$key->nombre_negocio_cliente?></h4>
						</div>
				</div><!-- col-12 -->
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-5 col-sm-5 col-xs-5" align="right">
						<h4><label>Telef:</label></h4></P>
						</div>
					  <div class="col-md-7 col-sm-7 col-xs-7">
				<h4> <?=$key->telf_cliente?></h4>
						</div>
					</div><!-- col-12 -->

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5"  align="right">
							<h4><label>Email:</label></h4></P>
							</div>
						  <div class="col-md-7 col-sm-7 col-xs-7">
								<h4><?=$key->email_cliente?></h4>
							</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5"  align="right">
							<h4><label>Estado:</label></h4></P>
							</div>
						  <div class="col-md-7 col-sm-7 col-xs-7">
							<h4><?=$key->estado_cliente?></h4>
							</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5"  align="right">
								<h4><label>Cobrador:</label></h4></P>
						</div>
					   	<div class="col-md-7 col-sm-7 col-xs-7">
								<h4><?=$key->nombre_cobrador?></h4>
							</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5"  align="right">
								<h4>Documentacion:</label></h4></P>
						</div>
					   <div class="col-md-7 col-sm-7 col-xs-7">
					   <?php if ($key->documentacion_cliente=="Correcta"): ?>
					   	<h4><span class ="label label-success"><?=$key->documentacion_cliente?></span></h4>
					   <?php else: ?>
					   		<h4><span class ="label label-warning"><?=$key->documentacion_cliente?></span></h4>
					   <?php endif ?>
								
						 </div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-5 col-sm-5 col-xs-5"  align="right">
								<h4><label>Referido Por:</label></h4></P>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-7">
								<h4><?=$key->referencia_1_cliente?></h4>
							</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5"  align="right">
							<h4><label>Referido Por:</label></h4></P>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-7">
							<h4><?=$key->referencia_1_cliente?></h4>
						</div>
					</div><!-- col-12 -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-5 col-sm-5 col-xs-5"  align="right">
							<h4><label>Referido Por (2):</label></h4></P>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-7">
							<h4><?=$key->referencia_2_cliente?></h4>
						</div>
					</div><!-- col-12 -->	
</div>
		</div>
					<?php endforeach ?>
				<?php endif ?>
	</div>
			</div>
			</div>
					<br>
		            <div class="modal-footer">
		            	</form>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->