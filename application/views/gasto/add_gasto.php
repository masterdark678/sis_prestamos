<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Agregar Gasto<strong></h4>
				</div>
			<div class="form-container table-container">
				<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>gasto/guardar_gasto" method="POST"  enctype="multipart/form-data">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Cobrador</label></h5>
						</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<?php if ($cobrador): ?>
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
						<?php else: ?>
					
					<?php endif ?>
					</div>
						
				
					<div class="col-md-2 col-sm-2 col-xs-12">
					
						<?php foreach ($ultimo_gasto as $key): ?>
							<input type="hidden" name="txt_id_gasto" value="<?=$key->id?>">
						<?php endforeach ?>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						
						</div>

					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Fecha</label></h5>
						<?php foreach ($ultimo_gasto as $key): ?>
							<input type="hidden" name="txt_id_gasto" value="<?=$key->id?>">
						<?php endforeach ?>
						</div>
						<?$fecha=date('Y-m-d');?>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="date" class="form-control" name="txt_fecha" value="<?=$fecha?>" placeholder=" Ingrese DNI" required="true">
						</div>
					
					</div>
<!--*****************************************************************************-->
			<div class="form-group">
					<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Tipo Gasto</label></h5>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<select class="selectpicker form-control" name="id_tipo_gasto" id="id_tipo_gasto" data-show-subtext="true" data-live-search="true">
										<option value="">Seleccione Tipo de Gasto</option>
										 <?php
										 if ($tipo_gasto) {
										 foreach ($tipo_gasto as $i) {
								             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
						</div>
					
					</div>
		<div class="form-group">
<hr>
	  <div class="col-md-7 col-sm-7 col-xs-12">
	  <p></p>
	  <input type="text" class="form-control" name="txt_descripcion" value="" placeholder="Ingrese descripcion">
	</div>
	
	<div class="col-md-2 col-sm-2 col-xs-12">
	<p></p>
		<input type="number" placeholder="Cantidad" name="txt_cantidad" id="txt_cantidad" class="form-control"min="{1"} max="" step="">
	</div>
	<div class="col-md-2 col-sm-2 col-xs-12">
	<p></p>
		<input type="number" placeholder="Monto" name="txt_total" id="txt_total" class="form-control"min="{1"} max="" step="">
	</div>
	<div class="col-md-1 col-sm-1 col-xs-12">
	<p></p>
	<p align="center">
		<button class="btn btn-success " onclick="guardar_det_gasto()" name="btn_enviar_producto"id="btn_enviar_producto" type="button">Agregar</button>
	</p>
		
	</div>
	</div>
	<!--**************************-->

	<div class="col-md-12 col-sm-12 col-xs-12">
<div id="det_gasto">
<hr>
<table class="table table-condensed table-bordered table-hover">
	<thead>
		<tr>
			<th class="info"><h5><strong>Tipo Gasto</strong></h5></th>
			<th class="info"><h5><strong>Descripcion</strong></h5></th>
			<th class="info"><h5><strong>Cantidad</strong></h5></th>
			<th class="info"><h5><strong>Total</strong></h5></th>
			<th class="info"><h5><strong>Acciones</strong></h5></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
</div>
</div>
<div class="col-md-4 col-sm-4 col-xs-4 col-xs-offset-8">
<table class="table table-condensed table-bordered ">
	<thead>
		<tr>
			<th class="info col-md-1"><h5>Total</h5></th>
			<th  class="col-md-1"><h5 ><div id="total">0</h5></th>
			<input type="hidden" id="txt_total_2"name="txt_total_2" value="">
		</tr>
	</thead>
</table>
	</div>
<!--******************los botones***********************-->
			<div class="col-md-12 col-sm-12 col-xs-12" align="center">
				<hr>
			<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
			<?php foreach ($ultimo_gasto as $key): ?>
			 <button type="button" class="btn btn-lg btn-danger"OnClick="eliminar_gasto(this)"value="<?=$key->id?>">Cancelar</button></P>
			 <?php endforeach ?>
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
