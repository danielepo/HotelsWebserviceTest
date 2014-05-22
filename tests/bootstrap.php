<?php

function __autoload($class_name)
{
  if (file_exists("./src/" . $class_name . '.php'))
  {
    require_once "./src/" . $class_name . '.php';
    return true;
  }
  elseif (file_exists("./tests/" . $class_name . '.php'))
  {
    require_once "./tests/" . $class_name . '.php';
    return true;
  }
  return false;
}
