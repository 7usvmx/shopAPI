<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $catID = filterRequest("catID");
    $userID = filterRequest("userID");



    $stmt = $con->prepare("
    
        SELECT productsView.*, 1 as favorite, (productPrice - (productPrice * (productDiscount / 100) ) ) AS discount FROM productsView
        INNER JOIN
        favorites on favorites.favProduct_ID = productsView.productID AND favorites.userID = $userID
        WHERE catID = $catID
        UNION ALL
        SELECT * , 0 as favorite, (productPrice - (productPrice * (productDiscount / 100) ) ) AS discount FROM productsView
        WHERE catID = $catID AND productID NOT IN (
        SELECT productsView.productID FROM productsView
        INNER JOIN
        favorites on favorites.favProduct_ID = productsView.productID AND favorites.userID = $userID
        )

    ");
    

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $count = $stmt->rowCount();

    if( $count > 0 ){

        echo json_encode(array("status"=> "success","data"=> $data));
    }else{
        echo json_encode(array("status"=> "failure"));

    }
