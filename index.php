<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <?php
    $host = "http://rest.mercuriosistemi.com/api/portali/lignanoit/presenti/hotel";
    $username = "Daniele.Pozzobon";
    $password = "546219819";
    $url_handler = curl_init($host);
    curl_setopt($url_handler, CURLOPT_HTTPHEADERS, array('Accept: text/xml','Content-Type: application/json'));
    curl_setopt($url_handler, CURLOPT_HEADER, 1);
    curl_setopt($url_handler, CURLOPT_USERPWD, $username . ":" . $password);
    curl_setopt($url_handler, CURLOPT_TIMEOUT, 30);
 //   curl_setopt($process, CURLOPT_POSTFIELDS, $payloadName);
    curl_setopt($url_handler, CURLOPT_RETURNTRANSFER, TRUE);
    $return = curl_exec($url_handler);
    $xmlpos = strpos($return, '<?xml version="1.0" encoding="UTF-8"?');
    $xmlstring = substr($return, $xmlpos);
    $xml = new SimpleXMLElement($xmlstring);
    
    $entries = $xml->xpath("//entry");
    curl_close($process);
    // put your code here
    echo "hello";
    ?>
  </body>
</html>
