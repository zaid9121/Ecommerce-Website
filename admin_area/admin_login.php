<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
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
    <h2 class="container text-center mb-5">Admin Login</h2>
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
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
          </div>

          <div>
            <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
            <p class="small fw-bold mt-2 pt-1">Don't you have an account? <a href="admin_registration.php" class="link-danger">Register</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

<?php
// php code login

if (isset($_POST['admin_login'])) {
  $admin_name = $_POST['admin_name'];
  $admin_password = $_POST['admin_password'];

  $select_query = "select * from admin_table where admin_name ='$admin_name'";
  $result = mysqli_query($con, $select_query);
  $row_count = mysqli_num_rows($result);
  $row_data = mysqli_fetch_assoc($result);
  // $user_ip = getIPAddress();




  // cart item
  //$select_query_cart = "select * from cart_details where ip_address ='$user_ip'";
  //$select_cart =mysqli_query($con, $select_query_cart);
  //$row_count_cart = mysqli_num_rows($select_cart);
  if ($row_count > 0) {
    $_SESSION['admin_name'] = $admin_name;
    if (password_verify($admin_password, $row_data['admin_password'])) {
      // echo " <script>alert('Login successfull')</script>";
      echo " <script>alert('Login successfull')</script>";
      echo " <script>window.open('./index.php','_self')</script>";
    } else {
      echo " <script>alert('Invalid Credentials')</script>";
    }
  }
}
?>