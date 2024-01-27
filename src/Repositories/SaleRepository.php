<?php

namespace Src\Repositories;

use Src\Models\Sale;
use Src\Utils\DateComparator;

class SaleRepository
{
    public static function saveSale(array $data, int $productId, int $customerId, int $priceId, string $saleDate): int
    {
        $sale = new Sale();
        $saleDetail = $sale->getSaleDetails($productId, $customerId, $saleDate);
        $saleId = isset($saleDetail[0]['id']) ? $saleDetail[0]['id'] : 0;
        
        if (!$saleId) {
            $saleId = $sale->addSale($productId, $customerId, $priceId, $saleDate, DateComparator::compare($data['version']));
        }

        return $saleId;
    }

    public static function list(array $conditions = [])
    {
        $bindParam = [];
        $bindValues = [];
        $bindType = '';

        if (!empty($conditions)) {
            foreach ($conditions as $key => $value) {
                switch ($key) {
                    case "customer_id":
                        $bindParam[] = 'customers.name like ?';
                        $bindType .= 's';
                        $bindValues[] = "%".$value."%";
                        break;
                    case "product_id":
                        $bindParam[] = 'products.name like ?';
                        $bindType .= 's';
                        $bindValues[] = "%".$value."%";
                        break;
                    case "price":
                        $bindParam[] = 'prices.price <= ?';
                        $bindType .= 'd';
                        $bindValues[] = $value;
                        break;
                }
            }
        }

        $sale = new Sale();
        return $sale->getSalesList($bindParam, $bindValues, $bindType);
    }
}