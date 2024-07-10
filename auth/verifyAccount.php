<?php


include ("../connection/dbc.php");
include ("../functions/functions.php");


$email = filterRequest("email");
$confirmationCode = filterRequest("confirmationCode");

$table = "users";
$where = "email  = '$email' AND confirmationCode = '$confirmationCode' ";
$data = array(
    "status" => 1,
);

$response = checkIfWhereIsTrue($table, $where);

if($response){
    updateData($table,$where ,$data);
}else{
    echo json_encode(array("status" => "errorCode"));
}
