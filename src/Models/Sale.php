<?php

namespace Src\Models;

class Sale extends BaseModel
{
    public function  __construct()
    {
        parent::__construct();
    }

    public function getSaleDetails(int $productId, int $customerId, string $saleDate)
    {
        $response = [];
        $sql = "SELECT * FROM sales WHERE product_id = ? AND customer_id = ? AND sale_date = ?";
       
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iis", $productId, $customerId, $saleDate);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $response [] = $row;
        }

        $stmt->close();
        
        return $response;
    }

    public function addSale(int $productId, int $customerId, int $priceId, string $salesDate, string $timeZone = ''): int
    {
        try {
            $query = "INSERT INTO sales (product_id, customer_id, price_id, sale_date, time_zone) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iiiss", $productId, $customerId, $priceId, $salesDate, $timeZone);
                $stmt->execute();

                $insertedId = $this->db->insert_id;
                
                $stmt->close();

                return $insertedId;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getSalesList(array $bindParam = [], array $bindValues = [], string $bindType = '')
    {
        try {
            $query = "SELECT sales.*, customers.`name` as customer, products.`name` as product, prices.price FROM sales ";
            $query .= "LEFT JOIN prices ON prices.id = sales.price_id ";
            $query .= "LEFT JOIN customers ON customers.id = sales.customer_id ";
            $query .= "LEFT JOIN products ON products.id = sales.product_id ";
            $condQuery = '';

            if (!empty($bindParam)) {
                $condQuery .= "WHERE ";
    
                foreach ($bindParam as $key) {
                    $condQuery .= $key . " AND ";
                }
    
                $condQuery = rtrim($condQuery);
                $condQuery = substr($condQuery, 0, strrpos($condQuery, " ")); 
            }

            $query .= $condQuery;
            $response = [];
            $stmt = $this->db->prepare($query);
            
            if ($stmt) {
                
                if (!empty($bindParam)) {
                    $stmt->bind_param($bindType, ...$bindValues);
                }
                $stmt->execute();
                $result = $stmt->get_result();
        
                while ($row = $result->fetch_assoc()) {
                    $response [] = $row;
                }
                
                $stmt->close();
            }

            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}