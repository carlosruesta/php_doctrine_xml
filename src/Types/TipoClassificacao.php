<?php


namespace Alura\Doctrine\Types;


use Alura\Doctrine\Enum\ClassificacaoEnum;
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
        if (!$value instanceof ClassificacaoEnum) {
            throw new \DomainException("Classificação inválida");
        }
        return $value->getValue();
//        if (!in_array($value, ['G', 'PG', 'PG-13', 'R', 'NC-17'])) {
//            throw new MappingException("Classificacao inválida");
//        }
//        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        switch ($value) {
            case 'G'        : return ClassificacaoEnum::LIVRE();
            case 'PG'       : return ClassificacaoEnum::ACIMA_10_ANOS();
            case 'PG-13'    : return ClassificacaoEnum::ACIMA_13_ANOS();
            case 'R'        : return ClassificacaoEnum::ACIMA_16_ANOS();
            case 'NC-17'    : return ClassificacaoEnum::ACIMA_18_ANOS();
        }
    }
}