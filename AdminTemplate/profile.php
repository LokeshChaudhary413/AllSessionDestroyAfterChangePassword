<?php require_once('header.php');

// include_once('db.php');

$data = mysqli_fetch_assoc(mysqli_query($con,'select * from users where id='.$_SESSION['UID']));

// echo "<pre>";
// print_r($data);die;

?>


<h1>Profile</h1>
<div class="p-5">

  <form class="pt-3" action="../sql/update.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="">Name</label>
      <input type="hidden" name="id" value="<?php echo $data['id']; ?>" >
      <input type="text" name="name" class="form-control form-control-lg" value="<?php echo $data['name']; ?>" >
    </div>

    <div class="mt-3">
      <input type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value='Update'> 
    </div>

  </form>
</div>


<?php require_once('footer.php') ?>