<?php

namespace Src\Repositories;

use Src\Models\Product;

class ProductRepository
{    
    /**
     * add new product and return inserted/existed id.
     *
     * @param  array $data
     * @return int
     */
    public static function saveProduct(array $data): int
    {
        $product = new Product();
        $productDetail =  $product->getProductByName((string) $data['product_name']);
        $productId = isset($productDetail[0]['id']) ? $productDetail[0]['id'] : 0;

        if (!$productId) {
            $productId =  $product->addProduct((string) $data['product_name']);
        }

        return $productId;
    }
}