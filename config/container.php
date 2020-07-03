<?php

use League\Plates\Engine;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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

  $engine->setFileExtension('tpl');

  $engine->addFolder('layouts', $config['templatesPath'] . "/layouts");
  $engine->addFolder('includes', $config['templatesPath'] . "/includes");

  $engine->loadExtension(
    $container->get(App\Extensions\RouteExtension::class)
  );

  return $engine;
});

$container->add(\Whoops\Run::class, function () {
  $whoops = new \Whoops\Run();

  if (\Whoops\Util\Misc::isAjaxRequest()) {
    $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
  } else if (\Whoops\Util\Misc::isCommandLine()) {
    $whoops->pushHandler(new \Whoops\Handler\PlainTextHandler);
  }
  else {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
  }

  return $whoops;
});

$container->add(App\Extensions\RouteExtension::class, function () use ($container) {
  $router = $container->get(League\Route\Router::class);
  return new App\Extensions\RouteExtension($router);
});

$container->add('notFoundHandler', function () use ($container) {
  $engine = $container->get(Engine::class);
  $response = $container->get(ResponseInterface::class);

  return function (RequestInterface $request) use ($response, $engine) {
    $content = $engine->render('404');

    $response = $response
      ->withStatus(404, "Not Found")
      ->withHeader('Content-Type', 'text/html');

    $response->getBody()->write($content);

    return $response;
  };
});

$container->add(Illuminate\Database\Capsule\Manager::class, function () use ($container) {
  [
    'driver'    => $driver,
    'host'      => $host,
    'database'  => $database,
    'username'  => $username,
    'password'  => $password,
    'charset'   => $charset,
    'collation' => $collation,
    'prefix'    => $prefix,
  ] = $container->get('config')['database'];

  $capsule = new Illuminate\Database\Capsule\Manager;

  $capsule->addConnection([
    'driver'    => $driver,
    'host'      => $host,
    'database'  => $database,
    'username'  => $username,
    'password'  => $password,
    'charset'   => $charset,
    'collation' => $collation,
    'prefix'    => $prefix,
  ]);

  return $capsule;
});

return $container;
