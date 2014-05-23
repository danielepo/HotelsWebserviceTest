<?php



class HotelRequestorTest extends PHPUnit_Framework_TestCase{
  public function testFetchesArray(){
    
    $serviceConnector = new ServiceConnectorDummy();
    $requestor = new HotelRequestor($serviceConnector,new CacherDummy());
    $requestor->setPaginator(new Paginator(1));
    $hotelLists = $requestor->fetchAll();
    $this->assertEquals("Hotel Rio", $hotelLists[0]->name);
    $this->assertEquals("2", $hotelLists[0]->stars);
    $this->assertEquals("http://rest.mercuriosistemi.com/api/hotel/hotel/1", $hotelLists[0]->href);
  }

  public function testFetchesOneHotel(){
    $serviceConnector = new ServiceConnectorDummyWithMoreHotelData();
    $requestor = new HotelRequestor($serviceConnector,new CacherDummy());
    $requestor->setPaginator(new Paginator(1));
    $hotel = $requestor->getHotelInfo(1);
    $this->assertEquals("Hotel Rio", $hotel->name);
    $this->assertEquals("2", $hotel->stars);
    $this->assertEquals("http://www.hotelriolignano.com", $hotel->web);
    $this->assertEquals("info@hotelriolignano.com", $hotel->email);
    $this->assertEquals("+39.0431.71280", $hotel->telefono);
    $this->assertEquals("+39.0431.71637", $hotel->fax);
  }
}
