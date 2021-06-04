<?php

require_once('db.php');
$email=mysqli_real_escape_string($con,$_POST['email']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$password=mysqli_real_escape_string($con,$_POST['password']);

$hash = password_hash($password, PASSWORD_DEFAULT);

$res = mysqli_query($con, "select * from users where email='$email'");
if( mysqli_num_rows( $res ) > 0){
    echo "alreadyPresent";
}else{

    $result = mysqli_query($con,"INSERT INTO users (name, email, password,status) values('$name','$email','$hash',1)") or die('query failed');
    if($result){
        echo "success";
    }
}
?>