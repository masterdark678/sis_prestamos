<div class="right_col" role="main" style="height:1040px;">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Ver Reporte X Zona<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>reporte_zona_fechas/imprimir_reporte" method="POST"  enctype="multipart/form-data">
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Zona:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
					   <?php if ($zona): ?>
					   	<?php foreach ($zona as $key): ?>
					   		<input type="hidden" name="txt_id_zona" value="<?=$key->id_zona_cobrador?>">
					   	<input type="text" class="form-control" name="txt_cobrador" value="<?=$key->zona?>" placeholder="" readonly="true">
					   	<?php endforeach ?>
					   <?php endif ?>
							
						</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Cobrador Asignado:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
					   <?php if ($zona): ?>
					   	<?php foreach ($zona as $key): ?>
					   		<input type="hidden" name="txt_id_cobrador" value="<?=$key->id_cobrador?>">
					   	<input type="text" class="form-control" name="txt_cobrador" value="<?=$key->nombre_cobrador?>" placeholder="" readonly="true">
					   	<?php endforeach ?>
					   <?php endif ?>
							
						</div>
</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
	<? $fecha=date("Y-m-d")?>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Fecha Inicio:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<?php if ($fecha_i):
						$fecha_inicio=date('d-m-Y',strtotime($fecha_i));
						 ?>
						 <input type="hidden" name="txt_fecha_i" value="<?=$fecha_i?>">

						<input type="text" class="form-control" class="form-control" value="<?=$fecha_inicio?>" readonly="true" /> 			
						<?php endif ?>
					  
					
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
	<? $fecha=date("Y-m-d")?>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Fecha Final:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<?php if ($fecha_f):
						$fecha_final=date('d-m-Y',strtotime($fecha_f));
						 ?>
						<input type="hidden" name="txt_fecha_f" value="<?=$fecha_f?>">
						<input type="text" class="form-control" class="form-control" value="<?=$fecha_final?>" readonly="true" /> 			
						<?php endif ?>
					  
					
						</div>
					</div>

<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
	<? $fecha=date("Y-m-d")?>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Total cobrado</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<?php if ($total): ?>
							<?php foreach ($total as $key): ?>
						<input type="text" class="form-control" id="" name="" class="form-control" value="<?=$key->monto_cobrado?>" readonly="true" /> 			
							<?php endforeach ?>
						<?php endif ?>
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					
					  <div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
<table class="table table-striped table-hover">
	<caption>Detalle de los Dias Cobrados</caption>
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Monto</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($detallado): ?>
		<?php foreach ($detallado as $key): ?>			
		<tr>
		<?$fecha=date('d-m-Y',strtotime($key->fecha))?>
			<td><?=$fecha?></td>
			<td><?=$key->monto_cobrado?></td>
		</tr>
				<?php endforeach ?>
	<?php endif ?>

	</tbody>
</table>
						</div>
					</div>
<!--*****************************************************************************-->
	
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-print"></i>&nbsp;Imprimir</button>

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
