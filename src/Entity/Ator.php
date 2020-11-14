<?php

namespace Alura\Doctrine\Entity;

/**
 * @Entity
 * @Table(name="ator")
 */
class Ator
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(name="id_ator", type="integer")
     */
    private $id;

    /**
     * @Column(name="primeiro_nome", type="string")
     */
    private $primeiroNome;

    /**
     * @Column(name="ultimo_nome", type="string")
     */
    private $ultimoNome;

    /**
     * @Column(name="data_atualizado", type="datetime")
     */
    private $ultimaAtualizacao;
}