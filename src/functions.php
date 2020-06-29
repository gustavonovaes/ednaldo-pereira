<?php

function app(): App\App
{
  global $app;
  return $app;
}

function router(): League\Route\Router
{
  return app()->router();
}

function dd(): void
{
  var_dump(...func_get_args());
  exit;
}
