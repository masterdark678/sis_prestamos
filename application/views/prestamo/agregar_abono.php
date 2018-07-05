<div class="right_col" role="main" style="height:auto" onload="fnccalculo_monto_cuota()">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Agregar Abono<strong></h4>
				</div>
			<div class="form-container table-container">
				<?php if ($cliente): ?>
						<?php foreach ($cliente as $key): ?>
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>prestamo/guardar_abono" method="POST"  enctype="multipart/form-data">
				<div class="col-md-3 col-sm-3 col-xs-6 col-lg-offset-4 col-sm-offset-4 col-xs-offset-3">
				<input type="hidden" name="txt_id_cliente" value="<?=$key->id_cliente?>">
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					
					<div class="col-md-1 col-sm-1 col-xs-1" align="right">
					</div>
					<div class="col-md-5 col-sm-5 col-xs-10" align="left">
						<h5><label>Cliente:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><?=$key->dni_cliente?>, <?=$key->nombre_cliente?></strong></label>&nbsp;&nbsp;
						
						</h5>
					</div>
				<?php endforeach ?>
				<?php endif ?>
					<?php if ($dinero_sucursal): ?>
					  	<?php foreach ($dinero_sucursal as $key): ?>
					  		<input type="hidden" name="txt_id_caja" value="<?=$key->id_caja?>">
								<input type="hidden" name="txt_dinero_sucursal" id="txt_dinero_sucursal" value="<?=$key->total_caja?>">
					  		<input type="hidden" name="txt_nuevo_monto_sucursal" id="txt_nuevo_monto_sucursal" value="">
					  	<?php endforeach ?>
					  <?php endif ?>  
					
					</div>

<!-- **************************************************************************** -->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-3" align="right">
						<h5><label>Monto</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
					<?php if ($prestamo): ?>
						<?php foreach ($prestamo as $key): ?>
							<input type="hidden" name="txt_id_prestamo" value="<?=$key->id_prestamo?>">
							<input type="hidden" name="txt_deuda_anterior"id="txt_deuda_anterior" value="<?=$key->total_debe?>">
							<input type="hidden" name="txt_cuotas_amortizadas" id="txt_cuotas_amortizadas" value="<?=$key->cuotas_amortizadas?>">
							<input type="hidden" name="txt_nuevas_cuotas_amortizadas" id="txt_nuevas_cuotas_amortizadas" name="txt_nuevas_cuotas_amortizadas" value="">
					<input type="text" class="form-control" name="txt_monto_cuota" id="txt_monto_cuota"value="<?=$key->monto_x_cuotas?>" placeholder="" readonly=true>	
						</div>
					</div>
<!-- ************************************************************************ -->
<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="col-md-2 col-sm-2 col-xs-4" align="right">
						<h5><label>Cuotas debe</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
		 		<input type="number" class="form-control" name="txt_cuotas_debe" id="txt_cuotas_debe" value="<?=$key->cuotas_debe?>" placeholder=" ingrese Numero de Cuotas a Abonar" readonly="true">
						</div>
</div>
<!-- *************************************************** -->

<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-4" align="right">
						<h5><label>Cuotas a abonar</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="txt_cuota_abonar" id="txt_cuota_abonar" onkeyup="fnccalculo_monto_cuota()" placeholder="Ingrese Numero de Cuotas a Abonar" required="true">
						<input type="hidden" name="txt_nuevas_cuotas_debe"id="txt_nuevas_cuotas_debe" value="">

						<input type="hidden" name="txt_nueva_deuda" id="txt_nueva_deuda" value="">
						</div>
					</div>	

<!-- ****************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-4" align="right">
						<h5><label>Total Abono</label></h5></P>
						</div>
					   <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="number" onkeyup ="fnccalculo_monto_total_prestamo()" class="form-control" name="txt_total_abono" id="txt_total_abono" value="" step="any" >
						</div>
					</div>	
		<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-2 col-sm-2 col-xs-12" align="right">
								<h5><label>Fecha Abono</label></h5></P>
								</div>

								<?
							   	
							   	$var= date("w");
						$fecha=date('Y-m-d');
						?>
							   <div class="col-md-4 col-sm-4 col-xs-4">
							  	<input type="date" class="form-control" id="txt_fecha_abono" name="txt_fecha_abono" class="form-control" value="<?= $fecha; ?>"/> 
								</div>
					</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-2 col-sm-2 col-xs-12" align="right">
								<h5><label>Proximo Pago</label></h5></P>
								</div>

								<?
							   	/*obtiene el dia de la semana.*/
							   	$var= date("w");
						$fecha=date('Y-m-d');
									 	
					if ($var==5) {
								   	$fecha_2=strtotime( '+3 day' , strtotime ($fecha));
										$fecha_2= date("Y-m-d", $fecha_2);
								  }else{
								   	$fecha_2=strtotime( '+1 day' , strtotime ($fecha));
										$fecha_2= date("Y-m-d", $fecha_2);
								   }			   
							   ?>
							   <div class="col-md-4 col-sm-4 col-xs-4">
							  	<input type="date" class="form-control" id="txt_fecha_prox_pago" name="txt_fecha_prox_pago" class="form-control" value="<?= $fecha_2; ?>"/> 
								</div>
					</div>
<!-- ****************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-12" align="right">
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
