<?php
include("php_header.php");

if(!isset($_SESSION)){
    session_start();
}

//echo '<pre>';print_r($_SESSION);exit;
if(!isset($_SESSION['books_cart'])){
    header('Location: index.php');
    exit;
}

if($_POST){
    //session_start();

    include("connection.php");

    if(!isset($_SESSION['loggedIn_User_Id'])){
    
        $user = "insert into users (user_name, email, password) values ('".$_POST['first_name'] . ' ' . $_POST['last_name']."', '".$_POST['email']."', '123')";
        mysqli_query($con, $user);

        $userId = $con->insert_id;
        
        $_SESSION['loggedIn_User_Id'] = $userId;
        $_SESSION['email'] = $_POST['email'];

        //Check Session against Cart and Update its User Id
        if(isset($_SESSION['books_cart'])){
            foreach($_SESSION['books_cart'] as $key => $cartItem){
                $_SESSION['books_cart'][$key]['user_id'] = $userId;
            }
        }

    }

    //Order Table Entry
    $order = "insert into orders (customer_id, total_amount, created, status) values ('".$_SESSION['loggedIn_User_Id']."', '".$_POST['final_amount']."', '".date('Y-m-d H:i:s')."', 'Placed')";
    mysqli_query($con, $order);

    $orderId = $con->insert_id;

    //Order Items Entries
    if(isset($_SESSION['books_cart'])){
        foreach($_SESSION['books_cart'] as $item){
            $orderItem = "insert into order_items (order_id, item_id, item_quantity) values ('".$orderId."', '".$item['book_id']."', '".$item['book_quantity']."')";
            mysqli_query($con, $orderItem);       
        }
    }
    
    //Deliveru Address Entry
    $orderAddress = "insert into users_delivery_address (user_id, order_id, first_name, last_name, company_name, phone, email, country, address_1, address_2, city, state, zip, payment_type, order_notes) 
    values ('".$orderId."', '".$_SESSION['loggedIn_User_Id']."', '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['company_name']."', '".$_POST['phone']."', '".$_POST['email']."', '".$_POST['country']."', '".$_POST['address_line_1']."', '".$_POST['address_line_2']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['zip']."', '".$_POST['payment']."', '".$_POST['order_notes']."')";
    mysqli_query($con, $orderAddress);

    unset($_SESSION['books_cart']);
    unset($_SESSION['shipping']);

    header('Location: account.php?order_history=Yes');exit;

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
    <?php include 'include/topnav.php'; ?>
<main>
    <!-- area Start-->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slider-area">
                    <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                        <div class="hero-caption hero-caption2">
                            <h2>Check Out</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!--area End -->

    <!--? Checkout Area Start-->
    <section class="checkout_area section-padding">
        <div class="container">
            
            <?php if(!isset($_SESSION['email'])){ ?>
            <div class="returning_customer">
                <div class="check_title">
                    <h2>
                        Returning Customer?

                        <a href="login.php">Click here to login</a>
                    </h2>
                </div>
                <p>
                    If you have shopped with us before, please enter your details in the
                    boxes below. If you are a new customer, please proceed to the
                    Billing & Shipping section.
                </p>
                <form class="row contact_form" action="login.php" method="post">
                    <div class="col-md-6 form-group p_star">
                        <input required="required" type="text" class="form-control" id="email" name="email" value="" placeholder="Username or Email" />
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input required="required" type="password" class="form-control" id="password" name="password" value="" placeholder="password" />
                    </div>
                    <div class="col-md-12 form-group d-flex flex-wrap">
                        <button type="submit" class="btn" >Log In</a>
                        
                    </div>
                </form>
            </div>
            <?php } ?>

            <div class="cupon_area">
                <div class="check_title">
                    <h2> Have a coupon?
                        <a href="#">Click here to enter your code</a>
                    </h2>
                </div>
                <input type="text" placeholder="Enter coupon code" />
                <a class="btn" href="#">Apply Coupon</a>
            </div>

            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="checkout.php" method="POST">
                            <div class="col-md-6 form-group p_star">
                                <input required type="text" class="form-control" id="first" name="first_name" placeholder="First Name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input required type="text" class="form-control" id="last" name="last_name" placeholder="Last Name" />
                            </div>
                            <div class="col-md-12 form-group">
                                <input required type="text" class="form-control" id="company" name="company_name" placeholder="Company Name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input required type="text" class="form-control" id="number" name="phone" placeholder="Phone" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input required type="email" class="form-control" id="email" name="email" placeholder="Email" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select required class="country_select" name="country">
                                    <option value="Pakistan">Pakistan</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input required type="text" class="form-control" id="add1" name="address_line_1" placeholder="Address Line 1" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="address_line_2" placeholder="Address Line 2" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input required type="text" class="form-control" id="city" name="city" placeholder="City" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select required class="country_select" name="state" placeholder="State">
                                    <option value="Punjab">Punjab</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <input required type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" />
                            </div>

                            <?php if(!isset($_SESSION['email'])){ ?>
                            <div class="col-md-12 form-group">
                                <div class="checkout-cap">
                                    <input type="checkbox" id="fruit1" name="keep-log">
                                    <label for="fruit1">Create an account?</label>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <div class="checkout-cap">
                                        <input type="checkbox" id="f-option3" name="selector" />
                                        <label for="f-option3">Ship to a different address?</label>
                                    </div>
                                </div>
                                <textarea class="form-control" name="order_notes" id="message" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Product<span>Total</span>
                                    </a>
                                </li>

                                <?php
                                if(isset($_SESSION['books_cart'])){
                                    $sub_total = 0;
                                    foreach($_SESSION['books_cart'] as $cartItem){
                                ?>
                                        <li>
                                            <a href="#"><?php echo $cartItem['book_title']; ?>
                                                <span class="middle">x <?php echo $cartItem['book_quantity']; ?></span>
                                                <span class="last"><?php echo "$".$cartItem['total_price']; ?></span>
                                            </a>
                                        </li>        
                                <?php
                                    $sub_total = $sub_total + $cartItem['total_price'];      
                                    }
                                }
                                ?>
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Subtotal <span><?php echo "$".$sub_total; ?></span></a>
                                </li>
                                <li>
                                    <a href="#">Shipping
                                        <span>Flat rate: <?php if(isset($_SESSION['shipping'])){ echo "$".$_SESSION['shipping']; }else{ echo "$50.00"; } ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Total<span>
                                        <?php
                                            $shipping = 50.00;
                                            if(isset($_SESSION['shipping'])){ 
                                                $shipping = $_SESSION['shipping'];
                                            }
                                            $afterShipping = $sub_total + $shipping;

                                            echo "$".$afterShipping;
                                        ?>

                                        <input type="hidden" name="final_amount" value="<?php echo $afterShipping; ?>" />
                                    </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="payment" value="check" required />
                                    <label for="f-option5">Check payments</label>
                                    <div class="check"></div>
                                </div>
                                <p> Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="payment" value="paypal" required />
                                    <label for="f-option6">Paypal </label>
                                    <img src="assets/img/gallery/card.jpg" alt="" />
                                    <div class="check"></div>
                                </div>
                                <p> Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                            </div>
                            <div class="creat_account checkout-cap">
                                <input type="checkbox" id="f-option8" name="selector" />
                                <label for="f-option8">I’ve read and accept the  <a href="#">terms & conditions*</a> </label>
                            </div>
                            <button class="btn w-100" type="submit">Place Order</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--End Checkout Area -->

</main>
<?php include 'include/footer.php'; ?>
<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

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