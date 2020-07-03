<?php

namespace App\Commands;

use Illuminate\Database\Capsule\Manager;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSchemaCommand
{
  private Manager $manager;

  public function __construct(Manager $manager)
  {
    $this->manager = $manager;
  }

  public function __invoke(?bool $force, OutputInterface $output): void
  {
    $schemaBuilder = $this->manager->getConnection()->getSchemaBuilder();

    if ($force) {
      $schemaBuilder->dropIfExists('users');
    }

    $schemaBuilder->create('users', function ($table) {
      $table->increments('id');
      $table->string('email')->unique();
      $table->timestamps();
    });

    $output->writeln('Schema created!');
  }
}
