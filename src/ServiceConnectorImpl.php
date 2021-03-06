<?php

class ServiceConnectorImpl implements ServiceConnector
{

  private $host = "http://rest.mercuriosistemi.com/api/portali/lignanoit/presenti/hotel";
  private $username = "Daniele.Pozzobon";
  private $password = "546219819";
  private $sorter = "nome";
  
  public function sortFunction($sortBy)
  {
    $this->sorter = $sortBy;
  }
  
  public function getAllHotels()
  {
    $host = $this->host;
    $host .= "?ordine=";
    $host .= $this->sorter;
    $xml = $this->execGet($host);
    $transformxml = new SimpleXMLElement($xml);
    $entries = $transformxml->xpath("//entry");
    return $entries;
  }

  public function getHotelInformation($href)
  {
    return $this->execGet($href);
    
  }

  private function execGet($host)
  {
    $url_handler = curl_init($host);
    curl_setopt($url_handler, CURLOPT_HTTPHEADER, array('Accept: text/xml', 'Content-Type: application/json'));
    curl_setopt($url_handler, CURLOPT_HEADER, 1);
    curl_setopt($url_handler, CURLOPT_USERPWD, $this->username . ":" . $this->password);
    curl_setopt($url_handler, CURLOPT_RETURNTRANSFER, TRUE);
    $return = curl_exec($url_handler);
    curl_close($url_handler);
    
    return $this->extractXml($return);
  }
  private function extractXml($responseString){
    $xmlpos = strpos($responseString, '<?xml version="1.0" encoding="UTF-8"?');
    return substr($responseString, $xmlpos);
  }

  

}
