<?php

namespace Src\Services;

use Src\Repositories\SaleRepository;

class SalesService
{    
    /**
     * list with conditions and total calculation.
     *
     * @param  mixed $conditions
     * @return array
     */
    public function list(array $conditions = []): array
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