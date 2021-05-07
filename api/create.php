<?php


    //ini_set('display_errors', 1);

    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods');
    

    include_once '../config/database.php';
    include_once '../models/product.php';

    

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        die();
    }


    
    $database = new Database();
    $db = $database->connect();


    $product = new Product($db);


    

    
    
    //get raw posted data
    
    // fetch json from user POST request
    //$data = json_decode(file_get_contents("php://input"));
   
    //get json from harcoded file for testing
    $data = file_get_contents("../create_test.json");
    $decodedInput= json_decode($data);
    
    $product->name = $decodedInput->name;
    $product->price = $decodedInput->price;

   
    //create post
    if($product->create()){
        echo json_encode(array('message' => 'Product Created'));
    } else {
        echo json_encode(array('message' => 'Product Not Created'));
    }



?>