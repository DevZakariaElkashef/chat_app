<?php
require_once('config.php');
session_start();

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// all inputs
if(empty($fname) || empty($lname) || empty($email) || empty($password)){
    echo "All Input Feild Are Requeired";
}
else{
    // name
    if(strlen($fname) < 3 ||strlen($lname) < 3){
        echo "Name Should Be More Than 3 Char";
        die;
    }
    if(is_numeric($fname) || is_numeric($lname)){
        echo "Name Is Not Valid";
        die;
    }
    // email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Email Is Not Valid";
        die;
    } else{
        $query = "SELECT email FROM users WHERE email = '$email'";
        $sql = mysqli_query($conn, $query);
        if(mysqli_num_rows($sql) > 0) {
            echo "Email Is Already Exist";
            die;
        }
    }
    // password
    if(strlen($password) < 5){
        echo "Password Should Be More Than 5 char";
        die;
    }

    // image
    if($_FILES['image']['name'] == ''){
        echo "Upload Your Photo";
        die;
    }else{
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);
        $extentions = ['jpg', 'jpeg', 'png'];
        if(in_array($img_ext, $extentions) === true){
            $new_img_name = time() . $img_name;
            move_uploaded_file($tmp_name, '../images/'. $new_img_name);
        }else{
            echo "This Image Is Not Supported"; 
            die;
        }
    }

    
    $insert = mysqli_query($conn, "INSERT INTO users (fname, lname, email, password, img, status) VALUES ('$fname', '$lname', '$email', '$password', '$new_img_name', 'Active Now') ");
    if($insert){
        $sql3 = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");
        if(mysqli_num_rows($sql3) > 0){
            $row = mysqli_fetch_assoc($sql3);
            $sql2 = mysqli_query($conn, "UPDATE users SET status = 'Active Now' WHERE id = '{$row['id']}'");
            $_SESSION['user_id'] = $row["id"];
            echo "success";
        }
    }else{
        echo "Error Adding Data";
    }
    
    
}

