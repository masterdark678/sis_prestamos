<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>prestamo/guardar_aprobar_rechazar_prestamo" method="POST">
		
		<?php if ($prestamo_anterior): ?>
					<?php foreach ($prestamo_anterior as $key): ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
					
		 <div class="animated bounceInDown">
			   <div class="alert alert-warning alert-dismissible">             
			   <strong>Este Cliente Tiene una Deuda pendiente de: <?=$key->total_debe?>  si se aprueba este Prestamo, se Liquidará la Deuda anterior y se restará la deuda del nuevo prestamo</strong>
			   <input type="hidden" name="txt_id_prestamo_anterior" value="<?=$key->id_prestamo?>">
			   <input type="hidden" name="txt_total_debe_prestamo_anterior" value="<?=$key->total_debe?>">
		    <br>
		</div>
		</div> 
					<?php endforeach ?>
				<?php else: ?>
				<?php endif ?>
		<?php if ($dinero_sucursal): ?>
			<?php foreach ($dinero_sucursal as $key): ?>
	 <div class="animated bounceInDown">
		   <div class="alert alert-info alert-dismissible" align="center">             
		   <h4>Dinero Disponible en Sucursal: &nbsp;&nbsp;<strong><?=$key->total_caja?></strong></h4>
		
			</div>
		</div>
		<?php endforeach ?>
		<?php endif ?>
			<div class="table-label">
				<h4><strong>Aprobar/Rechazar Prestamo<strong></h4>
				</div>
			<div class="form-container table-container">
				<?php if ($cliente): ?>
						<?php foreach ($cliente as $key): ?>
				
				<div class="col-md-3 col-sm-3 col-xs-6 col-lg-offset-4 col-sm-offset-4 col-xs-offset-3">
				<input type="hidden" name="txt_id_cliente" value="<?=$key->id_cliente?>">

				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					
					<div class="col-md-1 col-sm-1 col-xs-1" align="right">
					</div>
					<div class="col-md-5 col-sm-5 col-xs-10" align="left">
						
						<h5><label>Cliente:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><?=$key->dni_cliente?>, <?=$key->nombre_cliente?></strong></label>&nbsp;&nbsp;
						<a href="#m_cliente" data-toggle="modal" title="" class="btn btn-info btn-md">Ver Ficha Cliente</a>
						</h5>
					</div>
				<?php endforeach ?>
				<?php endif ?>
				<?php if ($dinero_sucursal): ?>
					<?php foreach ($dinero_sucursal as $key): ?>
						<input type="hidden" name="txt_id_caja" value="<?=$key->id_caja?>">
					  <input type="hidden" name="txt_nuevo_monto_sucursal" id="txt_nuevo_monto_sucursal" value="">
					   <input type="hidden" name="txt_dinero_sucursal" id="txt_dinero_sucursal" value="<?=$key->total_caja?>">
					<?php endforeach ?>
				<?php endif ?>
					
					</div>

<!-- **************************************************************************** -->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-3">
						<h5><label>Tipo Prestamo</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
					<?php if ($prestamo): ?>
						<?php foreach ($prestamo as $key): ?>
							<input type="hidden" name="txt_id_prestamo" value="<?=$key->id_prestamo?>">
					<input type="text" class="form-control" name="txt_tipo_prestamo" value="<?=$key->tipo_prestamo?>" placeholder="" readonly=true>	
					
						
						</div>
					</div>
<!-- ************************************************************************ -->
<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="col-md-2 col-sm-2 col-xs-4">
						<h5><label>Fecha Sol. Prestamo</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		 <?$fecha=date('d-m-Y', strtotime($key->fecha_prestamo))?>
				<input type="text" class="form-control" name="" value="<?=$fecha?>" placeholder="" readonly="true">
						</div>
</div>
<!-- *************************************************** -->
<!-- ****************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-4">
						<h5><label>Metodo de Pago</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="txt_metodo_pago" value="<?=$key->metodo_pago?>" placeholder="" readonly=true>
						</div>
					</div>
<!-- ****************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-4">
						<h5><label>M. Presupuestado</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="number" id="txt_monto_prestado" name="txt_monto_prestado" class="form-control" value="<?=$key->monto_prestado?>" required="true"readonly="true">
						</div>
