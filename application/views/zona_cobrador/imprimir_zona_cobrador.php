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
 <label><h3><STRONG>Zona Cobrador</STRONG></h3></label>
   <?php if ($zona): ?>
              <?php foreach ($zona as $key): ?>

      <div align="left">
      <label>Zona: <strong><?=$key->zona?></strong</label>
<br>
  <label>Direccion: <strong><?=$key->direccion?></strong></label>
  <br>
  <label>Sucursal: <strong><?=$key->descripcion_sucursal?></strong></label>
  <br>
  <br>
  <label>Cobrador: <strong>"<?=$key->dni_cobrador?> &nbsp; <?=$key->nombre_cobrador?></strong></label>
  </div>
        <?php endforeach ?>
<?php endif ?>
	<h3 align="center"><span class ="label label-info">Clientes de la Zona</span></h3></strong>
 <div class="col-md-11" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;"></div> 
 <div class="col-md-11" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;"></div>
      <table border="0" width="100%">
        <tr>
           <th width="20%">Nombre</th>
           <th width="70%">Direccion</th>
           <th width="10%">Reputacion</th>
        </tr>  
          <?php if ($cliente_cobrador): ?>
						<?php foreach ($cliente_cobrador as $key): ?>
      
    
    <tr> <td  colspan="6"><hr></td></tr>
    <tr>

      <td width="20%"><?=$key->dni_cliente?>&nbsp; <?=$key->nombre_cliente?></td>
      <td width="70%" align="center"><?=$key->direccion_cliente?></td>
      <td width="10%" align="center"><?=$key->reputacion_cliente?></td>
    </tr>
  <?php endforeach ?>
  <?php endif ?>
  </table>


