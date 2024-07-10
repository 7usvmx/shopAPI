<?php

    session_start();
    ob_start();
    include "../assest/includes/dbc.php";
    
    # code generate 

    
    $addingFiveMinutes= strtotime('+ 5 minute');

    $code = rand(111111,999999);
    $sentTime = date("h:i:s");
    $expireTime = date("h:i:s", $addingFiveMinutes);

    


    $sql   = "UPDATE user SET code = '$code', timer = '$sentTime' , expireAt = '$expireTime' WHERE id = 1";

    if( $conn->query($sql) == TRUE ){


        $to = "husam513@gmail.com";
        $msg = ' Hey There! your reset password code is : ' . $code . ' Code just valid For 5 minutes!' ;
        $title = "Reset your password code";
        $headers = "confirme your identity";
        

        if( mail($to,$title, $msg, $headers) ) {

            header("location: forgetPassword.php");
            exit;          
        }else{

        echo "Somthing wrong :\ Try to get your code again <a href=''>Click Me!</a>  to resent your code ";
        
        }
}
