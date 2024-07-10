<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $productID = filterRequest('productID');
    $userID = filterRequest('userID');
    $checkTable = 'products';
    $cartTable = 'cart';
    $whereForCheck = "productID = $productID";
    $whereForGetData = "WHERE cartUserID = $userID";

     
   $checker = checkIfWhereIsTrue($checkTable, $whereForCheck);   
   
   if ($checker) {

        $data = array(
            'cartUsersID' => $userID,
            'cartProductID' => $productID,
        );
 
        InsertData($cartTable, $data);

    }else{

        echo json_encode(array('status' => "failure"));

   }



//    <?php 

//    include ("../connection/dbc.php");
//    include ("../functions/functions.php");


//    $userID = filterRequest('userID');
//    $productID = filterRequest('productID');
//    $table = 'cart';



   

//    $data = array(
//        'cartUsersID' => $userID,
//        'cartProductID' => $productID,
//    );

//    InsertData($table, $data);

  
