<?php

    
include("../connection/dbc.php");
include("../functions/functions.php");

$userID = filterRequest("userID");
$table = 'favoritesView';
$where = "WHERE userID = $userID";

getDataWhere($table, $where);   
