<?php

use FastRoute\Route;

// Container with auto wiring and cache
$container = (new \League\Container\Container)->delegate(
  (new League\Container\ReflectionContainer)->cacheResolutions()
);

$container->add('config', $settings);

$container->share(League\Route\Router::class, function () use ($container) {
  $strategy = (new League\Route\Strategy\ApplicationStrategy);
  $strategy->setContainer($container);

  $router = (new League\Route\Router)->setStrategy($strategy);

  return $router;
});

$container->share(Psr\Http\Message\ResponseInterface::class, Laminas\Diactoros\Response::class);

$container->add(Laminas\HttpHandlerRunner\Emitter\SapiEmitter::class);

$container->share(League\Plates\Engine::class, function () use ($container) {
  $config = $container->get('config');

  $engine = new League\Plates\Engine($config['templatesPath']);

  $engine->addFolder('layouts', $config['templatesPath'] . "/layouts");
  $engine->addFolder('includes', $config['templatesPath'] . "/includes");

  $engine->loadExtension(
    $container->get(App\Extensions\RouteExtension::class)
  );

  return $engine;
});

$container->add(App\Extensions\RouteExtension::class, function () use ($container) {
  $router = $container->get(League\Route\Router::class);
  return new App\Extensions\RouteExtension($router);
});

return $container;
