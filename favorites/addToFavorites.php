<?php


    include("../connection/dbc.php");
    include("../functions/functions.php");

    $userID = filterRequest("userID");
    $productID = filterRequest("productID");

    $table = 'favorites';
    $where = "userID = `$userID`";
    $data = array(
        "userID"=> $userID,
        "favProduct_ID"=> $productID,
    );

    InsertData($table, $data);