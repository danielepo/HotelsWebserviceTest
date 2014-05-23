<?php

interface CacheInt{
  public function put($id,$obj);
  public function read($id);
}

