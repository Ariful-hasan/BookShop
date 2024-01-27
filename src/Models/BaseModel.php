<?php

namespace Src\Models;

use mysqli;
use Src\Utils\Database;

abstract class BaseModel
{
    public mysqli $db;

    public function __construct() 
    {
       $this->db = Database::dbConnect();
    }

    public function select(string $query): array
    {
        $response = [];
        $result = mysqli_query($this->db, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
    
            $result->free();
        }

        return $response;
    }

    public function dbInsert(string $query): array
    {
        $response = [];
        $result = mysqli_query($this->db, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
    
            $result->free();
        }

        return $response;
    }
}