<?php

    class Product {

        private $conn;
        private $table = 'products';

        //product properties
        public $id;
        public $name;
        public $price;
        public $createdAt;

        //constructor
        public function __construct($db) {
            $this->conn = $db;
        }





        //get all products in DB
        public function read() {

            //create query
            //$query = 'SELECT * FROM products ORDER BY created_at DESC';
            $query = "SELECT * FROM $this->table ORDER BY created_at DESC";
            
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            
            $result = $stmt->get_result();
            
            //fetch resulting as array
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

            return $products;         
        
        }





        //get single product by id
        public function read_single() {
            
            //create query and prepare
            $query = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param('i', $id);

            //set parameter and execute
            $id = $this->id;
            $stmt->execute();

            //get result
            $result = $stmt->get_result();

            //fetch resulting as array
            $product = mysqli_fetch_assoc($result);

            //set product properties
            $this->id = $product['id'];
            $this->name = $product['name'];
            $this->price = $product['price'];
            $this->created_at = $product['created_at'];

        }






        //create product
        public function create () {

            //create query and prepare
            $query = "INSERT INTO $this->table (name, price) VALUES (?, ?)" ;
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("sd", $name, $price);

            //bind params and execute
            $name = $this->name;
            $price = $this->price;

            if($stmt->execute()){
                //success
                return true;
            } else {
                //error
                return false;
            }

        }





        //update product
        public function update(){

            //create query and prepare
            $query = "UPDATE $this->table SET name = ?, price = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("sdi", $name, $price, $id);
            $name = $this->name;
            $price = $this->price;
            $id = $this->id;
            
        
            if($stmt->execute()){
                
                if(!$stmt->affected_rows){
                    //no product found with specified id 
                    return false;
                }

                //successfully updated product with specified id
                return true;
        
            } else {
                //error
                return false;
            }
        }






        //delete product
        public function delete () {

            //create query and prepare
            $query = "DELETE from $this->table WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            //bind param
            $stmt->bind_param("i", $id);
            $id = $this->id;

            
            //execute
            if($stmt->execute()){
                if(!$stmt->affected_rows){
                    //no product found with specified id 
                    return false;
                }
                //successfully deleted product
                return true;
            } else {
                //error
                return false;
            }
        }
        

    }

?>