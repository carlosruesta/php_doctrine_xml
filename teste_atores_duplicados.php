<?php

use Alura\Doctrine\Entity\Ator;
use Alura\Doctrine\Entity\Filme;
use Alura\Doctrine\Entity\Idioma;

require_once 'vendor/autoload.php';

$em = (new \Alura\Doctrine\Helper\EntityManagerCreator())->criaEntityManager();
$ator1 = new Ator(null, 'Vinicius', 'Dias');
$ator2 = new Ator(null, 'Vinicius', 'Dias');

try {
    $em->persist($ator1);
    $em->persist($ator2);
    $em->flush();
    echo "Atores gravados com sucesso";
} catch (\Exception $e) {
    echo "Aconteceu um erro ao gravar atores: {$e->getMessage()}";
}
