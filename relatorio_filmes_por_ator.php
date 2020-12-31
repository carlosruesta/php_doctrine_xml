<?php

use Alura\Doctrine\Entity\Ator;
use Alura\Doctrine\Entity\Filme;
use Alura\Doctrine\Helper\EntityManagerCreator;
use Alura\Doctrine\Repository\AtorRepository;
use Doctrine\DBAL\Logging\DebugStack;

require_once 'vendor/autoload.php';

$em = (new EntityManagerCreator())->criaEntityManager();

$debugStack = new DebugStack();
$em->getConfiguration()->setSQLLogger($debugStack);

/** @var AtorRepository $atorRepository **/
$atorRepository = $em->getRepository(Ator::class);
$result = $atorRepository->numeroFilmesPorAtor();

foreach ($result as $ator) {
    echo "{$ator['primeiroNome']} {$ator['ultimoNome']} tem {$ator['numeroFilmes']} filmes" . PHP_EOL;
}

$result2 = $atorRepository->numeroFilmesPorAtor3();
foreach ($result2 as $ator) {
    echo "{$ator['nome']} tem {$ator['qtdFilmes']} filmes" . PHP_EOL;
}


$result3 = $atorRepository->buscaTodosAtores();
/** @var Ator $ator **/
foreach ($result3 as $ator) {
    echo "{$ator->getNome()}" . PHP_EOL;
}

$result3 = $atorRepository->numeroFilmesPorAtorUsandoView();
foreach ($result2 as $ator) {
    echo "{$ator['nome']} tem {$ator['qtdFilmes']} filmes" . PHP_EOL;
}

echo "\n";
foreach ($debugStack->queries as $queryInfo) {
    echo $queryInfo['sql'] . "\n";
}