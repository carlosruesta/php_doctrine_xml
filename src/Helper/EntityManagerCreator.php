<?php

namespace Alura\Doctrine\Helper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerCreator
{
    public function criaEntityManager(): EntityManagerInterface
    {
        $config = Setup::createXMLMetadataConfiguration(
            [__DIR__."/../../mapeamentos"]);
//        $config = Setup::createAnnotationMetadataConfiguration(
//            [__DIR__ . '/../Entity']
//        );

        $con = [
            'driver'    => 'pdo_pgsql',
            'host'      => 'localhost',
            'dbname'    => 'alura_filmes_novo',
            'user'      => 'postgres',
            'password'  => '123456'
        ];

        $em = EntityManager::create($con, $config);
        return $em;
    }
}