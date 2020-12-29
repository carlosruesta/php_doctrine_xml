<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Filme
{
    private $id;
    private $titulo;
    private $idiomaAudio;
    private $idiomaOriginal;
    private $sinopse = null;
    private $classificacao;
    private $anoLancamento = null;
    private $ultimaAtualizacao;
    private $atores;

    public function __construct(
        ?int $id,
        string $titulo,
        Idioma $idiomaAudio,
        Idioma $idiomaOriginal,
        ?string $anoLancamento = null,
        ?string $sinopse = null,
        string $classificacao = null
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->sinopse = $sinopse;
        $this->idiomaAudio = $idiomaAudio;
        $this->idiomaOriginal = $idiomaOriginal;
        $this->anoLancamento = $anoLancamento;
        $this->ultimaAtualizacao = new \DateTimeImmutable();
        $this->atores = new ArrayCollection();
        $this->classificacao = $classificacao;
    }

    public function addAtor(Ator $ator): void
    {
        if ($this->atores->contains($ator)) {
            return;
        }

        $this->atores->add($ator);
        $ator->addFilme($this);
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getIdiomaAudio(): Idioma
    {
        return $this->idiomaAudio;
    }

    public function getAtores(): array
    {
        return $this->atores->map(function (Ator $ator) {
            return $ator->getNome();
        })->toArray();
    }
}
