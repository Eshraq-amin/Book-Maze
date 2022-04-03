<?php
include("php_header.php");

if($_POST){
    
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['info'])){
        $query = "UPDATE users SET fname = '".$_POST['fname']."',lname = '".$_POST['lname']."',user_name = '".$_POST['user_name']."',email = '".$_POST['email']."',address = '".$_POST['address']."' WHERE id = '".$_SESSION['loggedIn_User_Id']."'";
        mysqli_query($con,$query);

        header('Location: account.php?info=changed');
        exit;
    }

    if($_POST['new_pwd'] == $_POST['confirm_pwd']){
        $query = "select * from users WHERE id = '".$_SESSION['loggedIn_User_Id']."'";
        $result = mysqli_query($con,$query);
        $oldPWD = "";
        if($result && mysqli_num_rows($result) > 0){
            while($row = $result->fetch_assoc()) {
                $oldPWD = $row['password'];
            }
        }

        if($_POST['current_pwd'] == $oldPWD){
            $query = "UPDATE users SET password = '".$_POST['new_pwd']."' WHERE id = '".$_SESSION['loggedIn_User_Id']."'";
            mysqli_query($con,$query);

            header('Location: account.php?pwd=changed');
            exit;
        }else{
            header('Location: account.php?pwd=incorrectOld');
            exit;    
        }
    }else{
        header('Location: account.php?pwd=mismatched');
        exit;
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
    
    <style>
        .rating > i:hover{
            color:yellow;
        }
        .checked {
            color : yellow;
        }
        .unchecked {
            color : black;
        }
    </style>

    </head>    

<body>

    <!--== Wrapper Start ==-->
    <div class="wrapper">

        <!--== Start Header Wrapper ==-->
        <?php include 'include/topnav.php'; ?>
        <!--== End Header Wrapper ==-->

        <main class="main-content">



      <!--== Start Page Header Area Wrapper ==-->
      <section class="page-header-area" style="padding-top: 60px; padding-bottom: 0px;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="page-header-content">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                                <h2 class="page-header-title">My Profile</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--== End Page Header Area Wrapper ==-->

            <!--== Start My Account Wrapper ==-->
            <section class="account-area section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="myaccount-page-wrapper">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">
                                        <nav>
                                            <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="account-nav nav-link nav-link-100  active" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Account Overview</button>
                                                <button class="account-nav nav-link nav-link-100" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Order History</button>
                                                <button class="account-nav nav-link nav-link-100" id="changepassword-tab" data-bs-toggle="tab" data-bs-target="#changepassword" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Change Password</button>
                                                <button class="account-nav nav-link nav-link-100" id="payment-method-tab" data-bs-toggle="tab" data-bs-target="#payment-method" type="button" role="tab" aria-controls="address-edit" aria-selected="false">Payment Options  </button>
                                                <button class="account-nav nav-link nav-link-100" onclick="window.location.href='logout.php'" type="button">Logout</button>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="nav-tabContent">
                                            <!-- ACCOUNT OVERVIEW -->
                                            <?php
                                                $query = "select * from users WHERE id = '".$_SESSION['loggedIn_User_Id']."'";
                                                $result = mysqli_query($con,$query);

                                                $fname = "";
                                                $lname = "";
                                                $user_name = "";
                                                $email = "";
                                                $address = "";
                                                if($result && mysqli_num_rows($result) > 0){
                                                    while($row = $result->fetch_assoc()) {
                                                        $fname = $row['fname'];
                                                        $lname = $row['lname'];
                                                        $user_name  = $row['user_name'];
                                                        $email = $row['email'];
                                                        $address = $row['address'];
                                                    }
                                                }
                                            ?>
                                            <div class="tab-pane fade show active" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                                                <div class="myaccount-content">
                                                    <h3>Account Details</h3>
                                                    <div class="account-details-form">
                                                        <form action="account.php" method="POST">
                                                            <input type="hidden" name="info" />
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">First Name</label>
                                                                        <input value="<?php echo $fname; ?>" type="text" id="first-name" name="fname" placeholder="John" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Last Name</label>
                                                                        <input value="<?php echo $lname; ?>" type="text" id="last-name" name="lname" placeholder="Doe" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Display Name</label>
                                                                <input value="<?php echo $user_name; ?>" type="text" id="display-name" name="user_name" placeholder="John Doe" required />
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="email" class="required">Email Address</label>
                                                                <input value="<?php echo $email; ?>" type="email" id="email" name="email" placeholder="Johndoe@gmail.com" required/>
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label for="shipping-address" class="required"> Shipping Address</label>
                                                                <input value="<?php echo $address; ?>" type="text" id="shipping-address" name="address" placeholder="28185 Ridgecove Ct SRancho Palos Verdes, California" required />
                                                            </div>
                                                            <div class="single-input-item">
                                                                <button type="submit" class="check-btn sqr-btn">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ACCOUNT OVERVIEW END -->

                                            <!--Order History-->
                                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                                <div class="myaccount-content">
                                                    <h3>Order History</h3>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                    <th>Total</th>
                                                                    <th>Rate Order</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            <?php
                                                                $query = "select * from orders WHERE customer_id = '".$_SESSION['loggedIn_User_Id']."'";
                                                                $result = mysqli_query($con,$query);
                                                                if($result && mysqli_num_rows($result) > 0){
                                                            
                                                                    while($row = $result->fetch_assoc()) {

                                                                        $query1 = "select * from books_rating WHERE order_id = '".$row['id']."' LIMIT 1";
                                                                        
                                                                        $result1 = mysqli_query($con,$query1);
                                                                        $rate = 0;
                                                                        $rated = "0";
                                                                        if($result1 && mysqli_num_rows($result1) > 0){
                                                                            
                                                                            while($row1 = $result1->fetch_assoc()) {
                                                                                $rate = $row1['given_rating'];
                                                                                $rated = "1";
                                                                            }

                                                                        }
                                                            ?>
                                                                        <tr style="background:black;">
                                                                            <td><?php echo $row['id']; ?></td>
                                                                            <td><?php echo $row['created']; ?></td>
                                                                            <td><?php echo $row['status']; ?></td>
                                                                            <td><?php echo "$".$row['total_amount']; ?></td>

                                                                            <td>
                                                                            <?php if($row['status'] == "Completed" && $rated == 0){ ?>
                                                                                <div class="review">
                                                                                    <div class="rating">
                                                                                        <i onclick="rateOrder('<?php echo $row['id']?>', '1')" class="fas fa-star"></i>
                                                                                        <i onclick="rateOrder('<?php echo $row['id']?>', '2')" class="fas fa-star"></i>
                                                                                        <i onclick="rateOrder('<?php echo $row['id']?>', '3')" class="fas fa-star"></i>
                                                                                        <i onclick="rateOrder('<?php echo $row['id']?>', '4')" class="fas fa-star"></i>
                                                                                        <i onclick="rateOrder('<?php echo $row['id']?>', '5')" class="fas fa-star"></i>
                                                                                    </div>
                                                                                </div>
                                                                            <?php }else if($row['status'] == "Completed" && $rated == 1){ ?>
                                                                                <div class="rating">
                                                                                    <?php
                                                                                        for($i=1; $i<=5; $i++){
                                                                                            if($i <= $rate){
                                                                                    ?>
                                                                                                <i class="fas fa-star checked"></i>          
                                                                                    <?php
                                                                                            }else{
                                                                                    ?>
                                                                                                <i class="fas fa-star"></i>
                                                                                    <?php
                                                                                            }        
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                            <?php
                                                                    }
                                                                    
                                                                }
                                                            ?>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Order History End-->

                                            <!-- Change Password-->
                                            <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
                                                <div class="myaccount-content">
                                                    <h3> Change Your Password</h3>
                                                    <div class="account-details-form">
                                                        <form id="pwd" action="account.php" method="POST">
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Current Password</label>
                                                                <input type="password" id="current_pwd" name="current_pwd" required />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">New Password</label>
                                                                        <input type="password" id="new_pwd" name="new_pwd" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Confirm Password</label>
                                                                        <input type="password" id="confirm_pwd" name="confirm_pwd" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <button type="submit" class="check-btn sqr-btn">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Change Password End-->

                                            <!--Payment Options-->
                                            <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                                                <div class="myaccount-content">
                                                    <h3>Payment Method</h3>
                                                    <p class="saved-message">You do not have any saved payment options</p>
                                                </div>
                                            </div>
                                            <!--Payment Options End-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--== End My Account Wrapper ==-->

           

        </main>

        <!--== Start Footer Area Wrapper ==-->
        <?php include 'include/footer.php'; ?>
        <!--== End Footer Area Wrapper ==-->

        <!--== Scroll Top Button ==-->
        

        <!--== Start Side Menu ==-->
       
    </div>
    <!--== Wrapper End ==-->

    <!-- JS Vendor, Plugins & Activation Script Files -->

    <!-- Vendors JS -->
    <script src="./assets/js/vendor/modernizr-3.11.7.min.js"></script>
    <script src="./assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="./assets/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Plugins JS -->
    <script src="./assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="./assets/js/plugins/fancybox.min.js"></script>
    <script src="./assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="./assets/js/plugins/range-slider.js"></script>

    <!-- Custom Main JS -->
    <script src="./assets/js/main.js"></script>

    <script type="text/javascript">
        function rateOrder(orderId, ratingStars){
            window.location.href = "rating.php?order_id="+orderId+"&&givenStars="+ratingStars;
        }

        window.onload = function(){
            <?php
                if(isset($_REQUEST['order_history'])){
            ?>
                    $("#orders-tab").click();
            <?php        
                }else if(isset($_REQUEST['pwd'])){
            ?>
                    var message = '<?php echo $_REQUEST['pwd']?>';
                    $("#changepassword-tab").click();
                    if(message == "mismatched"){
                        alert('New and Confirm Password should be same!. Please try again.');
                    }else if(message == 'incorrectOld'){
                        alert('You entered Incorrect Old Password. Please try again.');
                    }else if(message == 'changed'){
                        alert('Password Changed Successfult. Click Ok for Logout and Login again Process!...');
                        window.location.href = 'logout.php';
                    }
            <?php
                }else if(isset($_REQUEST['info'])){
            ?>
                    alert('Account Info Updated Successfully!');
            <?php
                }
            ?>
        }
    </script>
</body>

</html>