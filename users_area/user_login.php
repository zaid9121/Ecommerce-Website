<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
$message = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User -Login</title>
    <!-- Bootstrap  Css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <img src="./images/logo.png" alt="" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>

                </ul>
               
            </div>
        </div>
    </nav>

    <div class="container-fluid my-3">
        <h2 class="text-center"> User Login</h2>
        <div class="row d-flex align-text-center justify-content-center mt-5">
            <div class="co-lg-12 col-xl-6">
                <form action="" method="post">
                    <!-- username field-->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                    </div>

                    <!-- password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                    </div>

                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ? <a href="user_registration.php" class="text-danger"> Register</a></p>
                        <p class="text-center"><?php echo $message; ?></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>



<?php


if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM user_table WHERE username = '$user_username'";
    $result = mysqli_query($con, $select_query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $hashed_password = $row['user_password'];
            $role = $row['role'];

            if (password_verify($user_password, $hashed_password)) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $role; // Assuming 'role' is a column in your users table

                if ($role === 'admin') {
                    header("Location: ../admin_area/index.php");
                    exit;
                } else {
                    // Cart item
                    $user_ip = getIPAddress();
                    $select_query_cart = "SELECT * FROM cart_details WHERE ip_address = '$user_ip'";
                    $select_cart = mysqli_query($con, $select_query_cart);
                    $row_count_cart = mysqli_num_rows($select_cart);

                    if ($row_count_cart > 0) {
                        echo " <script>window.open('payment.php','_self')</script>";
                    } else {
                        echo " <script>window.open('profile.php','_self')</script>";
                    }
                }
            } else {
                echo " <script>alert('Invalid Credentials')</script>";
            }
        }
    } else {
        echo " <script>alert('Invalid Credentials')</script>";
    }
}
?>