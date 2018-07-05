<div class="right_col" role="main" style="height:auto">
	    	<div class="x_panel" >
					<div class="container">
						<div class="row" >
							<div class="col-md-12 col-sm-12 col-xs-12 animated fadeIn" >
			<div class="table-label">
				<h4><strong>Cierre Total<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>cierre/guardar_cierre" method="POST"  enctype="multipart/form-data">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Total Cobrado</label></h5>
						</div>
						<?php if ($suma_pagos): ?>
							<?php foreach ($suma_pagos as $key): ?>
								
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" name="txt_cobrado" id="txt_cobrado" value="<?=$key->total?>" placeholder=" Ingrese DNI" readonly="true">
							<?php endforeach ?>
						<?php endif ?>

						</div>
					
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Dinero Recibido:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="number" onkeyup="fnccalculo()" class="form-control" name="txt_dinero_recibido" id="txt_dinero_recibido" value="" placeholder="Ingrese Dinero Recibido" required="required">
						</div>
					</div>
<!--*****************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Total:</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<input type="numer" class="form-control" name="txt_dinero_total" id="txt_dinero_total" required="required" readonly="true">
						</div>
					</div>
<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h5><label>Observaciones</label></h5></P>
						</div>
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<textarea name="txt_observaciones" class="form-control" placeholder="Ingrese Observaciones"></textarea>
						</div>
					</div>
<!--*****************************************************************************-->



<!--******************los botones***********************-->
					<div class="col-md-12 col-sm-12 col-xs-12">
					  <hr>
							<div class="col-md-12 col-sm-12 col-xs-12" align="center">
							<button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>

							 <a href="<?php echo $this->config->base_url();?>cierre/grilla"><button type="button" class="btn  btn-lg btn-warning"><i class="fa  fa-exclamation-triangle"></i>&nbsp;Cancelar</button></a>
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
