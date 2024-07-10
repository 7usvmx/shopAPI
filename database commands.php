<?php

//! select
$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(array($email));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        //! insert
        $stmt = $con->prepare('INSERT INTO users(username,email,password) VALUES(?,?,?) ');
        $stmt->execute(array($username,$email,$hashedPass));
        
            $count = $stmt->rowCount();