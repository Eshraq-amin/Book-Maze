<?php
session_start();

if(isset($_SESSION['email'])){
    header("Location: account.php");
}

include("connection.php");
include("functions.php");

$email=$password='';
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($password) &&  !empty($email))
    {
     
        //read to database
        $query = "select * from users where email = '$email' limit 1";

        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password)
                {
                    $_SESSION['loggedIn_User_Id'] = $user_data['id'];
                    $_SESSION['email'] = $user_data['email'];

                    //Check Session against Cart and Update its User Id
                    if(isset($_SESSION['books_cart'])){
                        foreach($_SESSION['books_cart'] as $key => $cartItem){
                            $_SESSION['books_cart'][$key]['user_id'] = $user_data['id'];
                        }

                        header("Location: checkout.php");
                        die;
                    }

                    header("Location: index.php");
                    die;
                }
            }
        }

        

        echo "Please enter valid information.";
    }else
    {
        echo "Please enter  information.";
    }
}


?>





<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book Maze</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon/favicon.png">

	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="mycss/mystyle.css">
</head>
<body>

    <main class="login-bg">
        <!-- login Area Start -->
        <form method="post">

        <div class="login-form-area">
            <div class="login-form">
                <!-- Login Heading -->
                <div class="login-heading">
                    <span>Login</span>
                    <p>Enter Login details to get access</p>
                </div>
                <!-- Single Input Fields -->
                <div class="input-box">
                    <div class="single-input-fields">
                        <label> Email Address</label>
                        <input type="text" name="email" placeholder="Email address">
                    </div>
                    <div class="single-input-fields">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="single-input-fields login-check">
                        <input type="checkbox" id="fruit1" name="keep-log">
                        <p>Login as admin: <a href="admin_login.php">Admin Login</a></p>
                    </div>
                </div>
                <!-- form Footer -->
                <div class="login-footer">
                    <p>Don’t have an account? <a href="register.php">Sign Up</a>  here</p>
                    <button class="submit-btn3">Login</button>
                </div>
            </div>
        </div>
</form>
        <!-- login Area End -->
    </main>

    <!-- JS here -->
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <!-- Slick-slider , Owl-Carousel ,slick-nav -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!--wow , counter , waypoint, Nice-select -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/price_rangs.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!--  Plugins, main-Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    </body>
</html>