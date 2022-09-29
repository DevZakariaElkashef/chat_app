<?php
session_start();
include "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


if(empty($email) || empty($password)){
    echo "All Feild Are Required";
    die;
} else{
    // email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Email Is Not Valid";
        die;
    } else{
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $sql = mysqli_query($conn, $query);
        if(mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $sql2 = mysqli_query($conn, "UPDATE users SET status = 'Active Now' WHERE id = '{$row['id']}'");
            $_SESSION['user_id'] = $row["id"];
            echo "success";

            
        }else{
            echo "Email Or Passwor is Incorrect";
            die;
        }

    }
}