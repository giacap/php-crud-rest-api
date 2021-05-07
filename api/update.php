<?php


    ini_set('display_errors', 1);

    header('Content-Type: application/json');
    

    include_once '../config/database.php';
    include_once '../models/product.php';
   


    if($_SERVER['REQUEST_METHOD'] !== 'PUT'){
        die();
    }
       
       
    $database = new Database();
    $db = $database->connect();
   
   
    $product = new Product($db);







    //get raw posted data
    
    // fetch json from user PUT request
    //$data = json_decode(file_get_contents("php://input"));
   
    //get json from harcoded file for testing
    $data = file_get_contents("../update_test.json");
    $decodedInput= json_decode($data);
    
    $product->name = $decodedInput->name;
    $product->price = $decodedInput->price;
    $product->id = $decodedInput->id;
   
    //update post
    if($product->update()){
        echo json_encode(array('message' => 'Product Updated'));
    } else {
        echo json_encode(array('message' => 'Product Not Updated'));
    }



?>