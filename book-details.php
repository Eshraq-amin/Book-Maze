<?php

if($_POST){
    session_start();
    //unset($_SESSION['books_cart']);
    if(!isset($_SESSION['books_cart'])){
        $_SESSION['books_cart'] = array();
    }

    if (array_key_exists($_POST['book_id'], $_SESSION['books_cart'])) {
        $_SESSION['books_cart'][$_POST['book_id']]['book_quantity'] = $_SESSION['books_cart'][$_POST['book_id']]['book_quantity']+1;
        $total_price = $_SESSION['books_cart'][$_POST['book_id']]['book_quantity'] * $_SESSION['books_cart'][$_POST['book_id']]['book_price'];
    
        $_SESSION['books_cart'][$_POST['book_id']]['total_price'] = $total_price;
    }else{
        $total_price = $_POST['book_price'] * 1;
        $_SESSION['books_cart'][$_POST['book_id']] = array('book_id'=>$_POST['book_id'], 'book_price'=>$_POST['book_price'],'book_quantity'=>1,'total_price'=>$total_price,'book_poster'=>$_POST['book_poster'],'book_title'=>$_POST['book_title']);
    }

    header('Location: cart.php');
    die();
    //echo '<pre>';print_r($_SESSION['books_cart']);exit;
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
    <!--  services-area start-->
    <div class="services-area2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Single -->
                            <div class="single-services d-flex align-items-center mb-0">
                                <div class="features-img">
                                    <img src="<?php echo $bookDetails['book_poster']; ?>" alt="">
                                </div>
                                <div class="features-caption">
                                    <h3><?php echo $bookDetails['book_title']; ?></h3>
                                    <p>
                                    <?php 
                                        if($book_authors){
                                            foreach($book_authors as $author){
                                                if($author['id'] == $bookDetails['book_authors_id']){
                                                    echo "By " . $author['author_name'];
                                                }
                                            }
                                        }
                                    ?>
                                    </p>
                                    <div class="price">
                                        <span><?php echo "$" . $bookDetails['book_price']; ?></span>
                                    </div>

                                    <?php
                                    $query1 = "select * from books_rating WHERE book_id = '".$bookDetails['id']."'";
                                                                        
                                    $result1 = mysqli_query($con,$query1);
                                    $rate = 0;
                                    $totalOrders = 0;
                                    $average = 0;
                                    if($result1 && mysqli_num_rows($result1) > 0){
                                        
                                        while($row1 = $result1->fetch_assoc()) {
                                            $rate = $rate + $row1['given_rating'];
                                            $totalOrders = $totalOrders+1;
                                        }

                                    }

                                    if($totalOrders > 0){
                                        $average = $rate / $totalOrders;
                                    }
                                    
                                    ?>
                                    
                                    <div class="review">
                                        <div class="rating">
                                            <?php
                                                for($i=1; $i<=5; $i++){
                                                    if($i <= $average){
                                            ?>
                                                        <i class="fas fa-star" style="color:goldenrod;"></i>          
                                            <?php
                                                    }else{
                                            ?>
                                                        <i class="fas fa-star"></i>
                                            <?php
                                                    }        
                                                }
                                            ?>
                                        </div>
                                        <p><?php echo "(" . $totalOrders . " Reviews)"; ?></p>
                                    </div>

                                    <form action="book-details.php" method="POST">
                                        <input type="hidden" name="book_id" value="<?php echo $bookDetails['id']; ?>" />
                                        <input type="hidden" name="book_price" value="<?php echo $bookDetails['book_price']; ?>" />
                                        <input type="hidden" name="book_poster" value="<?php echo $bookDetails['book_poster']; ?>" />
                                        <input type="hidden" name="book_title" value="<?php echo $bookDetails['book_title']; ?>" />
                                        <button class="white-btn mr-10">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services-area End-->
    <!--Books review Start -->
    <section class="our-client section-padding best-selling">
        <div class="container">
            <div class="row">
                <div class="offset-xl-1 col-xl-10">
                    <div class="nav-button f-left">
                        <!--Nav Button  -->
                        <nav>
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" href="#nav-one" role="tab" aria-controls="nav-one" aria-selected="true">Description</a>
                                <a class="nav-link" id="nav-two-tab" data-bs-toggle="tab" href="#nav-two" role="tab" aria-controls="nav-two" aria-selected="false">Author</a>
                            </div>
                        </nav>
                        <!--End Nav Button  -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                    <!-- Tab 1 -->  
                    <div class="row">
                        <div class="offset-xl-1 col-lg-9">
                            <p><?php echo $bookDetails['book_description']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                    <!-- Tab 2 -->
                    <div class="row">
                        <div class="offset-xl-1 col-lg-9">
                            <p>
                            <?php 
                                if($book_authors){
                                    foreach($book_authors as $author){
                                        if($author['id'] == $bookDetails['book_authors_id']){
                                            echo $author['author_description'];
                                        }
                                    }
                                }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                    <!-- Tab 3 -->
                    <div class="row">
                        <div class="offset-xl-1 col-lg-9">
                            <p>Beryl Cook is one of Britain’s most talented and amusing artists .Beryl’s pictures feature women of all shapes and sizes enjoying themselves .Born between the two world wars, Beryl Cook eventually left Kendrick School in Reading at the age of 15, where she went to secretarial school and then into an insurance office. After moving to London and then Hampton, she eventually married her next door neighbour from Reading, John Cook. He was an officer in the Merchant Navy and after he left the sea in 1956, they bought a pub for a year before John took a job in Southern Rhodesia with a motor company. Beryl bought their young son a box of watercolours, and when showing him how to use it, she decided that she herself quite enjoyed painting. John subsequently bought her a child’s painting set for her birthday and it was with this that she produced her first significant work, a half-length portrait of a dark-skinned lady with a vacant expression and large drooping breasts. It was aptly named ‘Hangover’ by Beryl’s husband and</p>

                            <p>It is often frustrating to attempt to plan meals that are designed for one. Despite this fact, we are seeing more and more recipe books and Internet websites that are dedicated to the act of cooking for one. Divorce and the death of spouses or grown children leaving for college are all reasons that someone accustomed to cooking for more than one would suddenly need to learn how to adjust all the cooking practices utilized before into a streamlined plan of cooking that is more efficient for one person creating less.</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-four" role="tabpanel" aria-labelledby="nav-four-tab">
                    <!-- Tab 4 -->
                    <div class="row">
                        <div class="offset-xl-1 col-lg-9">
                            <p>Beryl Cook is one of Britain’s most talented and amusing artists .Beryl’s pictures feature women of all shapes and sizes enjoying themselves .Born between the two world wars, Beryl Cook eventually left Kendrick School in Reading at the age of 15, where she went to secretarial school and then into an insurance office. After moving to London and then Hampton, she eventually married her next door neighbour from Reading, John Cook. He was an officer in the Merchant Navy and after he left the sea in 1956, they bought a pub for a year before John took a job in Southern Rhodesia with a motor company. Beryl bought their young son a box of watercolours, and when showing him how to use it, she decided that she herself quite enjoyed painting. John subsequently bought her a child’s painting set for her birthday and it was with this that she produced her first significant work, a half-length portrait of a dark-skinned lady with a vacant expression and large drooping breasts. It was aptly named ‘Hangover’ by Beryl’s husband and</p>

                            <p>It is often frustrating to attempt to plan meals that are designed for one. Despite this fact, we are seeing more and more recipe books and Internet websites that are dedicated to the act of cooking for one. Divorce and the death of spouses or grown children leaving for college are all reasons that someone accustomed to cooking for more than one would suddenly need to learn how to adjust all the cooking practices utilized before into a streamlined plan of cooking that is more efficient for one person creating less.</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-five" role="tabpanel" aria-labelledby="nav-five-tab">
                    <!-- Tab 5 -->
                    <div class="row">
                        <div class="offset-xl-1 col-lg-9">
                            <p>Beryl Cook is one of Britain’s most talented and amusing artists .Beryl’s pictures feature women of all shapes and sizes enjoying themselves .Born between the two world wars, Beryl Cook eventually left Kendrick School in Reading at the age of 15, where she went to secretarial school and then into an insurance office. After moving to London and then Hampton, she eventually married her next door neighbour from Reading, John Cook. He was an officer in the Merchant Navy and after he left the sea in 1956, they bought a pub for a year before John took a job in Southern Rhodesia with a motor company. Beryl bought their young son a box of watercolours, and when showing him how to use it, she decided that she herself quite enjoyed painting. John subsequently bought her a child’s painting set for her birthday and it was with this that she produced her first significant work, a half-length portrait of a dark-skinned lady with a vacant expression and large drooping breasts. It was aptly named ‘Hangover’ by Beryl’s husband and</p>

                            <p>It is often frustrating to attempt to plan meals that are designed for one. Despite this fact, we are seeing more and more recipe books and Internet websites that are dedicated to the act of cooking for one. Divorce and the death of spouses or grown children leaving for college are all reasons that someone accustomed to cooking for more than one would suddenly need to learn how to adjust all the cooking practices utilized before into a streamlined plan of cooking that is more efficient for one person creating less.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Books review End -->
    <!-- Subscribe Area Start -->
    
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