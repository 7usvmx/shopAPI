<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $table = "address";
    $userID = filterRequest("userID");
    $addressID = filterRequest("addressID");
    $addressName = filterRequest("addressName");
    $city = filterRequest("city");
    $street = filterRequest("street");
    $lat = filterRequest("lat");
    $long = filterRequest("long");

    $where = "addressID = $addressID";

    $data = array(
        
        "addressName"=> $addressName,
        "addressCity"=> $city,
        "addressStreet"=> $street,
        "addressLat"=> $lat,
        "addressLong"=> $long

    );

    updateData($table,$where,$data);
