<?php

namespace App\Controllers;

use League\Plates\Engine;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;

class BaseController
{
  private Engine $engine;

  private ResponseInterface $response;

  private Router $router;

  public function __construct(Engine $engine, ResponseInterface $response, Router $router)
  {
    $this->engine = $engine;
    $this->response = $response;
    $this->router = $router;
  }

  /**
   * @param string $template
   * @param array<mixed> $data
   *
   * @return \Psr\Http\Message\ResponseInterface
   */
  protected function render(string $template, array $data = []): ResponseInterface
  {
    $content = $this->engine->render($template, $data);

    $body = $this->response->getBody();
    $body->write($content);

    return $this->response->withBody($body);
  }

  /**
   * @param array<mixed> $data
   *
   * @return \Psr\Http\Message\ResponseInterface
   */
  protected function json(array $data): ResponseInterface
  {
    $content = \json_encode($data);

    $body = $this->response->getBody();
    $body->write($content);

    return $this->response->withBody($body);
  }

  protected function redirect(string $url): ResponseInterface
  {
    return $this->response
      ->withHeader('Location', (string)$url)
      ->withStatus(301);
  }

  protected function redirectTo(string $routeName, array $routeArgs = []): ResponseInterface
  {
    $url = $this->router->getNamedRoute($routeName)->getPath();

    foreach ($routeArgs as $arg => $value) {
      $url = \preg_replace("/{{$arg}(:[^}]+)?}/", $value, $url, 1);
    }

    return $this->redirect($url);
  }
}
