<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Editar Cliente<strong></h4>
				</div>
			<div class="form-container table-container">
				<?php if ($cliente): ?>
						<?php foreach ($cliente as $key): ?>
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cliente/actualizar_cliente" method="POST"  enctype="multipart/form-data">
				<div class="col-md-3 col-sm-3 col-xs-6 col-lg-offset-4 col-sm-offset-4 col-xs-offset-3">
					<!-- <a data-toggle="modal" href="#" class="thumbnail" style="height:auto;">
      <img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_cliente?>">
    </a>	 -->
				</div>
				<input type="hidden" name="txt_id_cliente" value="<?=$key->id_cliente?>">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>DNI</label></h5>
						</div>
				
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="txt_dni" value="<?=$key->dni_cliente?>" placeholder=" Ingrese DNI" >
						
						</div>
					
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Nombre:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_nombre" value="<?=$key->nombre_cliente?>" placeholder="Ingrese Nombre" >
						</div>
					</div>
				
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Negocio:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_nombre_negocio" value="<?=$key->nombre_negocio_cliente?>" placeholder="Ingrese Nombre de Negocio" >
						</div>
					</div>
						
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Direccion:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_direccion" value="<?=$key->direccion_cliente?>" placeholder="Ingrese Direccion" >
						</div>
					</div>
<!--*****************************************************************************-->

<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Direccion Cobro:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_direccion_cobro" value="<?=$key->direccion_cobro_cliente?>" placeholder="Ingrese Direccion de Cobro" >
						</div>
					</div>	
					

<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Telef:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_telf" value="<?=$key->telf_cliente?>" placeholder="Ingrese Telf">
						</div>
					</div>
			
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Email:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="email" class="form-control" name="txt_email" value="<?=$key->email_cliente?>" placeholder="Ingrese Email" >
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Referido Por:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_referido_1" class="form-control" value="<?=$key->referencia_1_cliente?>"  >
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Referido Por (2):</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_referido_2" class="form-control" value="<?=$key->referencia_2_cliente?>"  >
						</div>
					</div>
			<?php endforeach ?>
				<?php endif ?>
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>

							 <a href="<?php echo $this->config->base_url();?>cliente"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Cancelar</button></a>
							</div>
									</form>
					  
					</div>
			</div>
			<br>
		</div>
	</div>
  </div>
 </div>
	    	</div>
</div>
