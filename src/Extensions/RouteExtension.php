<?php

namespace App\Extensions;

use Closure;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use League\Route\Router;

class RouteExtension implements ExtensionInterface
{
  private Router $router;

  public function __construct(Router $router)
  {
    $this->router = $router;
  }

  public function register(Engine $engine): void
  {
    $engine->registerFunction('route', Closure::fromCallable([$this, 'route']));
  }

  /**
   * @param string $routeName
   * @param array<string> $routeArgs
   * @param array<string> $queryParams
   *
   * @return string
   */
  public function route(string $routeName, array $routeArgs = [], array $queryParams = []): string
  {
    $url = $this->router->getNamedRoute($routeName)->getPath();

    $url = $this->applyRouteArgs($url, $routeArgs);
    $url = $this->applyQueryParams($url, $queryParams);

    return $url;
  }

  /**
   * @param string $url
   * @param array<string,mixed> $routeArgs
   *
   * @return string
   */
  private function applyRouteArgs(string $url, array $routeArgs = []): string
  {
    return \array_reduce(\array_keys($routeArgs), function ($url, $arg) use ($routeArgs) {
      $value = $routeArgs[$arg];
      return \preg_replace("/{{$arg}.*}/", $value, $url);
    }, $url);
  }

  /**
   * @param string $url
   * @param array<string> $queryParams
   *
   * @return string
   */
  private function applyQueryParams(string $url, array $queryParams = []): string
  {
    if (empty($queryParams)) {
      return $url;
    }

    return $url . '?'. \http_build_query($queryParams);
  }
}
