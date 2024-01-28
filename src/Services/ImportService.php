<?php

namespace Src\Services;

use DateTime;
use Src\Repositories\CustomerRepository;
use Src\Repositories\PriceRepository;
use Src\Repositories\ProductRepository;
use Src\Repositories\SaleRepository;

class ImportService
{    
    /**
     * import sales records.
     *
     * @param  string $filePath
     * @return void
     */
    public static function import(string $filePath): void
    {
        if (empty($filePath) || !file_exists($filePath)) {
            return;
        }

        $fileData = json_decode(file_get_contents($filePath), true);

        if (count($fileData) < 1) {
            return;
        }

        foreach ($fileData as $data) {
            $saleDateObj = new DateTime($data['sale_date']);
            $saleDate = $saleDateObj->format('Y-m-d');
            $productId = ProductRepository::saveProduct($data);
            $customerId = CustomerRepository::saveCustomer($data);
            $priceId = PriceRepository::savePrice($data, $productId, (string) $saleDate);
            SaleRepository::saveSale($data, $productId, $customerId, $priceId, (string) $saleDate);
        }
    }
}