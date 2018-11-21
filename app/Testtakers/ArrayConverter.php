<?php

namespace App\Testtakers;

use App\Testtakers\Exceptions\ConverterException;
use Spatie\ArrayToXml\ArrayToXml;

class ArrayConverter
{
    protected $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function json()
    {
        return json_encode($this->array, JSON_PRETTY_PRINT);
    }

    public function xml($rootElementName = 'testtakers', $rowName = 'person')
    {
        return ArrayToXml::convert([$rowName => $this->array], $rootElementName);
    }

    public function __call($name, $arguments)
    {
        throw new ConverterException(sprintf('Unsupported format "%s"', $name));
    }
}