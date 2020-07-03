<?php

namespace App;

use League\Route\Router;
use Laminas\Diactoros\Response;
use League\Container\Container;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Http\Exception\NotFoundException;

class App
{
  private Container $container;

  public function __construct(Container $container)
  {
    $this->container = $container;
  }

  /**
   * @param ServerRequestInterface $request
   * @param bool $sapiEmit
   *
   * @return ResponseInterface
   */
  public function run(ServerRequestInterface $request, bool $sapiEmit = true): ResponseInterface
  {
    $this->setupErrorHandler();

    try {
      $response = $this->router()->dispatch($request);
    } catch (NotFoundException $e) {
      $response = $this->notFoundHandler($request);
    }

    if ($sapiEmit) {
      $this->sapiEmitter()->emit($response);
    }

    return $response;
  }

  public function router(): Router
  {
    return $this->container->get(Router::class);
  }

  private function sapiEmitter(): SapiEmitter
  {
    return $this->container->get(SapiEmitter::class);
  }

  private function notFoundHandler(RequestInterface $request): ResponseInterface
  {
    return $this->container->get('notFoundHandler')($request);
  }

  private function setupErrorHandler(): void
  {
    $whoops = $this->container->get(\Whoops\Run::class);
    $whoops->register();
  }
}
