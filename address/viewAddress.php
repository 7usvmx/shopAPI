<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");


    $table = "address";
    $userID = filterRequest("userID");
    $where = " WHERE addressUserID = $userID ";

    getDataWhere($table,$where);
