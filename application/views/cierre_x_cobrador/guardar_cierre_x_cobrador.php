<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Cierre de Cuenta X Cobrador<strong></h4>
				</div>
			<div class="form-container table-container">
				<?php if ($cobrador): ?>
						<?php foreach ($cobrador as $key): ?>
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cierre_x_cobrador/guardar_cierre" method="POST"  enctype="multipart/form-data">
			
				<input type="hidden" name="txt_id_cobrador" value="<?=$key->id?>">
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Cobrador</label></h5>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="txt_dni" value="<?=$key->dni?>, <?=$key->nombre?>" placeholder=" Ingrese DNI" readonly="true">
						
						<?php endforeach ?>
							<?php endif ?>	
						</div>
					
					</div>

<!-- **************************************************************************** -->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<h5><label>Total Cobrado:</label></h5></P>
						</div>
						<?php if ($prestamo_x_cobrador): ?>
							
						<?php foreach ($prestamo_x_cobrador as $key): ?>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_cobrado1" id="txt_cobrado1" class="form-control" value="<?=$key->total?>" placeholder="" readonly="true">
						</div>
						<?$total_cobrado=$key->total?>
						<?php endforeach ?>
					<?php else: ?>
						<?$total_cobrado=0?>
						<?php endif ?>
					</div>
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<h5><label>Gastos Generados:</label></h5></P>
						</div>
						<?php if ($gasto_x_cobrador): ?>
							
						<?php foreach ($gasto_x_cobrador as $key): ?>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_gasto" id="txt_gasto" class="form-control" value="<?=$key->total?>" placeholder="" readonly="true">
						</div>
						<?$total_gastos=$key->total?>
						<?php endforeach ?>
						<?php endif ?>
					</div>
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<h5><label>Total Cobrado-Gastos:</label></h5></P>
						</div>
						
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="txt_cobrado" id="txt_cobrado" class="form-control" value="<?=$total=$total_cobrado-$total_gastos?>" placeholder="" readonly="true">
						</div>
						
					</div>
					
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Dinero Entregado</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="number" class="form-control" name="txt_dinero_recibido" id="txt_dinero_recibido" onkeyup="fnccalculo()" placeholder="Ingrese Dinero Entregado por Cobrador" required="true">
						</div>
					</div>

<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Total</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="number" class="form-control" name="txt_dinero_total" id="txt_dinero_total" value="" placeholder="" readonly="true">
						</div>
					</div>
<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Observaciones</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
						<textarea name="txt_observaciones" class="form-control" placeholder="Ingrese Observaciones"></textarea>
						</div>
					</div>				
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							 <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>

							 <a href="<?php echo $this->config->base_url();?>cierre_x_cobrador/grilla"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Volver</button></a>
							</div>
									</form>
					</div>
					<br><br>
			</div>
			<br>
		</div>
	</div>
  </div>
 </div>
	    	</div>
</div>

