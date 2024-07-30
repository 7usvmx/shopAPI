<?php


include ("../connection/dbc.php");
include ("../functions/functions.php");

$couponName = filterRequest('couponName');
$couponCount = filterRequest('couponCount');
$couponDiscount = filterRequest('couponDiscount');
$couponExDate = filterRequest('couponExDate');

$coupon = filterRequest('coupon');
$table = "coupons";
$where = "couponName = '$coupon'";

$data = array(
    "couponName" => $couponName,
    "couponCount" => $couponCount,
    "couponDiscount" => $couponDiscount,
    "couponExDate" => $couponExDate,
);



$response = checkIfWhereIsTrue($table, $where);

if ($response) {
    
    echo json_encode(array("status" => "duplicated"));
}else{
    
    $count = InsertData($table,$data);
}


