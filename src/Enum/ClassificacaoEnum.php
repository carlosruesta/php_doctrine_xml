<?php

namespace Alura\Doctrine\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static ClassificacaoEnum LIVRE()
 * @method static ClassificacaoEnum ACIMA_10_ANOS()
 * @method static ClassificacaoEnum ACIMA_13_ANOS()
 * @method static ClassificacaoEnum ACIMA_16_ANOS()
 * @method static ClassificacaoEnum ACIMA_18_ANOS()
 */
class ClassificacaoEnum extends Enum
{
    private const LIVRE = 'G';
    private const ACIMA_10_ANOS = 'PG';
    private const ACIMA_13_ANOS = 'PG-13';
    private const ACIMA_16_ANOS = 'R';
    private const ACIMA_18_ANOS = 'NC-17';
}