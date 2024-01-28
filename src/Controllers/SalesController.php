<?php

namespace Src\Controllers;

use Src\Services\SalesService;
use Src\Validations\SalesValidation;

class SalesController
{
    protected $service;

    public function __construct()
    {
        $this->service = new SalesService();
    }
    
    /**
     * get sales records.
     *
     * @return void
     */
    public function index()
    {
        try {
            $data = $this->service->list(SalesValidation::validate());
        } catch (\Exception $e) {
            $data['error'] = $e->getMessage();
        }

        require('./views/sales/list.php');
    }
}