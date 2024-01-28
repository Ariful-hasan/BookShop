<?php

namespace Src\Repositories;

use Src\Models\Customer;

class CustomerRepository
{    
    /**
     * add new customer and return inserted/existed id.
     *
     * @param  array $data
     * @return int
     */
    public static function saveCustomer(array $data): int
    {
        $customer = new Customer();
        $customerDetail = $customer->getCustomerByEmail((string) $data['customer_mail']);
        $customerId = isset($customerDetail[0]['id']) ? $customerDetail[0]['id'] : 0;

        if (!$customerId) {
            $customerId = $customer->addCustomer((string) $data['customer_name'], (string) $data['customer_mail']);
        }

        return $customerId;
    }
}