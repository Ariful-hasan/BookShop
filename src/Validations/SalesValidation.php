<?php

namespace Src\Validations;

use Exception;

class SalesValidation
{
    public static function validate() : array
    {
        if (!empty($_REQUEST['price']) && !is_numeric($_REQUEST['price'])) {
            throw new Exception('Invalid Price!');
        }

        $data = [];
        $data['customer_id'] = isset($_REQUEST['customer']) ? $_REQUEST['customer'] : null;
        $data['product_id'] = isset($_REQUEST['product']) ? $_REQUEST['product'] : null;
        $data['price'] = $_REQUEST['price'];
        
        return array_filter($data);
    }
}