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
    $xmlstring = '<entry id="1" prenotazione="true" disponibilita="true">' .
        '<link rel="hotel" href="http://rest.mercuriosistemi.com/api/hotel/hotel/1"/>' .
        '</entry>';
    return new SimpleXMLElement($xmlstring);
  }

  public function getHotelInformation()
  {
    
  }

//put your code here
}
