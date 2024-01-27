<?php

namespace src\Models;

use Src\Database;
use Src\Models\BaseModel;

class Product extends BaseModel
{
    // private $db;
    private int $id;
    private string $name;
    private float $price;


    public function  __construct()
    {
        parent::__construct();
        // $this->db = Database::dbConnect();
    }

    // public function getProductName() : string
    // {
    //     return $this->name;
    // }

    // public function setProductName(string $name)
    // {
    //     $this->name = $name;

    //     return $this;
    // }

    // public function getPrice() : float
    // {
    //     return $this->price;
    // }

    // public function setPrice(float $price)
    // {
    //     $this->price = $price;

    //     return $this;
    // }

    // public function getId() : int
    // {
    //     return $this->id;
    // }

    // public function setId(int $id)
    // {
    //     $this->id = $id;

    //     return $this;
    // }

    public function getProductByName(string $name)
    {
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
    }

    public function productInsert(string $name): int
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

    //Get All Jobs
    // public function getAllJobs(){
    //     $this->db->query("SELECT jobs.*, categories.name AS cname 
    //                      FROM jobs INNER JOIN categories 
    //                      ON jobs.category_id = categories.id
    //                      ORDER BY post_date DESC
    //                      ");
    //     //Assign Result Set
    //     $results = $this->db->resultSet();

    //     return $results;
    // }

    // //Get Categories
    // public function getCategories(){
    //     $this->db->query("SELECT * FROM categories");
    //     //Assign Result Set
    //     $results = $this->db->resultSet();

    //     return $results;
    // }

    // //Get Job By Category
    // public function getByCategory($category){
    //     $this->db->query("SELECT jobs.*, categories.name AS cname 
    //                      FROM jobs INNER JOIN categories 
    //                      ON jobs.category_id = categories.id
    //                      WHERE jobs.category_id = $category
    //                      ORDER BY post_date DESC
    //                      ");
    //     //Assign Result Set
    //     $results = $this->db->resultSet();

    //     return $results;
    // }

    // //Get Category
    // public function getCategory($category_id){
    //     $this->db->query("SELECT * FROM categories WHERE id = :category_id");
    //     $this->db->bind(':category_id', $category_id);

    //     //Assign Row
    //     $row = $this->db->single();

    //     return $row;
    // }

    // //Get job
    // public function getJob($id){
    //     $this->db->query("SELECT * FROM jobs WHERE id = :id");
    //     $this->db->bind(':id', $id);

    //     //Assign Row
    //     $row = $this->db->single();

    //     return $row;
    // }

    // //Create Job
    // public function create($data){
    //     $this->db->query("INSERT INTO jobs (category_id, job_title, company, description, location, salary, contact_user, contact_email)
    //                             VALUES (:category_id, :job_title, :company, :description, :location, :salary, :contact_user, :contact_email)");

    //     //Bind Data
    //     $this->db->bind(':category_id', $data['category_id']);
    //     $this->db->bind(':job_title', $data['job_title']);
    //     $this->db->bind(':company', $data['company']);
    //     $this->db->bind(':description', $data['description']);
    //     $this->db->bind(':location', $data['location']);
    //     $this->db->bind(':salary', $data['salary']);
    //     $this->db->bind(':contact_user', $data['contact_user']);
    //     $this->db->bind(':contact_email', $data['contact_email']);
    //     //EXECUTE
    //     if ($this->db->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    // //Delete Job
    // public function delete($id){
    //     $this->db->query("DELETE FROM jobs WHERE id = $id");

    //     //EXECUTE
    //     if ($this->db->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    // //Update Job
    // public function update($id, $data){
    //     $this->db->query("UPDATE jobs SET
    //                             category_id = :category_id, 
    //                             job_title = :job_title, 
    //                             company = :company,
    //                             description = :description,
    //                             location = :location,                          
    //                             salary = :salary,
    //                             contact_user = :contact_user,
    //                             contact_email = :contact_email
    //                             WHERE id = $id");
    //     //Bind Data
    //     $this->db->bind(':category_id', $data['category_id']);
    //     $this->db->bind(':job_title', $data['job_title']);
    //     $this->db->bind(':company', $data['company']);
    //     $this->db->bind(':description', $data['description']);
    //     $this->db->bind(':location', $data['location']);
    //     $this->db->bind(':salary', $data['salary']);
    //     $this->db->bind(':contact_user', $data['contact_user']);
    //     $this->db->bind(':contact_email', $data['contact_email']);
    //     //EXECUTE
    //     if ($this->db->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
}