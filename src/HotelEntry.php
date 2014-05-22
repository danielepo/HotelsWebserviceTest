<?php

class HotelEntry{
  public $name;
  public $stars;
  public $href;
  public function __construct($name,$stars,$href)
  {
    $this->name = $name;
    $this->stars = $stars;
    $this->href = $href;
  }

}