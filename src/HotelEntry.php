<?php

class HotelEntry
{

  public $name;
  public $stars;
  public $href;
  public $web;
  public $email;
  public $telefono;
  public $fax;

  public function __construct($name, $stars, $href)
  {
    $this->name = $name;
    $this->stars = $stars;
    $this->href = $href;
  }
  public function setEmail($email)
  {
    $this->email =  trim((string) $email);
  }
  public function setTelefono($telefono)
  {
    $this->telefono = trim((string) $telefono);
  }
  public function setFax($fax)
  {
    $this->fax = trim((string) $fax);
  }
  public function setWeb($web)
  {
    $this->web = trim((string) $web);
  }


}
