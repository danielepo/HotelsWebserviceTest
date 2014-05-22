<?php



class ServiceConnectorImplTest extends PHPUnit_Framework_TestCase{
  public function testReadsWebService(){
    
    $serviceConnector = new ServiceConnectorImpl();
    $this->assertEquals(147, count($serviceConnector->getAllHotels()));
  }

  public function testFetchesOneHotel(){
    $serviceConnector = new ServiceConnectorImpl();
    $xml = $serviceConnector->getHotelInformation("http://rest.mercuriosistemi.com/api/hotel/hotel/1072");
    $hotelxml =  simplexml_load_string($xml);
    $this->assertEquals("Hotel Rio", trim((string)$hotelxml->esercizio->nome));
    $this->assertEquals("http://www.hotelriolignano.com", trim((string)$hotelxml->esercizio->web));
    $this->assertEquals("info@hotelriolignano.com", trim((string)$hotelxml->esercizio->email));
    $this->assertEquals("+39.0431.71280", trim((string)$hotelxml->esercizio->telefono));
    $this->assertEquals("+39.0431.71637", trim((string)$hotelxml->esercizio->fax));
  }
}
