<?php

namespace App\Http\Controllers\Api;

use App\Testtakers\ArrayConverter;
use App\Testtakers\Storage;
use Illuminate\Routing\Controller as BaseController;

class TestTakersController extends BaseController
{
    public function list($source, $filename, $extension)
    {
        $data = (new Storage())->load($source);

        return (new ArrayConverter($data))->{$extension}();
    }
}
