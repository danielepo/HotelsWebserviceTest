<?php

class HotelRequestor
{

  private $serviceConnector;
  private $sortFunction = 'sort_by_star';
  private $paginator;
  private $cacher;

  public function __construct($serviceConnector,$cacher)
  {
    $this->serviceConnector = $serviceConnector;
    $this->cacher = $cacher;
  }

  public function fetchAll()
  {
    try
    {
      $hotelsEntries = $this->cacher->read("entries");
    }
    catch (Exception $exc)
    {
      $entries = $this->serviceConnector->getAllHotels();
      $hotelsArray = array();
      foreach ($entries as $entry)
      {
        $hotelsArray[] = array('id' => (string) $entry["id"], "href" => (string) $entry->link['href']);
      }
      $this->cacher->put("entries", $hotelsArray);
      $hotelsEntries = $this->cacher->read("entries");
    }
    
    $this->paginator->maxLimit = (int)(count($hotelsEntries) /10)+1;
    $first = ($this->paginator->current - 1) * 10;
    $last = min($first + 10, count($hotelsEntries));
    $return = array();
    
    for ($i = $first; $i < $last; $i++)
    {
      $entry = $hotelsEntries[$i];
      $id = (int) $entry->id;

      $hotelInfo = $this->getHotelInfo($id);

      $return[] = $hotelInfo;
    }

    return $return;
  }

  public function setPaginator($paginator)
  {
    $this->paginator = $paginator;
  }

  public function getHotelInfo($id)
  {
    try
    {
      $hotelEntry = $this->cacher->read("hotelInfo_$id");
    }
    catch (Exception $exc)
    {
      $url = "http://rest.mercuriosistemi.com/api/hotel/hotel/$id";
      
      $xmlstr = (string) $this->serviceConnector->getHotelInformation($url);
      $xml = simplexml_load_string($xmlstr);
      
      $stars = (string) $xml["stelle"];
      $name = trim((string) $xml->esercizio->nome);
      
      $hotelEntry = new HotelEntry($name, $stars, $url, $id);
      $this->addOtherFields($xml->esercizio, $hotelEntry);
      
      $this->cacher->put("hotelInfo_$id", $hotelEntry);
    }
    
    return $hotelEntry;
  }
  private function addOtherFields($esercizio, &$hotelEntry){
    if (isset($esercizio->web))
      {
        $hotelEntry->setWeb($esercizio->web);
      }
      if (isset($esercizio->email))
      {
        $hotelEntry->setEmail($esercizio->email);
      }
      if (isset($esercizio->telefono))
      {
        $hotelEntry->setTelefono($esercizio->telefono);
      }
      if (isset($esercizio->fax))
      {
        $hotelEntry->setFax($esercizio->fax);
      }
  }
      
  public function setSorter($sorter)
  {
    $this->serviceConnector->sortFunction($sorter);
  }

}
