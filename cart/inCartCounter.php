<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $userID = filterRequest("userID");
    $productID = filterRequest("productID");

    $table = "cart";
    $where = "cartUsersID = $userID AND cartProductID = $productID";
    $itemToCount = 'COUNT(cartID) AS quantity ';
    getCountOfItems( $itemToCount , $table, $where,true);


    