<!DOCTYPE html>
<?php

function __autoload($class_name)
{
  if (file_exists("./src/" . $class_name . '.php'))
  {
    require_once "./src/" . $class_name . '.php';
    return true;
  }
  return false;
}

$sorter = 'nome';
$order = 0;

if (isset($_GET['sort_by']) && $_GET['sort_by'] == 1)
{
  $sorter = 'stelle';
  $order = 1;
}
$page = 1;
if (isset($_GET['page']) && is_numeric($_GET['page']))
{
  $page = $_GET['page'];
}

VisitsLogger::log(addslashes($_SERVER['REMOTE_ADDR']), $page, "HOTEL_LIST", $order);

$sc = new ServiceConnectorImpl();
$hr = new HotelRequestor($sc, new Cacher());
$paginator = new Paginator($page);

$hr->setSorter($sorter);
$hr->setPaginator($paginator);
$hotelList = $hr->fetchAll();
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <td><a href="index.php?sort_by=0">Nome</a></td>
          <td><a href="index.php?sort_by=1">Stelle</a></td>
        </tr>
      </thead>
      <?php
      foreach ($hotelList as $hotel)
      {
        ?>
        <tr>
          <td><a target='_blank' href="hotel_info.php?id=<?php echo $hotel->id; ?>"><?php echo $hotel->name; ?></a></td>
          <td><?php echo $hotel->stars; ?></td>
        </tr>
<?php } ?>
    </table>
    <table>
      <tr>
        <?php
        $pagesList = $paginator->paginator();
        foreach ($pagesList as $number)
        {
          echo "<td><a href='index.php?sort_by=$paginator->current&page=$number'>$number</a></td>";
        }
        ?>
      </tr>
    </table>
  </body>
</html>
