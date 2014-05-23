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

$sc = new ServiceConnectorImpl();
$hr = new HotelRequestor($sc, new Cacher());
if (is_numeric($_GET['id']))
{
  $id = $_GET['id'];
}
else
{
  $id = 0;
}
VisitsLogger::log($_SERVER['REMOTE_ADDR'], $id, "HOTEL_INFO");
$hotel = $hr->getHotelInfo($id);
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <table>
      <tr><td>Nome</td><td><?php echo $hotel->name; ?></td></tr>
      <tr><td>Stelle</td><td><?php echo $hotel->stars; ?></td></tr>
      <tr><td>Telefono</td><td><?php echo $hotel->telefono; ?></td></tr>
      <tr><td>Fax</td><td><?php echo $hotel->fax; ?></td></tr>
      <tr><td>Sito</td><td><a href='<?php echo $hotel->web; ?>'><?php echo $hotel->web; ?></a></td></tr>
    </table>
  </body>
</html>
