<?php 

//! Database connection


// variables 


$database_username = "root";
$database_password = "";

$database_source_name = "mysql:host=localhost;dbname=shop";

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8" // to make database supporting Arabic language
);

// connecting to database


try {

    // connect code...
    $con = new PDO($database_source_name, $database_username, $database_password, $options);

    // set attributes

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch ( PDOException $e) {
    //throw $e;
    echo "". $e->getMessage() ."";;
}




