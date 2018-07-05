<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Movimiento de Sucursal<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>caja/imprimir_det_sucursal" method="POST"  enctype="multipart/form-data">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Sucursal</label></h5>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					  <?php if ($sucursal): ?>
					  	<?php foreach ($sucursal as $key): ?>
					  		<input type="hidden" name="txt_id_caja" value="<?=$key->id_caja?>">

					  		<input type="text" class="form-control" name="" value="<?=$key->descripcion_sucursal?>" placeholder="" readonly>		
					</div>
				</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Direccion</label></h5></P>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					<input type="text" class="form-control" name="txt_descripcion" value="<?=$key->direccion_sucursal?>" placeholder="Ingrese Descripcion" required="required" readonly="true">
					<?php endforeach ?>	
					  <?php endif ?>
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<hr>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<label>Movimiento Detallado</label>
		<table class="table table-condensed table-bordered table-hover">
	<thead>
		<tr>
			<th class="info"><h5><strong>Tipo de Movimiento</strong></h5></th>
			<th class="info"><h5><strong>Monto</strong></h5></th>
			<th class="info"><h5><strong>Fecha</strong></h5></th>
		</tr>
	</thead>
	<tbody>
	<?php if ($det_sucursal): ?>
		<?php foreach ($det_sucursal as $key): ?>
			
		
		<tr>
			<td><?=$key->descripcion_tipo_ingreso?></td>
			<td><?=$key->monto?></td>
			<td><?=$key->fecha_det_caja?></td>
		</tr>
	<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>
	</div>
</div>	
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					<br>
<br>
<br>
<br>
<br>
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
								<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-print"></i>&nbsp;Imprimir</button>
								 <a href="<?php echo $this->config->base_url();?>caja"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Cancelar</button></a>
							</div>   
					</form>
			</div>
			<br>
		</div>
	</div>
  </div>
 </div>
	    	</div>
</div>
