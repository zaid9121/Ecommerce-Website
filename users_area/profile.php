<?php

include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellcom <?php echo $_SESSION['username'] ?></title>
    <!-- Bootstrap  Css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Css file -->
    <link rel="stylesheet" href="../style.css">
    
    <style>
        body {
            overflow-x:hidden;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"> Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?> /-</a>
                        </li>

                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <?php
        cart();
        ?>
        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcom Guest</a>
        </li>";
                } else {
                    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcom " . $_SESSION['username'] . "</a>
        </li>";
                }

                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                    </li>";
                } else {
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='logout.php'>Logout</a>
                    </li>";
                }
                ?>
            </ul>
        </nav>
        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <!-- fourth child -->
        <div class="row">
            <div class="col-md-2 text-center" style="height: 100vh;">
                <ul class="navbar-nav bg-secondary">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="#">
                            <h4>Your profile</h4>
                        </a>
                    </li>
                    <?php
                    $username = $_SESSION['username'];
                    $user_image = "select * from user_table where username='$username'";
                    $result_image = mysqli_query($con, $user_image);
                    $row_image = mysqli_fetch_array($result_image);
                    $user_image = $row_image['user_image'];
                    echo "<li class='nav-item'>
                    <img src='./user_images/$user_image' class='profile_img my-4' alt=''>
                    </li>";

                    ?>
                    <!--
                    <li class="nav-item">
                        <img src="../images/fruit.png" class="profile_img my-4" alt="">
                    </li>
                      -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php">
                            Pending Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">
                            Edit account
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-light" href="profile.php?my_orders">
                            My Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?delete_account">
                            Delete Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php 
                get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    include('edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                    include('user_orders.php');
                }
                if (isset($_GET['delete_account'])) {
                    include('delete_account.php');
                }
                ?>
            </div>
        </div>

        <!-- last child -->
        <!-- iclude footer -->
        <?php
        include("../includes/footer.php");
        ?>

    </div>

    <!--Bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>