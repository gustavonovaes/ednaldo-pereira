<?php

function dd(): void
{
  var_dump(...func_get_args());
  exit;
}
