<div class="right_col" role="main" style="height:auto" onload="fnccalculo_monto_cuota()">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Generar Atraso<strong></h4>
				</div>
			<div class="form-container table-container">
				<?php if ($cliente): ?>
						<?php foreach ($cliente as $key): ?>
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>prestamo/guardar_generar_atraso" method="POST"  enctype="multipart/form-data">
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
					
					</div>

<!-- **************************************************************************** -->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-3" align="right">
						
					<?php if ($prestamo): ?>
						<?php foreach ($prestamo as $key): ?>
							<input type="hidden" name="txt_id_prestamo" value="<?=$key->id_prestamo?>">
							<input type="hidden" name="txt_atraso"id="txt_atraso" value="<?=$key->atrasos?>">
							<input type="hidden" name="txt_dias_mora" value="<?=$key->dias_mora?>">
							<input type="hidden" name="txt_cuotas_debe" value="<?=$key->cuotas_debe?>">
							<input type="hidden" name="txt_penalidad" value="<?=$key->penalidad?>">
						</div>
					</div>
<!-- ************************************************************************ -->

		<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-2 col-sm-2 col-xs-12" align="right">
								<h5><label>Fecha Proximo Cobro</label></h5></P>
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
