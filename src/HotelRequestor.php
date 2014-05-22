<?php
class HotelRequestor{
  public function fetchAll(){
  
    return array(new HotelEntry("Hotel Rio","2","http://rest.mercuriosistemi.com/api/hotel/hotel/1"));
  }
}

