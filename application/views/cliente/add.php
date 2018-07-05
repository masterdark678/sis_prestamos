<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Agregar Cliente<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cliente/guardar_cliente" method="POST"  enctype="multipart/form-data">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>DNI</label></h5>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="txt_dni" value="" placeholder=" Ingrese DNI" required="reuired">
						</div>
					
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Nombre:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_nombre" value="" placeholder="Ingrese Nombre" required="required">
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Negocio:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_nombre_negocio" value="" placeholder="Ingrese Nombre de Negocio" required="required">
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Direccion:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_direccion" value="" placeholder="Ingrese Direccion" required="required">
						</div>
					</div>
<!--*****************************************************************************-->

<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Direccion Cobro:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_direccion_cobro" value="" placeholder="Ingrese Direccion de Cobro" required="required">
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Telef:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" name="txt_telf" value="" placeholder="Ingrese Telf"required="required">
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Email:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="email" class="form-control" name="txt_email" value="" placeholder="Ingrese Email">
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-1 col-sm-1 col-xs-1">
						<h5><label>Estado:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
					   <input type="hidden" name="txt_estado_cliente" value="1">
						<input type="text" name="txt_estado" class="form-control" value="Nuevo Cliente" placeholder="" readonly="true">
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>cobrador Asignado:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
							<select class="selectpicker form-control" name="id_cobrador" id="id_cobrador" data-show-subtext="true" data-live-search="true"  required="required">
										<option value="">Seleccione Cobrador</option>
										 <?php
										 if ($cobrador) {
										 foreach ($cobrador as $i) {
								             echo '<option value="'. $i->id .'">'.$i->nombre.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Documentacion:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
							<select class="selectpicker form-control" name="id_documentacion" id="id_documentacion" data-show-subtext="true" data-live-search="true"  required="required">
										<option value="">Seleccione</option>
										 <?php
										 if ($documentacion) {
										 foreach ($documentacion as $i) {
								             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Referido Por:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_referido_1" class="form-control" value="" placeholder="Ingrese una persona de referencia"  required="required">
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Referido Por (2):</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_referido_2" class="form-control" value="" placeholder="Ingrese una persona de referencia"  required="required">
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Foto:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
							<input type="file" name="mi_archivo_1">	
						</div>
					</div>
	
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
