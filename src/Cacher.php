<?php

class Cacher
{

  private $TTL = 3600; //Time to live settato arbitrariamente a 1 h

  public function put($obj)
  {
    $serializable = array('time' => microtime(true), 'object' => $obj);

    $handle = fopen("cache.txt", "w");
    fwrite($handle, json_encode($serializable));
    fclose($handle);
  }

  public function read()
  {
    $filename = "cache.txt";
    if (!file_exists($filename))
    {
      throw new Exception("Cache Not Set");
    }
    $handle = fopen($filename, "r");
    $file = fread($handle, filesize($filename));
    fclose($handle);

    $serialized = json_decode($file);
    $savedTime = $serialized->time;
    $diff = microtime(true) - $savedTime;
    if ($diff > $this->TTL)
    {
      throw new Exception("Cache Too Old");
    }
    return $serialized->object;
  }

}
