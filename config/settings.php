<?php

// Timezone
date_default_timezone_set('America/Recife');

$settings = [
  'appName' => 'App',
  'templatesPath' => __DIR__ . '/../templates',
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
