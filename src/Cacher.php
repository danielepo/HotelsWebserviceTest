<?php

class Cacher implements CacheInt
{

  private $serialized;
  private $TTL = 3600; //Time to live settato arbitrariamente a 1 h

  public function __construct()
  {
    $filename = "cache.txt";
    if (!file_exists($filename))
    {
      $this->serialized = array();
    }
    else
    {
      $handle = fopen($filename, "r");
      $file = fread($handle, filesize($filename));
      fclose($handle);

      $this->serialized = json_decode($file);
    }
  }


  public function put($index, $obj)
  {
    $this->serialized->$index = array('time' => microtime(true), 'object' => $obj);

    $handle = fopen("cache.txt", "w");
    fwrite($handle, json_encode($this->serialized));
    fclose($handle);
  }

  public function read($index)
  {
    if (!isset($this->serialized->$index))
    {
      throw new Exception("Index Still Not Saved");
    }
    if (isset($this->serialized->$index->time))
    {
      $savedTime = $this->serialized->$index->time;
      $diff = microtime(true) - $savedTime;
      if ($diff > $this->TTL)
      {
        throw new Exception("Cache Too Old");
      }
    }
    else
    {
      throw new Exception("Cache Too Old");
    }
    return $this->serialized->$index->object;
  }

}
