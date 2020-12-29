<?php


namespace Alura\Doctrine\Types;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\MappingException;

class TipoClassificacao extends Type
{

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return "CLASSIFICACAO";
    }

    public function getName()
    {
        return "classificacao";
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, ['G', 'PG', 'PG-13', 'R', 'NC-17'])) {
            throw new MappingException("Classificacao inválida");
        }
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }
}