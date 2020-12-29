<?php

use Alura\Doctrine\Entity\Filme;
use Alura\Doctrine\Entity\Idioma;

require_once 'vendor/autoload.php';

try {
    $em = (new \Alura\Doctrine\Helper\EntityManagerCreator())->criaEntityManager();

    $portugues = new Idioma(null, 'Português');
    $alemao = new Idioma(null, 'Alemão');

    $filme1 = new Filme(null, 'A volta dos que não foram', $portugues, $alemao, '2019', null, 'qG');


    $em->persist($filme1);
    $em->flush();

    echo "Filme gravado com sucesso";
} catch (\Exception $e) {
    echo "Aconteceu algum erro ao gravar o filme: {$e->getMessage()}";
}