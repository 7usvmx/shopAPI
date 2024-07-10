<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");




    

    $allData = array();

    $allData["status"] = "success";

    $userID = filterRequest('userID');
    $table = 'cartView';
    $where = " WHERE cartUserID = $userID ";
    
    
    $allData['data'] = getDataWhere($table,$where,false,true);
    
    $itemToCount = " SUM(amount) as totalAmount , COUNT(quantity) AS allProductsQuantity ";
    $whereForCounter = "cartUserID = $userID";

    $allData['amountData'] = getCountOfItems($itemToCount,$table,$whereForCounter,false,true); 

    echo json_encode($allData);