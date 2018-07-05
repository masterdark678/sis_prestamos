<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
    foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
  <title>Prestamos</title>
    <!-- Custom Theme Style -->
   <link href="<?=$this->config->base_url()?>assets/css/custom.css" rel="stylesheet">
   <script src="<?= $this->config->base_url();?>assets/js/nprogress.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="<?= $this->config->base_url();?>assets/js/highcharts.js"></script>
</head>




