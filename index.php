<?php
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
    <!-- slider Area Start-->
    <div class="slider-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-active dot-style">
                        <!-- Single Slider -->
                        <div class="single-slider slider-height slider-bg1 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <span data-animation="fadeInUp" data-delay=".2s"></span>
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Browse Your<br>Desired Books</h1>
                                            <a href="#section-browse" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slider -->
                        <div class="single-slider slider-height slider-bg2 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <span data-animation="fadeInUp" data-delay=".2s"></span>
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Browse Your<br>Desired Books</h1>
                                            <a href="#section-browse" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slider -->
                        <div class="single-slider slider-height slider-bg3 d-flex align-items-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                        <div class="hero-caption text-center">
                                            <span data-animation="fadeInUp" data-delay=".2s"></span>
                                            <h1 data-animation="fadeInUp" data-delay=".4s">Browse Your<br>Desired Books</h1>
                                            <a href="#section-browse" class="btn hero-btn"  data-animation="bounceIn" data-delay=".8s">Browse Store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!-- Best Selling start -->
    <div class="best-selling">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2> Our Best Selling Books</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="selling-active">
                        
                        <?php
                        if($bestSellingBooks){
                            foreach($bestSellingBooks as $book){
                        ?>
                                <div class="properties pb-20">
                                    <div class="properties-card">
                                        <div class="properties-img">
                                            <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>" alt=""></a>
                                        </div>
                                        <div class="properties-caption">
                                        <h3><a href="book-details.php?book_id=<?php echo $book['id']; ?>"><?php echo $book['book_title']; ?></a></h3>
                                        <p>
                                        <?php 
                                            if($book_authors){
                                                foreach($book_authors as $author){
                                                    if($author['id'] == $book['book_authors_id']){
                                                        echo "By " . $author['author_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                        </p>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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

                                        <div class="properties-footer d-flex justify-content-between align-items-center">
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
                                            <div class="price">
                                                <span><?php echo "$" . $book['book_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php        
                            }
                        }
                        ?>

</div>
</div>
</div>
</div>
</div>
<!-- Best Selling End -->
<!--  services-area start-->
<div class="services-area2 top-padding">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-8">
                <div class="row">
                    <!-- tittle -->
                    <div class="col-xl-12">
                        <div class="section-tittle d-flex justify-content-between align-items-center mb-40">
                            <h2 class="mb-0">Featured This Week</h2>
                            <a href="#" class="browse-btn">View All</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="services-active">
                            <!-- Single -->
                            <?php
                            if($featuredBooksThisWeek){
                                foreach($featuredBooksThisWeek as $book){
                            ?>
                                <div class="single-services d-flex align-items-center">
                                    <div class="features-img">
                                        <img src="<?php echo $book['book_poster']; ?>" alt="">
                                    </div>
                                    <div class="features-caption">
                                        <img src="assets/img/icon/logo.svg" alt="">
                                        <h3><?php echo $book['book_title']; ?></h3>
                                        <p>
                                            <?php 
                                                if($book_authors){
                                                    foreach($book_authors as $author){
                                                        if($author['id'] == $book['book_authors_id']){
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                                echo $book['book_authors_id']; 
                                            ?>    
                                        </p>
                                        <div class="price">
                                            <span><?php echo "$" . $book['book_price']; ?></span>
                                        </div>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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
                                        <a href="book-details.php?book_id=<?php echo $book['id']; ?>" class="border-btn">View Details</a>
                                    </div>
                                </div>
                            <?php
                                }
                            }
                            ?>
                            <!-- Single -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-9">
                <!-- Google Addd -->
                <div class="google-add">
                    <img src="assets/img/gallery/ad1.jpg" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- services-area End-->
<!-- Latest-items Start -->
<section class="our-client section-padding best-selling">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-5 col-lg-5 col-md-12">
                <!-- Section Tittle -->
                <div class="section-tittle  mb-40">
                    <h2 id="section-browse">Latest Published Books</h2>
                </div> 
            </div>
            <div class="col-xl-7 col-lg-7 col-md-12">
                <div class="nav-button mb-40">
                    <!--Nav Button  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" href="#nav-one" role="tab" aria-controls="nav-one" aria-selected="true">All</a>
                            <a class="nav-link" id="nav-two-tab" data-bs-toggle="tab" href="#nav-two" role="tab" aria-controls="nav-two" aria-selected="false">History</a>
                            <a class="nav-link" id="nav-three-tab" data-bs-toggle="tab" href="#nav-three" role="tab" aria-controls="nav-three" aria-selected="false">Horror</a>
                            <a class="nav-link" id="nav-four-tab" data-bs-toggle="tab" href="#nav-four" role="tab" aria-controls="nav-four" aria-selected="false">Love</a>
                            <a class="nav-link" id="nav-five-tab" data-bs-toggle="tab" href="#nav-five" role="tab" aria-controls="nav-five" aria-selected="false">Science</a>
                            <a class="nav-link" id="nav-six-tab" data-bs-toggle="tab" href="#nav-six" role="tab" aria-controls="nav-six" aria-selected="false">Biography</a>
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
                    <?php
                    if($latestPublished_all){
                        foreach($latestPublished_all as $book){
                    ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>"</a>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3><a href="book-details.php?book_id=<?php echo $book['id']; ?>"><?php echo $book['book_title']; ?></a></h3>
                                        <p>
                                            <?php 
                                                if($book_authors){
                                                    foreach($book_authors as $author){
                                                        if($author['id'] == $book['book_authors_id']){
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                                echo $book['book_authors_id']; 
                                            ?>
                                        </p>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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

                                        <div class="properties-footer d-flex justify-content-between align-items-center">
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
                                            <div class="price">
                                                <span><?php echo "$" . $book['book_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                <!-- Tab 2 -->
                <div class="row">
                    
                    <?php
                    if($latestPublished_history){
                        foreach($latestPublished_history as $book){
                    ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>"</a>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3><a href="book-details.php?book_id=<?php echo $book['id']; ?>"><?php echo $book['book_title']; ?></a></h3>
                                        <p>
                                            <?php 
                                                if($book_authors){
                                                    foreach($book_authors as $author){
                                                        if($author['id'] == $book['book_authors_id']){
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                                echo $book['book_authors_id']; 
                                            ?>
                                        </p>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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

                                        <div class="properties-footer d-flex justify-content-between align-items-center">
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
                                            <div class="price">
                                                <span><?php echo "$" . $book['book_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>
            <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                <!-- Tab 3 -->
                <div class="row">
                    
                    <?php
                    if($latestPublished_horror){
                        foreach($latestPublished_horror as $book){
                    ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>"</a>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3><a href="book-details.php?book_id=<?php echo $book['id']; ?>"><?php echo $book['book_title']; ?></a></h3>
                                        <p>
                                            <?php 
                                                if($book_authors){
                                                    foreach($book_authors as $author){
                                                        if($author['id'] == $book['book_authors_id']){
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                                echo $book['book_authors_id']; 
                                            ?>
                                        </p>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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

                                        <div class="properties-footer d-flex justify-content-between align-items-center">
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
                                            <div class="price">
                                                <span><?php echo "$" . $book['book_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>
            <div class="tab-pane fade" id="nav-four" role="tabpanel" aria-labelledby="nav-four-tab">
                <!-- Tab 4 -->
                <div class="row">
                    
                    <?php
                    if($latestPublished_love){
                        foreach($latestPublished_love as $book){
                    ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>"</a>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3><a href="book-details.php?book_id=<?php echo $book['id']; ?>"><?php echo $book['book_title']; ?></a></h3>
                                        <p>
                                            <?php 
                                                if($book_authors){
                                                    foreach($book_authors as $author){
                                                        if($author['id'] == $book['book_authors_id']){
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                                echo $book['book_authors_id']; 
                                            ?>
                                        </p>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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

                                        <div class="properties-footer d-flex justify-content-between align-items-center">
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
                                            <div class="price">
                                                <span><?php echo "$" . $book['book_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="tab-pane fade" id="nav-five" role="tabpanel" aria-labelledby="nav-five-tab">
                <!-- Tab 5 -->
                <div class="row">
                    
                    <?php
                    if($latestPublished_science){
                        foreach($latestPublished_science as $book){
                    ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>"</a>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3><a href="book-details.php?book_id=<?php echo $book['id']; ?>"><?php echo $book['book_title']; ?></a></h3>
                                        <p>
                                            <?php 
                                                if($book_authors){
                                                    foreach($book_authors as $author){
                                                        if($author['id'] == $book['book_authors_id']){
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                                echo $book['book_authors_id']; 
                                            ?>
                                        </p>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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


                                        <div class="properties-footer d-flex justify-content-between align-items-center">
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
                                            <div class="price">
                                                <span><?php echo "$" . $book['book_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>

            <div class="tab-pane fade" id="nav-six" role="tabpanel" aria-labelledby="nav-six-tab">
                <!-- Tab 6 -->
                <div class="row">
                    
                    <?php
                    if($latestPublished_bio){
                        foreach($latestPublished_bio as $book){
                    ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="properties pb-30">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>"</a>
                                    </div>
                                    <div class="properties-caption properties-caption2">
                                        <h3><a href="book-details.php?book_id=<?php echo $book['id']; ?>"><?php echo $book['book_title']; ?></a></h3>
                                        <p>
                                            <?php 
                                                if($book_authors){
                                                    foreach($book_authors as $author){
                                                        if($author['id'] == $book['book_authors_id']){
                                                            echo $author['author_name'];
                                                        }
                                                    }
                                                }
                                                echo $book['book_authors_id']; 
                                            ?>
                                        </p>

                                        <?php
                                        $query1 = "select * from books_rating WHERE book_id = '".$book['id']."'";
                                                                            
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
                                        
                                        <div class="properties-footer d-flex justify-content-between align-items-center">
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
                                            <div class="price">
                                                <span><?php echo "$" . $book['book_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="more-btn text-center mt-15">
                    <a href="#" class="border-btn border-btn2 more-btn2">Browse More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest-items End -->

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