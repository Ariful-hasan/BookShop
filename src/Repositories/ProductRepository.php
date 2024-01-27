<?php

namespace Src\Repositories;

use Src\Models\Product;

class ProductRepository
{
    public static function saveProduct(array $data): int
    {
        $product = new Product();
        $productDetail =  $product->getProductByName((string) $data['product_name']);
        $productId = isset($productDetail[0]['id']) ? $productDetail[0]['id'] : 0;

        if (!$productId) {
            $productId =  $product->productInsert((string) $data['product_name']);
        }

        return $productId;
    }
}