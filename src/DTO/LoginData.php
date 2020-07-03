<?php

namespace App\DTO;

use Psr\Http\Message\ServerRequestInterface;
use Spatie\DataTransferObject\DataTransferObject;

class LoginData extends DataTransferObject
{
  public string $email;

  public string $password;

  public bool $remember;

  public static function fromRequest(ServerRequestInterface $request): self
  {
    $data = $request->getParsedBody();

    return new self([
      'email' => $data['email'],
      'password' => $data['password'],
      'remember' => isset($data['remember']),
    ]);
  }
}
