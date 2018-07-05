<div class="right_col" role="main" style="height:1040px;">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Reporte X Sucursal<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>reporte_sucursal_fechas/calculo_sucursal" method="POST"  enctype="multipart/form-data">
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-2 col-sm-2 col-xs-2">
						<h5><label>Sucursal:</label></h5></P>
						</div>
					   <div class="col-md-12 col-sm-12 col-xs-12">
							<select class="form-control" name="id_sucursal" id="id_sucursal" data-show-subtext="true" data-live-search="true"  required="required">
										<option value="">Seleccione sucursal</option>
										 <?php
										 if ($sucursal) {
										 foreach ($sucursal as $i) {
								             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
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
					<input type="date" class="form-control" id="txt_fecha_i" name="txt_fecha_i" class="form-control" value="<? echo $fecha; ?>"/> 
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Fecha Fin:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="date" class="form-control" id="txt_fecha_f" name="txt_fecha_f" class="form-control" value="<? echo $fecha; ?>"/> 
						</div>
					</div>
<!--*****************************************************************************-->
	
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Calcular</button>

							 <a href="<?php echo $this->config->base_url();?>principal"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Cancelar</button></a>
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
