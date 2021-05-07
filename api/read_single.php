<?php

    header('Content-Type: application/json');

    //ini_set('display_errors', '1');

    include_once '../config/database.php';
    include_once '../models/product.php';

    
    $database = new Database();
    $db = $database->connect();


    $product = new Product($db);




    //get product ID from GET request
    if(isset($_GET['id'])){
       //additional protection against sql injection
       $product->id = mysqli_real_escape_string($db, $_GET['id']);
    } else {
        die();
    }




    //get single product
    $product->read_single();


    //create array
    $product_arr = array(
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'created_at' => $product->created_at,
    );


    //make json
    print_r(json_encode($product_arr));



?>