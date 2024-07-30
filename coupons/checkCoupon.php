<?php

date_default_timezone_set('Asia/Riyadh');

include ("../connection/dbc.php");
include ("../functions/functions.php");

$coupon = filterRequest("coupon");
$now = date('Y-m-d H:i:s');
echo $now;
$table = "coupons";
$whereForCheck = "couponName = '$coupon' AND couponExDate < $now  ";
$whereForGet = "couponName = '$coupon' ";

$response = checkIfWhereIsTrue($table, $whereForCheck);
if($response){
    getDataWhere($table,"WHERE $whereForGet");
    // echo json_encode(array("status" => "success"));
}else{

    echo json_encode(array("status" => "couponError"));
}

// //! Signup Function
