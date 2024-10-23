<?php

define("MB", 1048576);
//! Filtering Requests
function filterRequest($request)
{
    return filter_var($_POST[$request], FILTER_SANITIZE_SPECIAL_CHARS);
}

//! Get data from database
function getAllData($table, $json = true)
{

    global $con;

    $stmt = $con->prepare("SELECT * FROM $table ");
    $stmt->execute();
    $count = $stmt->rowCount();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($json) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $result));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        if ($count > 0) {
            return $result;
        } else {
            return json_encode(array("status" => "failure"));
        }
    }
}

function getDataWhere($table, $where, $json = true, $isLogin = false)
{

    global $con;

    $stmt = $con->prepare("SELECT * FROM $table $where ");
    $stmt->execute();
    $count = $stmt->rowCount();

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($isLogin) {

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if ($json) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $result));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        if ($count > 0) {
            return $result;
        } else {
            return array(array("status" => "failure"));
        }
    }
}

function checkIfWhereIsTrue($table, $where = null)
{

    global $con;
    global $isIsset;

    $stmt = $con->prepare("SELECT * FROM `$table` WHERE $where ");
    $stmt->execute();
    $count = $stmt->rowCount();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($count > 0) {

        $isIsset = true;
        return $isIsset;
    } else {

        $isIsset = false;
        return $isIsset;
    }

    // return $response; 

}

function InsertData($table, $data = null)
{

    global $con;
    global $error;


    foreach ($data as $field => $v)
        $ins[] = ':' . $field;

    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));

    $stmt = $con->prepare("INSERT INTO $table($fields) VALUES($ins)");

    foreach ($data as $f => $v) {
        if ($v != null) {
            $stmt->bindValue(':' . $f, $v);
        } else {

            $error = "nullError";
            echo json_encode(array("error" => $error));
            exit;
        }
    }

    $stmt->execute();
    $count = $stmt->rowCount();


    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }

    return $count;
}

//! update database
function updateData($table, $where = null, $data = null)
{

    global $con;
    $cols = array();
    $values = array();

    foreach ($data as $key => $val) {


        if ($val != null) {

            $values[] = "$val";
            $cols[] = "`$key` =  ? ";
        } else {

            $error = "nullError";
            echo json_encode(array("error" => $error));
            exit;
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($values);

    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "confirmed", "error" => "tryAgain", "isUpdated" => "updated"));
    }
}

//! Code generator 
function codeGenerator()
{
    $numbers = rand(0, 999999999);
    $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $confirmationCode = substr(str_shuffle(substr(str_shuffle($letters . strtolower($letters)), 0, 3) . $numbers), 0, 6);

    return $confirmationCode;
}
//! Send emails function

function sendMail($to, $title, $msg)
{

    $headers = "From: support@husamabdallah.com";
    mail($to, $title, $msg, $headers);
}

function deleteData($table, $where, $json = true)
{

    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
}

function getCountOfItems($itemToCount, $table, $where, $json = false, $isAll = false)
{

    global $con;

    $stmt = $con->prepare("SELECT $itemToCount FROM $table WHERE $where");
    $stmt->execute();
    if ($isAll) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    $count = $stmt->rowCount();

    if ($json) {
        if ($count > 0) {
            echo json_encode(array("status" => "success", 'data' => $data));
        } else {
            echo json_encode(array("status" => "success", "data" => "0"));
        }
    } else {
        if ($count > 0) {
            return $data;
        } else {
            echo json_encode(array("status" => "success", "data" => "0"));
        }
    }
}

    /*
    
    function getAllData($table, $where = null, $values = null)
    {
        global $con;
        $data = array();
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
        $stmt->execute($values);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count  = $stmt->rowCount();
        if ($count > 0){
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    }
    
    function insertData($table, $data, $json = true)
    {
        global $con;
        foreach ($data as $field => $v)
            $ins[] = ':' . $field;
        $ins = implode(',', $ins);
        $fields = implode(',', array_keys($data));
        $sql = "INSERT INTO $table ($fields) VALUES ($ins)";
    
        $stmt = $con->prepare($sql);
        foreach ($data as $f => $v) {
            $stmt->bindValue(':' . $f, $v);
        }
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
      }
        return $count;
    }
    
    
    function updateData($table, $data, $where, $json = true)
    {
        global $con;
        $cols = array();
        $values = array();
    
        foreach ($data as $key => $val) {
            $values[] = "$val";
            $cols[] = "`$key` =  ? ";
        }
        $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";
    
        $stmt = $con->prepare($sql);
        $stmt->execute($values);
        $count = $stmt->rowCount();
        if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        }
        return $count;
    }
    
    function deleteData($table, $where, $json = true)
    {
        global $con;
        $stmt = $con->prepare("DELETE FROM $table WHERE $where");
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($json == true) {
            if ($count > 0) {
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "failure"));
            }
        }
        return $count;
    }
    
    function imageUpload($imageRequest)
    {
      global $msgError;
      $imageName  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
      $imageTemp   = $_FILES[$imageRequest]['tmp_name'];
      $imageSize  = $_FILES[$imageRequest]['size'];
      $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
      $strToArray = explode(".", $imageName);
      $ext        = end($strToArray);
      $ext        = strtolower($ext);
    
      if (!empty($imageName) && !in_array($ext, $allowExt)) {
        $msgError = "EXT";
      }
      if ($imageSize > 2 * MB) {
        $msgError = "size";
      }
      if (empty($msgError)) {
        move_uploaded_file($imageTemp,  "../upload/" . $imageName);
        return $imageName;
      } else {
        return "fail";
      }
    }
    
    
    
    function deleteFile($dir, $imageName)
    {
        if (file_exists($dir . "/" . $imageName)) {
            unlink($dir . "/" . $imageName);
        }
    }
    
    function checkAuthenticate()
    {
        if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
            if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo 'Page Not Found';
                exit;
            }
        } else {
            exit;
        }
    
        // End 
    }

    Function getDataWhere($table, $where = null, $json = false){
        
        global $con;
        global $data;

        $stmt = $con->prepare("SELECT * FROM `$table` `$where` ");
        $stmt->execute();
        $count = $stmt->rowCount();

        
            if( $count > 0 ){
                echo json_encode(array("status" => "success", "data" => $data));  
                
            }else{  
                // echo json_encode(array("status" => "failure"));
                echo json_encode(array("status" => "failure"));
            }
        
        // if ($json) {
        // }else{

        //     if( $count > 0 ){
        //         return $data;  
                
        //     }else{  
        //         // echo json_encode(array("status" => "failure"));
        //         return json_encode(array("status" => "failure"));
        //     }
        // }
        
        // return $response; 

    }




    */