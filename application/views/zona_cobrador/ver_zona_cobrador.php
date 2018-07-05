<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Ver Zona a Cobrador Asignado<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>zona_cobrador/imprimir_zona_cobrador" method="POST"  enctype="multipart/form-data">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Zona</label></h5>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					  <?php if ($zona): ?>
					  	<?php foreach ($zona as $key): ?>
					  		<input type="hidden" name="txt_id_zona" value="<?=$key->id_zona_cobrador?>">

					  		<input type="text" class="form-control" name="" value="<?=$key->zona?>" placeholder="" readonly>		
					</div>
				</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Direccion</label></h5></P>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					<input type="text" class="form-control" name="txt_descripcion" value="<?=$key->direccion?>" placeholder="Ingrese Descripcion" required="required" readonly="true">
					
						</div>
					</div>
<!-- **************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Sucursal</label></h5></P>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					<input type="text" class="form-control" name="txt_descripcion" value="<?=$key->descripcion_sucursal?>" placeholder="Ingrese Descripcion" required="required" readonly="true">
					
						</div>
					</div>
<!-- **************************************************************************** -->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Cobrador</label></h5></P>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					<input type="text" class="form-control" name="txt_descripcion" value="<?=$key->dni_cobrador?> &nbsp; <?=$key->nombre_cobrador?>" placeholder="Ingrese Descripcion" required="required" readonly="true">
					<?php endforeach ?>	
					  <?php endif ?>
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<hr>
	<div class="col-md-12 col-sm-12 col-xs-12" align="center">
		<h3><span class ="label label-info">Clientes de la Zona</span></h3></strong>
		<br>
		<table class="table table-condensed table-bordered table-hover">
	<thead>
		<tr>
			<th class="info"width="20%"><h5><strong>Nombre</strong></h5></th>
			<th class="info"width="60%"><h5><strong>Direccion</strong></h5></th>
			<th class="info"width="20%"><h5><strong>Reputacion</strong></h5></th>
		</tr>
	</thead>
	<tbody>
<?php if ($cliente_cobrador): ?>
		<?php foreach ($cliente_cobrador as $key): ?>
		<tr>
			<td><?=$key->dni_cliente?>&nbsp; <?=$key->nombre_cliente?></td>
			<td><?=$key->direccion_cliente?></td>
			<td><?=$key->reputacion_cliente?></td>
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
			  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
								<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-print"></i>&nbsp;Imprimir</button>
								 <a href="<?php echo $this->config->base_url();?>zona_cobrador"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Cancelar</button></a>
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
