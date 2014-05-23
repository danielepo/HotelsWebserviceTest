<?php

class VisitsLogger
{


  public static function log($ip, $pagenumber, $pagetype, $order = -1)
  {
   $server = 'localhost';
   $dbPort = 3306;
   $dbUsername = 'test';
   $dbPassword = 'test';
   $dbDefaultDatabase = 'visits_logger';
    $db = new mysqli($server,$dbUsername,$dbPassword,$dbDefaultDatabase,$dbPort);
//    $db->init();
//    $res = $db->real_connect($server, $dbUsername, $dbPassword, $dbDefaultDatabase, $dbPort);
    if ($order != -1)
    {
      $query = "INSERT INTO visits (ip,pagenumber,pagetype, `order`,time) VALUES('$ip',$pagenumber,'$pagetype',$order, NOW())";
      $res = $db->query($query);
    }
    else
    {
      $res = $db->query("INSERT INTO visits (ip,pagenumber,pagetype,time) VALUES('$ip','$pagenumber','$pagetype',NOW())");
    }
    $db->close();
  }

}
