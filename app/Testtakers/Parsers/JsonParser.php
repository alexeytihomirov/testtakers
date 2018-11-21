<?php

namespace App\Testtakers\Parsers;


class JsonParser implements ParserInterface
{
    public function parse($path): ?array
    {
        return json_decode(file_get_contents($path), true);
    }
}