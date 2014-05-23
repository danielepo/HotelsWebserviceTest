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
//require_once "./src/Paginator.php";
//require_once "./src/CacheInt.php";
//require_once "./src/Cacher.php";
//require_once "./src/ServiceConnector.php";
//require_once "./src/ServiceConnectorImpl.php";
//require_once "./src/HotelRequestor.php";
//require_once "./src/HotelEntry.php";
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <?php
    $sorter = 'nome';
    
    if (isset($_GET['sort_by']) && $_GET['sort_by'] == 1)
    {
      $sorter = 'stelle';
    }
    $page = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page']))
    {
      $page = $_GET['page'];
    }

    $sc = new ServiceConnectorImpl();
    $hr = new HotelRequestor($sc,new Cacher());
    $hr->setSorter($sorter);
    $paginator = new Paginator($page);
    $hr->setPaginator($paginator);
    $hotelList = $hr->fetchAll();
    ?>
    <table>
      <header><tr><td><a href="index.php?sort_by=0">Nome</a></td><td><a href="index.php?sort_by=1">Stelle</a></td></tr></header>
      <?php foreach ($hotelList as $hotel)
      {
        ?>
        <tr><td><a target='_blank' href="hotel_info.php?id=<?php echo $hotel->id; ?>"><?php echo $hotel->name; ?></a></td><td><?php echo $hotel->stars; ?></td></tr>
<?php } ?>
    </table>
        <table><tr>
      <?php 
      $pagesList = $paginator->paginator();
      foreach ($pagesList as $number){
        echo "<td><a href='index.php?sort_by=0&page=$number'>$number</a></td>";
      }
        
      ?>
      </tr></table>
  </body>
</html>
