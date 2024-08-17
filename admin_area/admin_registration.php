<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Registration</title>
  <!-- Bootstrap  Css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      overflow: hidden;
    }
  </style>
</head>

<body>
  <div class="container-fluid mt-5">
    <h2 class="container text-center mb-5">Admin Registration</h2>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-xl-5">
        <img src="../images/admin.png" alt="Admin Registration" class="img-fluid">
      </div>
      <div class="col-lg-6 col-xl-5">
        <form action="" method="post">
          <div class="form-outline mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="admin_name" placeholder="Enter your username" required="required" class="form-control">
          </div>
          <div class="form-outline mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="admin_email" placeholder="Enter your email" required="required" class="form-control">
          </div>
          <div class="form-outline mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
          </div>
          <div class="form-outline mb-4">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="confirm_password" id="confirm_password" name="confirm_password" placeholder="Enter your confirm password" required="required" class="form-control">
          </div>
          <div>
            <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registeration" value="Register">
            <p class="small fw-bold mt-2 pt-1">Do you already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>



<!-- php code -->
<?php
if (isset($_POST['admin_registeration'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $hash_password = password_hash($admin_password,PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];
   
    //$user_ip = getIPAddress();


    // select_query
    $select_query = "select * from admin_table where admin_name='$admin_name' or admin_email = '$admin_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    if ($rows_count > 0) {
        echo "<script>alert('Admin name und Email already exist')</script>";
    }elseif ($admin_password!=$confirm_password) {
        echo "<script>alert('password do not match')</script>";

    } 
    
    else {
        // insert_query
       // move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "insert into admin_table (admin_name, admin_email, admin_password) values ('$admin_name', '$admin_email', '$hash_password')";
        $sql_execute = mysqli_query($con, $insert_query);
        echo "<script>alert('user name inserted sccessfully')</script>";
        echo "<script>window.open('./admin_login.php','_self')</script>";
    }


     /*
     // select cart items
     $select_cart_items ="select * from cart_details where ip_address = '$user_ip'";
     $result_cart = mysqli_query($con, $select_cart_items);
     $rows_count = mysqli_num_rows($result_cart);
     if($rows_count>0){
         $_SESSION['username']=$user_username;
         echo "<script>alert('You have items in your Cart')</script>";
         echo "<script>window.open('checkout.php','_self')</script>";
 
     }
     else{
         echo "<script>window.open('../index.php','_self')</script>";
 
     }
     */


}


?>