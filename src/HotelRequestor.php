<?php
class HotelRequestor{
  private $serviceConnector;
  public function __construct($serviceConnector)
  {
    $this->serviceConnector = $serviceConnector;
  }

  public function fetchAll(){
  $this->serviceConnector = new ServiceConnectorDummy();
  $hotelsEntries = $this->serviceConnector->getAllHotels();
  $return = array();
  foreach($hotelsEntries as $entry){
    $url = (string)$entry->link['href'];
    $hotelInfo = (string)$this->serviceConnector->getHotelInformation($url);
    $xml = simplexml_load_string($hotelInfo);
    $stars = (string)$xml["stelle"];
    $name = trim((string)$xml->esercizio->nome);
    $return[] = new HotelEntry($name,$stars,$url);
  }
  return $return;
  }
}

