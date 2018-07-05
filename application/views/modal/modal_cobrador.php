<div class="modal fade  "id="mcobrador">
		        <div class="modal-dialog modal-lg">
		          <div class="modal-content">
		            <div class="modal-header">
		<a href="<?= $this->config->base_url();?>peritaje">
		              <button type="button" class="close" aria-hidden="true">&times;</button></a>
		               <strong><h3><span class ="label label-warning">Nuevo Peritaje</span></h3></strong>
		            </div> <!-- termina el header -->
					<div class="container">
						<div class="row">
	<form action="<?php echo $this->config->base_url();?>cierre_x_cobrador/add_cierre" method="POST" accept-charset="utf-8">
	<br>
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-2 col-sm-2 col-xs-12">
   			<label>Cobrador:</label>
   		</div>
		<div class="col-md-7 col-sm-7 col-xs-12">
		   <select class="selectpicker form-control" data-live-search="true" id="id_cobrador" name="id_cobrador"required>
				  <?php if ($cobrador): ?>
				  	<option data-tokens="" value="0">Seleccione</option>
					  <?php foreach ($cobrador as $key): ?>
						<option data-tokens="<?= $key->dni.", ".$key->nombre?>" value="<?= $key->id?>"><?= $key->dni?>."<strong>Nombre:</strong> "<?=$key->nombre?>"</option>
					  <?php endforeach ?>
					<?php else:?>
						<option data-tokens="" value="0">Seleccione</option>
				  <?php endif ?>
		</select>
		<p></p>
		</div>
			
	</div>
			</div>
			</div>
					<br>
		            <div class="modal-footer">
		            	<left><button type="submit" class="btn btn-primary"><strong><i class="fa fa-plus-circle"></i>&nbsp; Continuar</strong></button></left>
		            	</form>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->