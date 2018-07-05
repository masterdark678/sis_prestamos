<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>ver Gasto<strong></h4>
				</div>
			<div class="form-container table-container">
				<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>gasto/imprimir_gasto" method="POST"  enctype="multipart/form-data">
				<div class="form-group">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Fecha</label></h5>
						<?php if ($gasto): ?>
							
						<?php foreach ($gasto as $key): ?>
							<input type="hidden" name="txt_id_gasto" value="<?=$key->id?>">
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					  <?$fecha= date('d-m-Y',strtotime($key->fecha))?>
						<input type="text" class="form-control" name="txt_fecha" value="<?=$fecha?>">

						</div>
					
					</div>

						
					<?php endforeach ?>
			<?php endif ?>

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
		
		</tr>
	</thead>
	<tbody>
		<?php if ($det_gasto): ?>
			<?php foreach ($det_gasto as $key): ?>
		<tr>
		
			<td><?=$key->tipo_gasto?></td>
			<td><?=$key->descripcion?></td>
			<td><?=$key->cantidad?></td>
			<td><?=$key->monto?></td>
		</tr>
		<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>
</div>
</div>
<div class="col-md-4 col-sm-4 col-xs-4 col-xs-offset-8">
<table class="table table-condensed table-bordered ">
	<thead>
		<tr>
		<?php if ($gasto): ?>
			<?php foreach ($gasto as $key): ?>
				
			<th class="info col-md-1"><h5>Total</h5></th>
			<th  class="col-md-1"><h5 ><div id="total"><?=$key->total?></h5></th>
			<?php endforeach ?>
		<?php endif ?>
			<input type="hidden" id="txt_total_2"name="txt_total_2" value="">
		</tr>
	</thead>
</table>
	</div>
<!--******************los botones***********************-->
			<div class="col-md-12 col-sm-12 col-xs-12" align="center">
				<hr>
			<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-print"></i>&nbsp;Imprimir</button>
			 <a href="<?=$this->config->base_url()?>gasto" class="btn btn-danger btn-lg">Cancelar</a>
			
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
