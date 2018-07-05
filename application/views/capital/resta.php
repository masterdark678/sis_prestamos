<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Restar Capital Inicial<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>capital/guardar_restar_capital" method="POST"  enctype="multipart/form-data">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Socio</label></h5>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
						<select class="selectpicker form-control" name="id_socio" id="id_socio" data-show-subtext="true" data-live-search="true">
										<option value="">Seleccione Socio</option>
										 <?php
										 if ($socio) {
										 foreach ($socio as $i) {
								             echo '<option value="'. $i->id .'">'.$i->nombre.'</option>';
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
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Descripcion</label></h5></P>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					<input type="text" class="form-control" name="txt_descripcion" value="" placeholder="Ingrese Descripcion" required="required">
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-1 col-sm-1 col-xs-12">
						<h5><label>Capital:</label></h5></P>
						</div>
					  <div class="col-md-11 col-sm-11 col-xs-12">
					<input type="number" class="form-control" name="txt_capital_inicial" value="" placeholder="Ingrese Capital" required="required">
						</div>
					</div>

	
<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
							 <a href="<?php echo $this->config->base_url();?>capital"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Cancelar</button></a>
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
