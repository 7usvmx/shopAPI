<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $userID = filterRequest("userID");
    $productID = filterRequest("productID");
    $cartID = filterRequest("cartID");
    

    $table = 'cart';
    $where = "cartID = ( SELECT cartID FROM cart WHERE cartUsersID = $userID AND cartProductID = $productID LIMIT 1 ) ";

    deleteData($table, $where);