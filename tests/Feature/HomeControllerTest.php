<?php

namespace Tests\Feature;

use Tests\BaseTestCase;

final class HomeControllerTest extends BaseTestCase
{
  public function testShowHome(): void
  {
    $this->request('GET', '/')
      ->assertResponseStatusCode(200)
      ->assertResponseContains('/Home/');
  }

  public function testShowHello(): void
  {
    $this->request('GET', '/hello-world')
      ->assertResponseStatusCode(200)
      ->assertResponseContains('/Hello, Undefined/');
  }

  public function testShowHelloWithName(): void
  {
    $this->request('GET', '/hello-world', [
      'name' => 'Foo'
    ])->assertResponseContains('/Hello, Foo/');
  }
}
