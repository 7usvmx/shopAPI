<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $table = "address";
    $addressID = filterRequest("addressID");
    $where = "addressID = $addressID";

    deleteData($table,$where);
