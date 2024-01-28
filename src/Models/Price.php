<?php

namespace Src\Models;

class Price extends BaseModel
{
    public function  __construct()
    {
        parent::__construct();
    }
    
    /**
     * get all price records filter with product and valid date
     * and return result array.
     *
     * @param  int $productId
     * @param  string $validTo
     * @return array
     */
    public function getPrice(int $productId, string $validTo): array
    {
        try {
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
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    /**
     * add new Price and return newly inserted id.
     *
     * @param  int $productId
     * @param  float $price
     * @param  string $validTo
     * @return int
     */
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