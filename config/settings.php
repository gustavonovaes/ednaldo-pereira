<?php

$settings = [
  'appName' => 'App',
  'templatesPath' => __DIR__ . '/../templates',
];

$settings['database'] = [
  'driver'    => 'mysql',
  'host'      => 'localhost',
  'database'  => 'database',
  'username'  => 'username',
  'password'  => 'password',
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix'    => '',
];

if (
  isset($_SERVER['APP_ENV'])
  && is_readable(__DIR__ . "/{$_SERVER['APP_ENV']}.php")
) {
  require __DIR__ . "/{$_SERVER['APP_ENV']}.php";
}

if (file_exists(__DIR__ . '/env.php')) {
  require __DIR__ . '/env.php';
}

return $settings;
