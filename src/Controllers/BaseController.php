<?php

namespace App\Controllers;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class BaseController
{
  private Engine $engine;

  private ServerRequestInterface $request;

  private ResponseInterface $response;

  public function __construct(Engine $engine, ServerRequestInterface $request, ResponseInterface $response)
  {
    $this->engine = $engine;
    $this->response = $response;
    $this->request = $request;
  }

  /**
   * Undocumented function
   * @param string $template
   * @param array $data
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

  protected function json(array $data): ResponseInterface
  {
    $content = \json_encode($data);

    $body = $this->response->getBody();
    $body->write($content);

    return $this->response->withBody($body);
  }

  /**
   * @param string|null $queryParamKey
   *
   * @return ServerRequestInterface|false
   */
  protected function request(?string $queryParamKey = null)
  {
    if (!\is_null($queryParamKey)) {
      return $this->request->getQueryParams()[$queryParamKey] ?? false;
    }

    return $this->request;
  }
}
