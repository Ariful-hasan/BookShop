<?php

namespace Src\Repositories;

use Src\Models\Price;

class PriceRepository
{    
    /**
     * add new price and return inserted/existed id.
     * 
     * @param  array $data
     * @param  int $productId
     * @param  string $saleDate
     * @return int
     */
    public static function savePrice(array $data, int $productId, string $saleDate): int
    {
        $price = new Price();
        $priceDetail = $price->getPrice($productId, $saleDate);
        $priceId = isset($priceDetail[0]['id']) ? $priceDetail[0]['id'] : 0;

        if (!$priceId) {
            $priceId = $price->addPrice($productId, (float) $data['product_price'], $saleDate);
        }

        return $priceId;
    }
}