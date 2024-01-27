<?php

namespace Src\Services;

use Src\Repositories\SaleRepository;

class SalesService
{
    public function list(array $conditions = [])
    {
        try {
            $lists = SaleRepository::list($conditions);
            $sum = 0;
            
            if (!empty($lists)) {
                $sum = array_reduce($lists, function ($sum, $item) {
                    return $sum + $item['price'];
                }, 0);
            }
            
            return ['data' => $lists, 'total' => $sum];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}