<?php


include ("../connection/dbc.php");
include ("../functions/functions.php");

$email = filterRequest("email");
$password = filterRequest("password");

$table = "users";
$where = "email = '$email' ";



$response = checkIfWhereIsTrue($table, $where);
if($response){
        
        $table = "users";
        $where = " email = '$email' AND status = 1";
        $response = checkIfWhereIsTrue($table, $where);

        if ($response) {

            $table = "users";
            $where = "WHERE email = '$email' AND password = '$password' ";
            $response = json_encode(getDataWhere($table,$where,true,true));

        }else{
            
            echo json_encode(array("status" => "notVerified"));
        }

    }

else{

    echo json_encode(array("status" => "emailError"));
}

// //! Signup Function
