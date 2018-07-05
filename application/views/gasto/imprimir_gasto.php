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
 <label><h3><STRONG>Gastos</STRONG></h3></label>
   <?php if ($gasto): ?>
              <?php foreach ($gasto as $key): ?>

      <div align="left">
      <?$fecha= date('d-m-Y', strtotime($key->fecha))?>
      <label>Fecha: <strong><?= $fecha;?></strong</label>
<br>
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
           <th width="20%">Tipo de Gasto</th>
           <th width="60%">Descripcion</th>
           <th width="20%">Cantidad</th>
           <th width="20%">Total</th>
        </tr>  <tr> <td  colspan="6"><hr></td></tr>
           <?php if ($det_gasto): ?>
    <?php foreach ($det_gasto as $key): ?>
      
    <tr>
      <td width="20%" align="center"><?=$key->tipo_gasto?></td>
      <td width="60%" align="center"><?=$key->descripcion?></td>
      <td width="20%" align="center"><?=$key->cantidad?></td>
      <td width="20%" align="center"><?=$key->monto?></td>
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
<?php if ($gasto): ?>
  <?php foreach ($gasto as $key): ?>
    <div align="right">
      <label><strong>Total Gasto:</strong> &nbsp;</label>
      <?=$key->total?>
    </div>
  <?php endforeach ?>
<?php endif ?>


