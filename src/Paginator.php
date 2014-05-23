<?php

class Paginator
{

  public $current;
  public $maxLimit;
  
  public function __construct($page)
  {
    $this->current = $page;
  }

  public function paginator()
  {
    
    $expectedRight = max($this->current + 4, 10);
    $right = min($expectedRight, $this->maxLimit);
    $left = max($right - 9, 1);

    $pages = array();
    for ($i = $left; $i <= $right; $i++)
    {
      $pages[] = $i;
    }
    return $pages;
  }

}
