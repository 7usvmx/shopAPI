<?php

include ("../connection/dbc.php");
include ("../functions/functions.php");


// //! Request variables
$fullName = filterRequest("fullname");
$username = filterRequest("username");
$email = filterRequest("email");
$password = filterRequest("password");
$phone = filterRequest("phone");
$profileImage = filterRequest("profileImage");

$code = codeGenerator();



$table = "users";

$data = array(
    "fullname" => $fullName,
    "username" => $username,
    "email" => $email,
    "password" => $password ,
    "phone" => $phone,
    "profileImage" => $profileImage,
    "confirmationCode" => $code,
);
$where = "email = '$email' ";

//! send email parameters
$to = $email;
$msg = " Hey There! your reset password code is : " . $code . " it's just valid For 5 minutes!" ;
$title = "Confirm your account";



$response = checkIfWhereIsTrue($table, $where);


if($response){

    echo json_encode(array("status" => "registered"));

}else{

    InsertData($table,$data);
    sendMail($to,$title, $msg);

}


