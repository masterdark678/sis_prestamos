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
 <label><h3><STRONG>Movimiento Detallado por Sucursal</STRONG></h3></label>
   <?php if ($sucursal): ?>
              <?php foreach ($sucursal as $key): ?>

      <div align="left">
      <label>Sucursal: <strong><?= $key->descripcion_sucursal;?></strong</label>
<br>
  <label>Direccion: <strong><?= $key->direccion_sucursal;?></strong></label>
  <br>
  <br>
  <br>
  </div>
        <?php endforeach ?>
<?php endif ?>
 <div class="col-md-11" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;"></div>
 
 
 <div class="col-md-11" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;"></div>
      <table border="0" width="100%">
        <tr>
           <th width="60%">Tipo de Movimiento</th>
           <th width="20%">Monto</th>
           <th width="20%">Fecha</th>
        </tr>  <tr> <td  colspan="6"><hr></td></tr>
           <?php if ($det_sucursal): ?>
    <?php foreach ($det_sucursal as $key): ?>
      
    
    <tr>
      <td width="60%"><?=$key->descripcion_tipo_ingreso?></td>
      <td width="20%" align="center"><?=$key->monto?></td>
        <?$fecha=date('d-m-Y', strtotime($key->fecha_det_caja))?>
      <td width="20%" align="center"><?=$fecha?></td>
    </tr>
  <?php endforeach ?>
  <?php endif ?>
  </table>
<!--pie de pagina-->
      <?
          $j=0;
          $i=12;
          while ( $j<= $i) {
            $j=$j+1; ?>
             <br>
            <?  }?>
<hr>


