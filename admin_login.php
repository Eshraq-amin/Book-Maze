<?php
if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['admin_id'])){
    header("Location: admin_dashboard.php");
    exit;
}

include("connection.php");

$email=$password=$resMessage='';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loggedIn = 0;
    if(!empty($password) &&  !empty($email)){
        $query = "select * from admin_user where email = '$email' limit 1";
        $result = mysqli_query($con, $query);
        if($result->num_rows > 0){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password){
                    $_SESSION['admin_id'] = $user_data['id'];
                    header("Location: admin_dashboard.php");
                    die;
                }
            }
        }
    }

    $resMessage = "Please enter correct login details!...";

}
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book Maze Admin</title>
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
        <form action="" method="post">

        <div class="login-form-area">
            <div class="login-form">
                <!-- Login Heading -->
                <div class="login-heading">
                    <span>Admin Login</span>
                    <p>Enter Admin Login details to get access</p>
                </div>
                <!-- Single Input Fields -->
                <div class="input-box" style="padding-bottom:0px !important;">
                    <div class="single-input-fields">
                        <label> Email Address</label>
                        <input required type="text" name="email" placeholder="Email address">
                    </div>
                    <div class="single-input-fields">
                        <label>Password</label>
                        <input required type="password" name="password" placeholder="Enter Password">
                    </div>
                </div>

                <div style="text-align:center; color:red;"><?php if(isset($resMessage)){ echo $resMessage; } ?></div>
                
                <div class="login-footer">
                    <button class="submit-btn3" style="width:100%;">Login</button>
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