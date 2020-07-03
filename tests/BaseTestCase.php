<?php

namespace Tests;

use App\App;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;

class BaseTestCase extends TestCase
{
  protected ResponseInterface $response;

  private App $app;

  protected function setUp(): void
  {
    parent::setUp();

    $this->app = require __DIR__ . '/../config/app.php';
  }

  /**
   * @param string $method
   * @param string $uri
   * @param array<string> $queryParams
   *
   * @return self
   */
  protected function request(string $method, string $uri, array $queryParams = []): self
  {
    $request = $this->makeRequest($method, $uri, $queryParams);

    $this->response = $this->app->run($request, false);

    return $this;
  }

  protected function assertResponseContains(string $pattern, string $message = ''): self
  {
    $this->assertMatchesRegularExpression($pattern, $this->response->getBody(), $message);

    return $this;
  }

  protected function assertResponseStatusCode(int $statusCode, string $message = ''): self
  {
    $this->assertSame($statusCode, $this->response->getStatusCode(), $message);

    return $this;
  }

  /**
   * @param string $method
   * @param string $uri
   * @param array<string> $queryParams
   *
   * @return \Psr\Http\Message\ServerRequestInterface
   */
  private function makeRequest(string $method, string $uri, array $queryParams = []): ServerRequestInterface
  {
    $server = [
      'REQUEST_URI' => $uri,
      'REQUEST_METHOD' => $method,
    ];

    return ServerRequestFactory::fromGlobals($server, $queryParams, null, null, null);
  }
}
