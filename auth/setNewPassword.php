<?php


include ("../connection/dbc.php");
include ("../functions/functions.php");

$email = filterRequest("email");
$password = filterRequest("password");

$table = "users";
$where = "email  = '$email' ";
$data = array(
    "password" => $password,
);


$to = $email;
$msg = " your password was successfully reset" ;
$title = "Successfully reset account";




$response = checkIfWhereIsTrue($table, $where);

if($response){
    
    if(updateData($table,$where ,$data) == false){
    
      sendMail($to,$title, $msg);
    
    }
    
}else{
    echo json_encode(array("status" => "errorNotSet"));
}
