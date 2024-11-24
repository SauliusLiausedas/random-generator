<?php

namespace App\Generators;

interface GeneratorInterface
{
    /**
     * @return string | string[]
     */
    public function generate(): mixed;
}
