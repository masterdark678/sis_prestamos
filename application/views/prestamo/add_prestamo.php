<div class="right_col" role="main"  style="height:1440px;">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
				<?php if ($prestamo): ?>
					<?php foreach ($prestamo as $key): ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				
		 <div class="animated bounceInDown">
			   <div class="alert alert-info alert-dismissible">             
			   <strong>Este Cliente Tiene una Deuda pendiente de: <?=$key->total_debe?> si se aprueba este Prestamo, se Liquidará la Deuda anterior y se restará la deuda del nuevo prestamo</strong>
		    <br>
		</div>
		</div> 
					<?php endforeach ?>
				<?php else: ?>
					
				<?php endif ?>
			<div class="table-label">
				<h4><strong>Crear Prestamo<strong></h4>
				</div>
				
			<div class="form-container table-container">
				<?php if ($cliente): ?>
						<?php foreach ($cliente as $key): ?>
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>prestamo/guardar_nuevo_prestamo" method="POST"  enctype="multipart/form-data">
				<div class="col-md-3 col-sm-3 col-xs-6 col-lg-offset-4 col-sm-offset-4 col-xs-offset-3">
				<input type="hidden" name="txt_id_cliente" value="<?=$key->id_cliente?>">
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Cliente</label></h5>
						</div>
				
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="txt_dni" value="<?=$key->dni_cliente?>, <?=$key->nombre_cliente?>" placeholder=" Ingrese DNI" readonly="true">
						
						</div>
					
					</div>

<!-- **************************************************************************** -->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Tipo Prestamo</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
					<select class="selectpicker form-control" name="id_tipo_prestamo" id="id_tipo_prestamo" data-show-subtext="true" data-live-search="true" required="true">
										<option value="">Seleccione Tipo de Prestamo</option>
										 <?php
										 if ($tipo_prestamo) {
										 foreach ($tipo_prestamo as $i) {
								             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
						</div>
					</div>
						<?php endforeach ?>
				<?php endif ?>
<!-- ****************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Metodo de Pago</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<select class="selectpicker form-control" name="id_metodo_pago" id="id_metodo_pago" data-show-subtext="true" data-live-search="true" required="true">
										<option value="">Seleccione Metodo de Pago</option>
										 <?php
										 if ($metodo_pago) {
										 foreach ($metodo_pago as $i) {
								             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
						</div>
					</div>
<!-- ****************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Porcentaje</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="number" id="txt_porcentaje" name="txt_porcentaje" class="form-control" value=""  onkeyup="fnccalulo_monto()" placeholder="Ingrese Porcentaje" required="true">
						</div>
					</div>
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Monto prestado</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
		<input type="number" class="form-control" name="txt_monto_prestado" id="txt_monto_prestado"  onkeyup="fnccalulo_monto()" value="" placeholder=" Ingrese Monto Prestamo" required="true">
						</div>
					</div>
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Intereses calulados</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
		<input type="number" class="form-control" name="txt_interes_calculados" id="txt_interes_calculados" value="" placeholder=""readonly="true">
						</div>
	</div>
<!-- ***************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Total Prestamo</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
		<input type="number" class="form-control" name="txt_total_prestamo" id="txt_total_prestamo" value="" placeholder=""readonly="true">
						</div>
</div>
<!-- ************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Num de Cuotas</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
		<input type="number"  onkeyup="fnccalulo_monto()" class="form-control" name="txt_num_cuotas" id="txt_num_cuotas" value="" required="true">
						</div>
</div>
<!-- ************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Monto x Cuotas</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
		<input type="number" class="form-control" name="txt_monto_x_cuota" id="txt_monto_x_cuota" value="" placeholder="" readonly="true">
						</div>
</div>
<!-- *************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h5><label>Fecha Prestamo</label></h5></P>
						</div>
						<?	$fecha=date('Y-m-d');?>
					   <div class="col-md-4 col-sm-4 col-xs-12">
		<input type="date" class="form-control" name="txt_fecha_inicio_prestamo" id="txt_fecha_inicio_prestamo" value="<?=$fecha?>" required="true">
						</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h5><label>Cobrador</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
			<select class="selectpicker form-control" name="id_cobrador" id="id_cobrador" data-show-subtext="true" data-live-search="true" required="true">
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

<!-- ************************************************** -->
		
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							 <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
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
