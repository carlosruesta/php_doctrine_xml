<?php

use Alura\Doctrine\Helper\EntityManagerCreator;
use Doctrine\ORM\Query\ResultSetMapping;

require_once 'vendor/autoload.php';

$em = (new EntityManagerCreator())->criaEntityManager();

$rsm = new ResultSetMapping();
$rsm->addScalarResult('total_atores_por_categoria', 'total');
$total = $em->createNativeQuery('select total_atores_por_categoria(?)', $rsm)
    ->setParameter(1, 1)
    ->getSingleScalarResult();

echo $total;