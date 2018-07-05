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
 <label><h3><STRONG>Reporte Por Sucursal</STRONG></h3></label>
   <?php if ($sucursal): ?>
              <?php foreach ($sucursal as $key): ?>

      <div align="left">
      <label>Sucursal: <strong><?= $key->descripcion;?></strong</label>
    <?php endforeach ?>
<?php endif ?>
<br>
<?$fecha_inicio=date('d-m-Y',strtotime($fecha_i))?>
<?$fecha_fin=date('d-m-Y',strtotime($fecha_f))?>
<label>Fecha Inicio: &nbsp; <?=$fecha_inicio;?></label>
  <br>
<label>Fecha Final: &nbsp; <?=$fecha_fin;?></label>
  <br>
  <?php if ($total): ?>
      <?php foreach ($total as $key): ?>
      <label>Total: &nbsp; <?=$key->monto_cobrado?></label>
      
    <?php endforeach ?>
  <?php endif ?>
  <br>
  <br>
  </div>
        
 <div class="col-md-11" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;"></div>
     <table border="0" width="100%">
        <tr>
           <th width="20%">Fecha</th>
           <th width="20%">Cobrador</th>
           <th width="60%">Monto</th>
           
        </tr>  <tr> <td  colspan="6"><hr></td></tr>
           <?php if ($detallado): ?>
    <?php foreach ($detallado as $key): ?>
      
    <tr>
        <?$fecha=date('d-m-Y',strtotime($key->fecha))?>
      <td width="20%" align="center"><?=$fecha?></td>
      <td width="20%" align="center"><?=$key->nombre_cobrador?></td>
      <td width="60%" align="center"><?=$key->monto_cobrado?></td>
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
