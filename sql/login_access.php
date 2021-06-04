<?php

require('db.php');

$email=mysqli_real_escape_string($con,$_POST['email']);
$password=mysqli_real_escape_string($con,$_POST['password']);

// echo $password;die;

$res = mysqli_query($con, "select * from users where email='$email'");
if( mysqli_num_rows( $res ) > 0)
{
    $data = mysqli_fetch_assoc($res);
    $verfy =password_verify($password, $data['password']);
    if ($verfy) 
    {
        $id = $data['id'];
        mysqli_query($con,"update users set status='1' where id='$id'");
        $rand_no = rand(1111111, 9999999);
        mysqli_query($con, "insert into users_login(user_id,rand_no) values($id,$rand_no)");
        $_SESSION['IS_LOGIN'] = true;
        $_SESSION['UID'] = $id;
        $_SESSION['UID_RAND'] = $rand_no;
        $_SESSION['UNAME'] = $data['name'];
        echo 1;
        die();
    
    } else{
        echo "password";
    }
} else {
    echo "email";
}


?>