<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Activar/Desactivar Usuario<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>usuario/guardar_activar_desactivar_usuario" method="POST"  enctype="multipart/form-data">
	<!--*****************************************************************************-->
	
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Nombre</label></h5>
						</div>
				<?php foreach ($usuario as $key): ?>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="txt_nombre" value="<?=$key->nombre_usuario?>" placeholder=" Ingrese DNI" readonly="true">
						<input type="hidden" name="txt_id_usuario" value="<?=$key->id_usuario?>">
						</div>
					
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Login:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_login" value="<?=$key->login_usuario?>" placeholder="Ingrese Nombre" required="required" readonly="true">
						</div>
					</div>
<!--*****************************************************************************-->
					<?php endforeach ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Estado:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
					 	<select class="selectpicker form-control" name="id_estado" id="id_estado" data-show-subtext="true" data-live-search="true">
										<option value="">Seleccione Estado</option>
										 <?php
										 if ($estado_usuario) {
										 foreach ($estado_usuario as $i) {
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
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
							 <a href="<?php echo $this->config->base_url();?>usuario"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Cancelar</button></a>
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
