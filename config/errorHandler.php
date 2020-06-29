<?php

use \Whoops\Handler\{JsonResponseHandler, PlainTextHandler, PrettyPageHandler};
use \Whoops\Util\Misc;

error_reporting(E_ALL);
ini_set('display_errors', '0');

$whoops = new \Whoops\Run();

if (Misc::isAjaxRequest()) {
  $whoops->pushHandler(new JsonResponseHandler);
} else if (Misc::isCommandLine()) {
  $whoops->pushHandler(new PlainTextHandler);
} else {
  $whoops->pushHandler(new PrettyPageHandler);
}

$whoops->register();
