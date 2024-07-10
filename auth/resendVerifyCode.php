<?php


include ("../connection/dbc.php");
include ("../functions/functions.php");


// Code 

// $addingFiveMinutes= strtotime('+ 5 minute');
// $sentTime = date("h:i:s");
// $expireTime = date("h:i:s", $addingFiveMinutes);



$email = filterRequest("email");

$table = "users";
$where = "email  = '$email' ";
$code = codeGenerator();
$data = array(
    "confirmationCode" => $code,
);


$to = $email;
$msg = " Hey There! your verify code is : " . $code . " it's just valid For 5 minutes!" ;
$title = "Confirm your account";




$response = checkIfWhereIsTrue($table, $where);

if($response){
    
    if(updateData($table,$where ,$data)){
    
    sendMail($to,$title, $msg);
    
   
    };
    
}else{
    echo json_encode(array("status" => "notSent"));
}
