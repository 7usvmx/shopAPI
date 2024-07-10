<?php 

    include "../connection/dbc.php";
    include "../functions/functions.php";

    $homeAllData = array();

    $homeAllData['status'] = "success";

    $catData = getAllData("categories", false);
    $productsData = getDataWhere("productsView", "WHERE productCat = 1" ,false);

    $homeAllData["cat"] = $catData;
    $homeAllData["products"] = $productsData;
    

   echo json_encode($homeAllData);
    