<?php
if($_POST){
    session_start();

    if(isset($_POST['shippingAdd'])){
        $_SESSION['shipping'] = $_POST['shipping'];
    }else{
        foreach($_POST as $key => $quantity){
            $book_key = explode("_", $key);

            if($quantity == 0){
                unset($_SESSION['books_cart'][$book_key[1]]);
            }else{
                if (array_key_exists($book_key[1], $_SESSION['books_cart'])) {
                    $_SESSION['books_cart'][$book_key[1]]['book_quantity'] = $quantity;
                    $total_price = $_SESSION['books_cart'][$book_key[1]]['book_quantity'] * $_SESSION['books_cart'][$book_key[1]]['book_price'];
                
                    $_SESSION['books_cart'][$book_key[1]]['total_price'] = $total_price;
                }
            }
        }
    }

    header('Location: cart.php');
    die();
}

include("php_header.php");
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
    <!--area Start-->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slider-area">
                    <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                        <div class="hero-caption hero-caption2">
                            <h2>Cart</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!--area End -->
    <!--================Cart Area =================-->
    <section class="cart_area section-padding">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php

                            $sub_total = 0;
                            if(isset($_SESSION['books_cart'])){
                                foreach($_SESSION['books_cart'] as $cartItem){
                                    //echo '<pre>';print_r($cartItem);exit;
                            ?>
                            <form action="cart.php" method="post">
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="<?php echo $cartItem['book_poster']; ?>" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <p><?php echo $cartItem['book_title']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?php echo "$".$cartItem['book_price']; ?></h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <!--<span class="input-number-decrement"> <i class="ti-minus"></i></span>-->
                                        <input id="<?php echo "row_".$cartItem['book_id']; ?>" name="<?php echo "row_".$cartItem['book_id']; ?>" class="input-number" type="number" min="0" max="10" value="<?php echo $cartItem['book_quantity']; ?>">
                                        <!--<span class="input-number-increment"> <i class="ti-plus"></i></span>-->
                                    </div>
                                </td>
                                <td>
                                    <h5><?php echo "$".$cartItem['total_price']; ?></h5>
                                </td>
                            </tr>
                            
                            <?php
                                $sub_total = $sub_total + $cartItem['total_price'];
                                }
                            }
                            ?>

                            <tr class="bottom_button">
                                <td>
                                    <button class="btn" type="submit">Update Cart</button>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="cupon_text float-right">
                                        <a class="btn" href="#">Close Coupon</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5><?php echo "$".$sub_total; ?></h5>
                                </td>
                            </tr>
                            </form>
                            <form action="cart.php?shipping=YES" method="post">
                                <input type="hidden" name="shippingAdd" value="1" />
                            <tr class="shipping_area">
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>
                                    <div class="shipping_box">
                                        <ul class="list">
                                            <li>
                                                Flat Rate: $5.00
                                                <input <?php if(isset($_SESSION['shipping']) && $_SESSION['shipping'] == "5.00"){ echo "checked";  } ?> name="shipping" value="5.00" type="radio" aria-label="Radio button for following text input">
                                            </li>
                                            <li>
                                                Free Shipping
                                                <input <?php if(isset($_SESSION['shipping']) && $_SESSION['shipping'] == "0.00"){ echo "checked";  } ?> name="shipping" value="0.00" type="radio" aria-label="Radio button for following text input">
                                            </li>
                                            <li>
                                                Flat Rate: $10.00
                                                <input <?php if(isset($_SESSION['shipping']) && $_SESSION['shipping'] == "10.00"){ echo "checked";  } ?> name="shipping" value="10.00" type="radio" aria-label="Radio button for following text input">
                                            </li>
                                            <li class="active">
                                                Local Delivery: $2.00
                                                <input <?php if(isset($_SESSION['shipping']) && $_SESSION['shipping'] == "2.00"){ echo "checked";  } ?> name="shipping" value="2.00" type="radio" aria-label="Radio button for following text input">
                                            </li>
                                        </ul>
                                        <h6>
                                            Calculate Shipping
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </h6>
                                        <select class="shipping_select">
                                            <option value="1">Bangladesh</option>
                                            <option value="2">India</option>
                                            <option value="4">Pakistan</option>
                                        </select>
                                        <select class="shipping_select section_bg">
                                            <option value="1">Select a State</option>
                                            <option value="2">Select a State</option>
                                            <option value="4">Select a State</option>
                                        </select>
                                        <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                                        <button type="submit" class="btn">Update Details</button>
                                    </div>
                                </td>
                            </tr>
                            </form>
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn" href="index.php">Continue Shopping</a>
                        <a class="btn checkout_btn" href="checkout.php">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
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