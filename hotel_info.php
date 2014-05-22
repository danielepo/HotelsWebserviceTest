<!DOCTYPE html>
<?php 
    require_once "./src/ServiceConnector.php";
    require_once "./src/ServiceConnectorImpl.php";
    require_once "./src/HotelRequestor.php";
    require_once "./src/HotelEntry.php";
    
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <?php
    $sc = new ServiceConnectorImpl();
    $hr = new HotelRequestor($sc);
    if(is_numeric($_GET['id'])){
      $id = $_GET['id'];
    }else{
      $id = 0;
    }
    $hotel = $hr->getHotelInfo($id);
    ?>
    <table>
      <tr><td>Nome</td><td><?php echo $hotel->name;?></td></tr>
      <tr><td>Stelle</td><td><?php echo $hotel->stars;?></td></tr>
      <tr><td>Telefono</td><td><?php echo $hotel->telefono;?></td></tr>
      <tr><td>Fax</td><td><?php echo $hotel->fax;?></td></tr>
      <tr><td>Sito</td><td><a href='<?php echo $hotel->web;?>'><?php echo $hotel->web;?></a></td></tr>
    </table>
  </body>
</html>
