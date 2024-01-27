<?php

namespace Src\Repositories;

use Src\Models\Customer;

class CustomerRepository
{
    public static function saveCustomer(array $data): int
    {
        $customer = new Customer();
        $customerDetail = $customer->getCustomerByEmail((string) $data['customer_mail']);
        $customerId = isset($customerDetail[0]['id']) ? $customerDetail[0]['id'] : 0;

        if (!$customerId) {
            $customerId = $customer->customerInsert((string) $data['customer_name'], (string) $data['customer_mail']);
        }

        return $customerId;
    }
}