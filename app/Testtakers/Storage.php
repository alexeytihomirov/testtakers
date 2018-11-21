<?php

namespace App\Testtakers;

use App\Testtakers\Exceptions\StorageNotFoundException;
use App\Testtakers\Parsers\CsvParser;
use App\Testtakers\Parsers\JsonParser;

class Storage
{
    protected $paths;
    protected $parsers;

    public function __construct()
    {
        $this->paths = config('testtakers.paths');

        // Later we can register parsers using container and interface
        $this->parsers = [
            'csv' => new CsvParser(),
            'json' => new JsonParser(),
        ];
    }

    public function load($source)
    {
        if (!array_key_exists($source, $this->paths)) {
            throw new StorageNotFoundException(sprintf('Invalid source path "%s"', $source));
        }

        $extension = pathinfo($source, PATHINFO_EXTENSION);

        if (!array_key_exists($extension, $this->parsers)) {
            throw new StorageNotFoundException(sprintf('No "%s" parser found', $extension));
        }

        return $this->parsers[$extension]->parse($this->paths[$source]);
    }
}