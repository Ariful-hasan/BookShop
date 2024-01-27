<?php

namespace Src\Repositories;

use Src\Models\Price;

class PriceRepository
{
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