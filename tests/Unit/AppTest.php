<?php


namespace Tests;

use Laminas\Diactoros\ServerRequestFactory;
use PHPUnit\Framework\TestCase;

final class App extends TestCase
{
  public function testNotFoundHandler(): void
  {
    $app = require __DIR__ . '/../../config/app.php';

    $request = ServerRequestFactory::fromGlobals([
      'REQUEST_URI' => 'not-found',
      'REQUEST_METHOD' => 'GET'
    ], [], null, null, null);

    $response = $app->run($request, false);

    $this->assertSame(404, $response->getStatusCode());
  }
}
