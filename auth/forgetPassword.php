<?php 


    include ("../connection/dbc.php");
    include ("../functions/functions.php");

    $email = filterRequest("email");
    $table = "users";
    $where = "email = '$email' ";
    $code = codeGenerator();
    $data = array(
        "confirmationCode" => $code,
    );    

    //! send email parameters
    $to = $email;
    $msg = " Hey There! your reset password code is : " . $code . " it's just valid For 5 minutes!" ;
    $title = "Confirm your account";

    

    $response = checkIfWhereIsTrue($table, $where);


    if($response){
    
        if(updateData($table,$where ,$data)){
    
            sendMail($to,$title, $msg);
            
        };
        
        sendMail($to,$title, $msg);
    }else{

        echo json_encode(array("status" => "userNotFound"));
    }