</div>
<!-- ******************************************************************************* -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-4">
						<h5><label>M. Aprobado</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="number" id="txt_monto_aprobado" name="txt_monto_aprobado" class="form-control" value="<?=$key->monto_prestado?>"  onkeyup="fnccalulo_monto_aprobar()" placeholder="Ingrese Porcentaje" required="true">
						</div>
</div>
<!-- ******************************************************************************* -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-4">
						<h5><label>% Presupuestado</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="number" id="txt_porcentaje" name="txt_porcentaje" class="form-control" value="<?=$key->porcentaje?>" placeholder="Ingrese Porcentaje" required="true"readonly="true">
						</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>% Aprobado</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		<input type="number" class="form-control" name="txt_porcentaje_aprobado" id="txt_porcentaje_aprobado"  onkeyup="fnccalulo_monto_aprobar()" value="<?=$key->porcentaje?>" placeholder="Ingrese Porcentaje a Aprobar" required="true">
		
						</div>
					</div>
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Intereses calculados</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		<input type="number" class="form-control" name="txt_interes_calculados" id="txt_interes_calculados" value="<?=$key->interes_prestamo?>" required="true"readonly="true">
						</div>
	</div>
<!-- ***************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Total Prestamo</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		<input type="number" class="form-control" name="txt_total_prestamo" id="txt_total_prestamo" value="<?=$key->total_prestado?>" required="true"readonly="true">
						</div>
</div>
<!-- ************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Cuotas Postuladas</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		<input type="number"  onkeyup="fnccalulo_monto()" class="form-control" name="txt_num_cuotas" id="txt_num_cuotas" value="<?=$key->numero_cuotas?>" required="true" readonly>
						</div>
</div>
<!-- ************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Cuotas Aprobadas</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		<input type="number"  onkeyup="fnccalulo_monto_aprobar()" class="form-control" name="txt_num_cuotas_aprobadas" id="txt_num_cuotas_aprobadas" value="<?=$key->numero_cuotas?>" required="true">
						</div>
					
</div>
<!-- ************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Monto x Cuotas</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		<input type="number" class="form-control" name="txt_monto_x_cuota" id="txt_monto_x_cuota" value="<?=$key->monto_x_cuotas?>" placeholder="" readonly="true">
						</div>
</div>
<!-- *************************************************** -->

<div class="col-md-12 col-sm-12 col-xs-12">

	<div class="col-md-2 col-sm-2 col-xs-12">
	<h5><label>Estado</label></h5>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
	<p></p>
	
	<input type="radio" onclick="fn_aprueba_prestamo()" name="estado_prestamo" value="2" checked="true"><label>Aprobado</label>
	&nbsp;&nbsp;
	<input type="radio" onclick="fn_aprueba_prestamo()" name="estado_prestamo" value="3"><label>Rechazado</label>
	</div>
</div>
			<!-- *** -->
			<div id="aprueba_prestamo" style="display: block;" class="animated fadeInDown">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Atrasos</label></h5></P>
						</div>
					   <div class="col-md-4 col-sm-4 col-xs-4">
					  	<input type="number" class="form-control" name="txt_penalidad" value="" placeholder="Ingrese Dias de Atrasos">
						</div>
					</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Fecha Aprobacion</label></h5></P>
						</div>
							<?$fecha=date('Y-m-d');?>
					   <div class="col-md-4 col-sm-4 col-xs-12">
					  	<input type="date" class="form-control" id="txt_fecha_aprobacion" name="txt_fecha_aprobacion" class="form-control" value="<?=$fecha; ?>"/> 
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-2 col-sm-2 col-xs-12">
								<h5><label>Proximo Pago</label></h5></P>
								</div>
							   <div class="col-md-4 col-sm-4 col-xs-12">
							  	<input type="date" class="form-control" id="txt_fecha_prox_pago" name="txt_fecha_prox_pago" class="form-control" value="<?=$fecha?>"/> 
								</div>
					</div>

			</div><!-- Fin id_aprueba prestamo -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Observaciones</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
					  	<textarea name="txt_observaciones" class="form-control" placeholder="Ingrese Observaciones"></textarea>
						</div>
					</div>
</div>
					<?php endforeach ?>
					<?php endif ?>
<!-- ************************************************** -->
		
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12" id="botones" style="display: block">
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
