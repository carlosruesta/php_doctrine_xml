<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Ator
{
    private $id;
    private $primeiroNome;
    private $ultimoNome;
    private $ultimaAtualizacao;
    private $filmes;

    public function __construct(
        ?int $id,
        string $primeiroNome,
        string $ultimoNome
    ) {
        $this->id = $id;
        $this->primeiroNome = $primeiroNome;
        $this->ultimoNome = $ultimoNome;
        $this->ultimaAtualizacao = new \DateTimeImmutable();
        $this->filmes = new ArrayCollection();
    }

    public function addFilme(Filme $filme): void
    {
        if ($this->filmes->contains($filme)) {
            return;
        }

        $this->filmes->add($filme);
        $filme->addAtor($this);
    }

    public function getNome()
    {
        return $this->primeiroNome . " " . $this->ultimoNome;
    }
}