<?php 

    header('Content-Type: application/json');

    include_once '../config/database.php';
    include_once '../models/product.php';


    $database = new Database();
    $db = $database->connect();

    $product = new Product($db);
    $prodotti = $product->read();

    
    

    $array_di_prodotti = array();
    $array_di_prodotti['data'] = array();
    
   
    if(!empty($prodotti)){


        foreach( $prodotti as $prodotto){

            $singleProduct = array(
                'id' => $prodotto['id'],
                'name' => $prodotto['name'],
                'price' => $prodotto['price'],
                'created_at' => $prodotto['created_at']
            );
            
            array_push($array_di_prodotti['data'], $singleProduct);
        };


        echo json_encode($array_di_prodotti);


    } else {
        echo json_encode(array('message' => 'No Products Found'));
    }  

        
    
    

?>



