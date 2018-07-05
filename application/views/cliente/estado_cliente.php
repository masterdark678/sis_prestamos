<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Cambiar Estado Cliente<strong></h4>
				</div>
			<div class="form-container table-container">
				<?php if ($cliente): ?>
						<?php foreach ($cliente as $key): ?>
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cliente/actualizar_estado_cliente" method="POST"  enctype="multipart/form-data">
				<div class="col-md-3 col-sm-3 col-xs-6 col-lg-offset-4 col-sm-offset-4 col-xs-offset-3">
				<input type="hidden" name="txt_id_cliente" value="<?=$key->id_cliente?>">
					<a data-toggle="modal" href="#" class="thumbnail" style="height:auto;">
      <img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_cliente?>">
    </a>		
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>DNI</label></h5>
						</div>
				
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="txt_dni" value="<?=$key->dni_cliente?>" placeholder=" Ingrese DNI" readonly="true">
						
						</div>
					
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Nombre:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_nombre" value="<?=$key->nombre_cliente?>" placeholder="Ingrese Nombre" readonly="true">
						</div>
					</div>
<!-- **************************************************************************** -->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-1 col-sm-1 col-xs-1">
						<h5><label>Estado:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_estado" class="form-control" value="<?=$key->estado_cliente?>" placeholder="" readonly="true">
						</div>
					</div>
						<?php endforeach ?>
				<?php endif ?>
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Nuevo Estado:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<select class="selectpicker form-control" name="id_estado_cliente" id="id_estado_cliente" data-show-subtext="true" data-live-search="true">
										<option value="">Seleccione Estado</option>
										 <?php
										 if ($estado_cliente) {
										 foreach ($estado_cliente as $i) {
								             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
						</div>
					</div>
		
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							 <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>

							 <a href="<?php echo $this->config->base_url();?>cliente"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Volver</button></a>
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
