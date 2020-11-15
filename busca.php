<?php
use Alura\Doctrine\Entity\Filme;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once 'vendor/autoload.php';

$em = (new EntityManagerCreator())->criaEntityManager();

/** @var Filme[] $filmes */
$filmes = $em->getRepository(Filme::class)->findAll();

foreach ($filmes as $filme) {
    echo $filme->getTitulo() . PHP_EOL . 'Idioma: ' . $filme->getIdiomaAudio();
    echo PHP_EOL;
    echo PHP_EOL;
    echo implode(', ', $filme->getAtores());
    echo PHP_EOL;
    echo PHP_EOL;
}
