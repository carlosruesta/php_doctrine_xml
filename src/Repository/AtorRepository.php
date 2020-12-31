<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Ator;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class AtorRepository extends EntityRepository
{
    public function numeroFilmesPorAtor()
    {
        $entityManager = $this->getEntityManager();
        $classeAtor = Ator::class;
        $dql = "SELECT ator.id, ator.primeiroNome, ator.ultimoNome, count(filmes) numeroFilmes
                FROM $classeAtor ator JOIN ator.filmes filmes
                GROUP BY ator.id, ator.primeiroNome, ator.ultimoNome";
        $query = $entityManager->createQuery($dql)->setMaxResults(1);

        return $query->getResult();
    }

    public function numeroFilmesPorAtor2()
    {
        return $this->createQueryBuilder('a')
            ->join('a.filmes', 'f')
            ->addSelect('f')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

    public function numeroFilmesPorAtor3()
    {
        $sql = "SELECT CONCAT(ator.primeiro_nome, ' ', ator.ultimo_nome) AS nome, count(filme.id_filme) qtd_filmes
                FROM ator 
                    JOIN ator_filme ON ator_filme.id_ator = ator.id_ator
                    JOIN filme ON filme.id_filme = ator_filme.id_filme
                GROUP BY ator.id_ator
                LIMIT 2";
        $rsm = new ResultSetMapping(); // resultSetMapping poderia apontar para uma entidade
        $rsm->addScalarResult('nome', 'nome');
        $rsm->addScalarResult('qtd_filmes', 'qtdFilmes');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

    public function buscaTodosAtores()
    {
        $sql = "SELECT id_ator, primeiro_nome, ultimo_nome FROM ator";
        $rsm = new ResultSetMapping(); // resultSetMapping poderia apontar para uma entidade
        $rsm->addEntityResult(Ator::class, 'ator');
        $rsm->addFieldResult('ator', 'id_ator', 'id');
        $rsm->addFieldResult('ator', 'primeiro_nome', 'primeiroNome');
        $rsm->addFieldResult('ator', 'ultimo_nome', 'ultimoNome');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }

    public function numeroFilmesPorAtorUsandoView()
    {
        $sql = "select * from atores_mais_atuantes";
        $rsm = new ResultSetMapping(); // resultSetMapping poderia apontar para uma entidade
        $rsm->addScalarResult('nome', 'nome');
        $rsm->addScalarResult('qtd_filmes', 'qtdFilmes');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }
}