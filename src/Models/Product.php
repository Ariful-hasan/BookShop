<?php

namespace src\Models;

use Src\Models\BaseModel;

class Product extends BaseModel
{
    public function  __construct()
    {
        parent::__construct();
    }
    
    /**
     * get product filter by product name and return result array.
     *
     * @param  string $name
     * @return array
     */
    public function getProductByName(string $name): array
    {
       try {
            $response = [];
            $sql = "SELECT * FROM products WHERE name = ?";
        
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $name);
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
     * add new product and return newly inserted id.
     *
     * @param  string $name
     * @return int
     */
    public function addProduct(string $name): int
    {
        try {
            $query = "INSERT INTO products (name) VALUES (?)";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("s", $name);
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