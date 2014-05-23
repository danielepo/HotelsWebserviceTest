<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceConnectorDummy
 *
 * @author DanielePo
 */
class ServiceConnectorDummy implements ServiceConnector
{

  public function getAllHotels()
  {
    $xmlstring = '<result><entry id="1" prenotazione="true" disponibilita="true">' .
        '<link rel="hotel" href="http://rest.mercuriosistemi.com/api/hotel/hotel/1"/>' .
        '</entry></result>';
    $xml = simplexml_load_string($xmlstring);
    return $xml->xpath("//entry");
  }

  public function getHotelInformation($href)
  {
    $xmlstring = '<hotel tipo="hotel" id="1" stelle="2" eta_max_ridotti="12">'
        . '<esercizio has_logo="false" id="1">'
        . '<nome><![CDATA[ Hotel Rio ]]></nome>'
        . '</esercizio>'
        . '</hotel>';
    return $xmlstring;
  }

  public function sortFunction($sortBy)
  {
    
  }

//put your code here
}
