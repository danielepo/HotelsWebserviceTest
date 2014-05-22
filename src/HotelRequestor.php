<?php

class HotelRequestor
{

  private $serviceConnector;
  private $sortFunction = 'sort_by_star';

  public function __construct($serviceConnector)
  {
    $this->serviceConnector = $serviceConnector;
  }

  public function fetchAll()
  {
    $hotelsEntries = $this->serviceConnector->getAllHotels();
    $return = array();
    $cacher = new Cacher();
    try
    {
      $return = $cacher->read();
    }
    catch (Exception $exc)
    {


      foreach ($hotelsEntries as $entry)
      {
        $id = (int) $entry["id"];
        $url = (string) $entry->link['href'];
        $hotelInfo = (string) $this->serviceConnector->getHotelInformation($url);
        $xml = simplexml_load_string($hotelInfo);
        $stars = (string) $xml["stelle"];
        $name = trim((string) $xml->esercizio->nome);

        $return[] = $this->getHotelInfo($id);
        if (count($return) > 5)
        {
          break;
        }
      }
      $cacher->put($return);
    }
    uasort($return, $this->sortFunction);
    return $return;
  }

  public function getHotelInfo($id)
  {
    $url = "http://rest.mercuriosistemi.com/api/hotel/hotel/$id";
    $hotelInfo = (string) $this->serviceConnector->getHotelInformation($url);
    $xml = simplexml_load_string($hotelInfo);
    $stars = (string) $xml["stelle"];
    $name = trim((string) $xml->esercizio->nome);
    $hotelEntry = new HotelEntry($name, $stars, $url, $id);
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

  public function setSorter($sorter)
  {
    $this->sortFunction = $sorter;
  }

}

function sort_by_name($a, $b)
{
  if ($a->name == $b->name)
  {
    return 0;
  }
  return ($a->name < $b->name) ? -1 : 1;
}

function sort_by_star($a, $b)
{
  if ($a->stars == $b->stars)
  {
    return 0;
  }
  return ($a->stars < $b->stars) ? 1 : -1;
}
