<?php


    include("../connection/dbc.php");
    include("../functions/functions.php");

    $userID = filterRequest("userID");
    $productID = filterRequest("productID");

    $table = 'favorites';
    $where = "userID = $userID AND favProduct_ID = $productID ";

    deleteData($table, $where);