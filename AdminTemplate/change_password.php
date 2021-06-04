<?php require_once('header.php') ?>

<?php
require_once('db.php');
$msg='';
if(isset($_POST['submit'])){
	$password=mysqli_real_escape_string($con,$_POST['password']);

    $hash = password_hash($password, PASSWORD_DEFAULT);

	$update_sql='';
	if(isset($_POST['logout'])){
		mysqli_query($con,"delete from users_login where user_id='".$_SESSION['UID']."' and rand_no!='".$_SESSION['UID_RAND']."'");
	}
	mysqli_query($con,"update users set password='$hash' $update_sql where id='".$_SESSION['UID']."'");
	$msg="Password updated";
}
?>

<div class="row w-100 mx-0">
    <div class="col-lg-10 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
           <h2>Change Password</h2>
            <form id="login-form" class="pt-3" method="post">
               
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" onkeyup="passValidate(this.value);" id="password" placeholder="Password">
                    <span id="password_error1"></span>
                </div>
                <div class="mt-3">
                    <label for="" class="pr-5">Logout From All devices : </label>
                    <input type="checkbox" name="logout" class="">
                </div>
                <div class="mt-3">
                    <input type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Save">
                </div>
                <br>
                <span class="text-success"><?php echo $msg; ?></span>
            </form>
            
        </div>
    </div>
</div>

<?php require_once('footer.php') ?>