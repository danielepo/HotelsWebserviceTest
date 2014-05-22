<?php

class HotelRequestor
{

  private $serviceConnector;

  public function __construct($serviceConnector)
  {
    $this->serviceConnector = $serviceConnector;
  }

  public function fetchAll()
  {
    $hotelsEntries = $this->serviceConnector->getAllHotels();
    $return = array();
    foreach ($hotelsEntries as $entry)
    {
      $id = $entry["id"];
      $url = (string) $entry->link['href'];
      $hotelInfo = (string) $this->serviceConnector->getHotelInformation($url);
      $xml = simplexml_load_string($hotelInfo);
      $stars = (string) $xml["stelle"];
      $name = trim((string) $xml->esercizio->nome);
    //  $return[] = new HotelEntry($name, $stars, $url);
      $return[] =$this->getHotelInfo($id);
    }
    return $return;
  }

  public function getHotelInfo($id)
  {
    $url = "http://rest.mercuriosistemi.com/api/hotel/hotel/$id";
    $hotelInfo = (string) $this->serviceConnector->getHotelInformation($url);
    $xml = simplexml_load_string($hotelInfo);
    $stars = (string) $xml["stelle"];
    $name = trim((string) $xml->esercizio->nome);
    $hotelEntry = new HotelEntry($name, $stars, $url);
    if (isset($xml->esercizio->web))
    {
      $hotelEntry->setWeb($xml->esercizio->web);
    }
    if (isset($xml->esercizio->email))
    {
      $hotelEntry->setEmail($xml->esercizio->email);
    }
    if (isset($xml->esercizio->telefono))
    {
      $hotelEntry->setTelefono($xml->esercizio->telefono);
    }
    if (isset($xml->esercizio->fax))
    {
      $hotelEntry->setFax($xml->esercizio->fax);
    }
    return $hotelEntry;
  }

}
