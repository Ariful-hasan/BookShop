<?php

namespace Src\Models;

use DateTime;

class Price extends BaseModel
{
    public function  __construct()
    {
        parent::__construct();
    }

    public function getPrice(int $productId, string $validTo)
    {
        $response = [];
        $sql = "SELECT * FROM prices WHERE product_id = ? AND valid_to = ?";
       
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $productId, $validTo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $response [] = $row;
        }

        $stmt->close();
        
        return $response;
    }

    public function addPrice(int $productId, float $price, string $validTo): int
    {
        try {
            $query = "INSERT INTO prices (product_id, price, valid_to) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ids", $productId, $price, $validTo);
                $stmt->execute();

                $insertedId = $this->db->insert_id;
                
                $stmt->close();

                return $insertedId;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}