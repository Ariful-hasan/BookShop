<?php

namespace Src\Models;

class Customer extends BaseModel
{
    public function  __construct()
    {
        parent::__construct();
    }

    public function getCustomerByEmail(string $email)
    {
        $response = [];
        $sql = "SELECT * FROM customers WHERE email = ?";
       
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $response [] = $row;
        }

        $stmt->close();
        
        return $response;
    }

    public function customerInsert(string $name, string $email): int
    {
        try {
            $query = "INSERT INTO customers (name, email) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ss", $name, $email);
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