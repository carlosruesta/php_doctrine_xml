<?php

use Alura\Doctrine\Helper\EntityManagerCreator;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'vendor/autoload.php';

$entityManager = (new EntityManagerCreator())->criaEntityManager();

return ConsoleRunner::createHelperSet($entityManager);