
<?php
// error_reporting(0);
    // echo "ee";die;
    require_once('db.php');
    
    $id=mysqli_real_escape_string($con,$_POST['id']);
    $name=mysqli_real_escape_string($con,$_POST['name']);



    $query = "UPDATE users set name = '$name' where id = '$id'";
    $data = mysqli_query($con,$query) or die("Query failed") ; 

    if ($data) {
        
        header('Location: ../AdminTemplate/dashboard.php');
    
    }

?>