<?php

use Alura\Doctrine\Entity\Ator;
use Alura\Doctrine\Entity\Filme;
use Alura\Doctrine\Entity\Idioma;
use Alura\Doctrine\Enum\ClassificacaoEnum;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once 'vendor/autoload.php';

$em = (new EntityManagerCreator())->criaEntityManager();
$ator = new Ator(null, 'Vinicius', 'Dias');
$atriz = new Ator(null, 'Maria', 'Da Silva');

$portugues = new Idioma(null, 'Português');
$alemao = new Idioma(null, 'Alemão');
$ingles = new Idioma(null, 'Inglês');

$filme1 = new Filme(null, 'A volta dos que não foram', $portugues, $alemao, '2019', null, ClassificacaoEnum::LIVRE());
$filme2 = new Filme(null, 'As longas tranças do careca', $portugues, $ingles, '2018', null, ClassificacaoEnum::ACIMA_13_ANOS());

$ator->addFilme($filme1);
$ator->addFilme($filme2);

$atriz->addFilme($filme2);

$em->persist($ator);
$em->persist($atriz);
$em->flush();