<?php

namespace App\Testtakers\Parsers;


interface ParserInterface
{
    public function parse($path): ?array;
}