<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $table = "address";
    $userID = filterRequest("userID");
    $addressName = filterRequest("addressName");
    $city = filterRequest("city");
    $street = filterRequest("street");
    $lat = filterRequest("lat");
    $long = filterRequest("long");

    $data = array(
        
        "addressUserID"=> $userID,
        "addressName"=> $addressName,
        "addressCity"=> $city,
        "addressStreet"=> $street,
        "addressLat"=> $lat,
        "addressLong"=> $long

    );

    InsertData($table,$data);
