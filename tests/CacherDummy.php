<?php

class CacherDummy implements CacheInt
{

  private $obj;

  public function put($id, $obj)
  {
    $this->obj = json_encode($obj);
  }

  public function read($id)
  {
    if (isset($this->obj))
    {
      $resp = json_decode($this->obj);
      unset($this->obj);
      return $resp;
    }
    throw new Exception("Cache Too Old");
  }

}
