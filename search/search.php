<?php 

    include ("../connection/dbc.php");
    include ("../functions/functions.php");

    $searchName = filterRequest("searchName");
    $table = 'productsView';
    $where = "WHERE arProductName LIKE '%$searchName%' OR enProductName LIKE '%$searchName%' ";

    getDataWhere($table,$where);