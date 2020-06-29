<?php

namespace App\DTO;

use Psr\Http\Message\ServerRequestInterface;
use Spatie\DataTransferObject\DataTransferObject;

class HelloData extends DataTransferObject
{
  public string $name;

  public static function fromRequest(ServerRequestInterface $request): self
  {
    $queryParams = $request->getQueryParams();

    return new self([
      'name' => $queryParams['name'] ?? 'Undefined',
    ]);
  }
}
