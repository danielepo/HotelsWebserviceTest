<?php



class HotelRequestorTest extends PHPUnit_Framework_TestCase{
  public function testFetchesArray(){
    
    $serviceConnector = new ServiceConnectorDummy();
    $requestor = new HotelRequestor($serviceConnector);
    $hotelLists = $requestor->fetchAll();
    $this->assertEquals("Hotel Rio", $hotelLists[0]->name);
    $this->assertEquals("2", $hotelLists[0]->stars);
    $this->assertEquals("http://rest.mercuriosistemi.com/api/hotel/hotel/1", $hotelLists[0]->href);
  }

}
