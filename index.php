<!DOCTYPE html>
<?php
require_once "./src/Cacher.php";
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
    $sorter = 'sort_by_star';
    if (isset($_GET['sort_by']) && $_GET['sort_by'] == 'name')
    {

      $sorter = 'sort_by_name';
    }

    $sc = new ServiceConnectorImpl();
    $hr = new HotelRequestor($sc);
    $hr->setSorter($sorter);
    $hotelList = $hr->fetchAll();
    ?>
    <table>
      <header><tr><td><a href="index.php?sort_by=name">Nome</a></td><td><a href="index.php?sort_by=star">Stelle</a></td></tr></header>
      <?php foreach ($hotelList as $hotel)
      {
        ?>
        <tr><td><a target='_blank' href="hotel_info.php?id=<?php echo $hotel->id; ?>"><?php echo $hotel->name; ?></a></td><td><?php echo $hotel->stars; ?></td></tr>
<?php } ?>
    </table>
  </body>
</html>
