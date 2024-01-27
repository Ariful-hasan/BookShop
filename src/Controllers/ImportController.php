<?php

namespace Src\Controllers;

use Src\Services\ImportService;

class ImportController
{
    function __invoke(): void
    {
        try {
            ImportService::import('import/product.json');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}