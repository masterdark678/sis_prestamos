<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title></title>
<style type="text/css">
  hr, .hrcolor {
   height: 1px;
   border: 0;
   color: #808000;
   background-color: #000000;
}
 </style>
      </head>
      <body>

<br>
<br>
 <div align="center">
   <label><h2><STRONG>Ficha de Prestamo</STRONG></h2></label>
 </div>
   <?php if ($prestamo): ?>
              <?php foreach ($prestamo as $key): ?>

      <div align="left">
      <label><strong>Cliente: </strong<?=$key->nombre_cliente?></label>
<br>
  <label><strong>Monto: </strong><?=$key->monto_prestado?>&nbsp;</label>
  <label><strong>Porcentaje: </strong><?=$key->porcentaje?>%&nbsp;</label>
 
  <label><strong>Total Prestamo: </strong><?=$key->total_prestado?>&nbsp;</label>
  <label><strong>Monto x Cuota: </strong><?=$key->monto_x_cuotas?>&nbsp;&nbsp;</label>
  <label><strong>Cuotas amortizadas: </strong><?=$key->cuotas_amortizadas?>&nbsp;&nbsp;</label>
  <label><strong>Cuotas debe: </strong><?=$key->cuotas_debe?></label>
  <br>
  <label><strong>Atrasos Generados: </strong><?=$suma_atraso?>&nbsp;&nbsp;</label>
  <label><strong>Penalidad generadas:</strong> &nbsp;<?=$key->penalidad?>&nbsp;&nbsp;</label>
  <?$fecha=date('d-m-Y', strtotime($key->fecha_prox_cobro))?>
  <label><strong>Fecha Ultimo Pago:</strong> &nbsp;<?=$fecha?></label>
  
  </div>
        <?php endforeach ?>
<?php endif ?>
  <h3 align="center"><span class ="label label-info">Clientes de la Zona</span></h3></strong>
 <div class="col-md-11" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;"></div> 
 <div class="col-md-11" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;"></div>
     
  <div class="col-md-6 col-sm-6 col-xs-12" align="center">
    <h2><span class ="label label-info">Pagos</span></h2></strong>
    </div>
    
    <table style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;" width="50%" align="center" >
  <thead>
    <tr>
      <th width="10%">Tipo</h5></th>
      <th width="30%"># Cuotas</h5></th>
      <th width="20%">Monto</h5></th>
      <th width="20%">Fecha Pago</h5></th>
      <th width="20%">Observacion</h5></th>
    </tr>
  </thead>
  <tbody>
   
  <?php if ($det_prestamo): ?>
      <?php foreach ($det_prestamo as $key): ?>
       <tr>
      <td width="10%"><?=$key->descripcion_tipo_prestamo?></td>
      <td width="10%" align="center"><?=$key->cuota_det_prestamo?></td>
      <td width="20%" align="center"><?=$key->monto_det_prestamo?></td>
      <?$fecha=date('d-m-Y', strtotime($key->fecha_cobro_det_prestamo))?>
      <td width="20%"><?=$fecha?></td>
      <td width="20%" align="center"><h5><?=$key->observaciones_det_prestamo?></h5></td>
       </tr>
            <?php endforeach ?>
          <?php else: ?>            
    <?php endif ?>

   
  </tbody>
</table>

<div class="col-md-6 col-sm-6 col-xs-12" align="center">
    <h2><span class ="label label-info">Atrasos</span></h2></strong>
    </div>
    
    <table style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;" width="50%" align="center" >
  <thead>
    <tr>
      <th width="20%"><h5><strong>Fecha de atraso</strong></h5></th>
      <th width="30%"><h5><strong>Prox dia Cobro</strong></h5></th>
      <th width="20%"><h5><strong>Observaciones</strong></h5></th>
    </tr>
  </thead>
  <tbody>
  <?php if ($atraso): ?>
      <?php foreach ($atraso as $key): ?>
    <tr>
      <?$fecha_atraso=date('d-m-Y', strtotime($key->fecha_atraso))?>
      <td width="10%" align="center"><?=$fecha_atraso?></td>
      <?$fecha_prox_cobro=date('d-m-Y', strtotime($key->fecha_prox_cobro))?>
      <td width="30%" align="center"><?=$fecha_prox_cobro?></td>
      <td width="20%" align="center"><?=$key->observaciones?></td>
      </tr>
            <?php endforeach ?>
      <?php else: ?>
   
    
    <?php endif ?>


    
  </tbody>
</table>


