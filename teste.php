<?php

use Alura\Doctrine\Entity\Ator;
use Alura\Doctrine\Entity\Filme;
use Alura\Doctrine\Entity\Idioma;

require_once 'vendor/autoload.php';

$em = (new \Alura\Doctrine\Helper\EntityManagerCreator())->criaEntityManager();
$ator = new Ator(null, 'Vinicius', 'Dias');

$portugues = new Idioma(null, 'Português');
$alemao = new Idioma(null, 'Alemão');
$ingles = new Idioma(null, 'Inglês');

$filme1 = new Filme(null, 'A volta dos que não foram', $portugues, $alemao, '2019');
$filme2 = new Filme(null, 'As longas tranças do careca', $portugues, $ingles, '2018');

$ator->addFilme($filme1);
$ator->addFilme($filme2);

$em->persist($ator);
$em->flush();