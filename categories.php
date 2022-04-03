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
    <!-- area Start-->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slider-area">
                    <div class="slider-height2 slider-bg4 d-flex align-items-center justify-content-center">
                        <div class="hero-caption hero-caption2">
                            <h2>Book Category</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!--  area End -->
    <!-- listing Area Start -->
    <div class="listing-area pt-50 pb-50">
        <div class="container">
            <div class="row">
                <!--? Left content -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <!-- Category Listing start -->
                    <div class="category-listing mb-50">
                        <!-- single one -->
                        <div class="single-listing">
                            <!-- select-Categories  -->
                            <div class="select-Categories pb-30">
                                <div class="small-tittle mb-20">
                                    <h4>Filter by Genres</h4>
                                </div>

                                <?php
                                    if($book_genres){
                                        foreach($book_genres as $genre){
                                            $selected = array();
                                            if(!empty($_POST['genres'])){
                                                $selected = explode(",", $_POST['genres']);
                                            }
                                ?>
                                            <label class="container">
                                                <?php echo $genre['genre_name']; ?>
                                                <input id="checkbox_g_<?php echo $genre['id']; ?>" <?php if(in_array($genre['id'], $selected)){ echo "checked"; } ?> onclick="executeSearch(this.id, this.value);" type="checkbox" value="<?php echo $genre['id']; ?>" />
                                                <span class="checkmark"></span>
                                            </label>
                                <?php
                                        }
                                    }
                                ?>

                            </div>
                            <!-- select-Categories End -->

                            <!-- Range Slider Start -->
                            <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow mb-40">
                                <div class="small-tittle">
                                    <h4>Filter by Price</h4>
                                </div>
                                <div class="widgets_inner">
                                    <div class="range_item">
                                        <input onchange="executeSearchPrice(this.value);" type="text" class="js-range-slider" value="112,250" />
                                        <div class="d-flex align-items-center">

                                            <div class="price_value d-flex justify-content-center">
                                                <input type="text" class="js-input-from" readonly />
                                                <span>to</span>
                                                <input type="text" class="js-input-to" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <!-- range end -->

                            <!-- Select items start -->
                            <div class="select-job-items2 mb-30">
                                <div class="col-xl-12">
                                    <select name="select2" onchange="executeSearchRated(this.value)">
                                        <option value="">Filter by Rating</option>
                                        <option value="5" <?php if(isset($_POST['rated']) && $_POST['rated'] == "5"){ echo "selected"; }?> >5 Star Rating</option>
                                        <option value="4" <?php if(isset($_POST['rated']) && $_POST['rated'] == "4"){ echo "selected"; }?>>4 Star Rating</option>
                                        <option value="3" <?php if(isset($_POST['rated']) && $_POST['rated'] == "3"){ echo "selected"; }?>>3 Star Rating</option>
                                        <option value="2" <?php if(isset($_POST['rated']) && $_POST['rated'] == "2"){ echo "selected"; }?>>2 Star Rating</option>
                                        <option value="1" <?php if(isset($_POST['rated']) && $_POST['rated'] == "1"){ echo "selected"; }?>>1 Star Rating</option>
                                    </select>
                                </div>
                            </div>
                            <!--  Select items End-->

                            <!-- select-Categories start -->
                            <div class="select-Categories pt-100 pb-60">
                                <div class="small-tittle mb-20">
                                    <h4>Filter by Publisher</h4>
                                </div>
                                
                                <?php
                                    if($book_publishers){
                                        foreach($book_publishers as $publisher){
                                            $selectedP = array();
                                            if(!empty($_POST['publisher'])){
                                                $selectedP = explode(",", $_POST['publisher']);
                                            }
                                ?>
                                            <label class="container">
                                                <?php echo $publisher['publisher_name']; ?>
                                                <input id="checkbox_p_<?php echo $publisher['id']; ?>" <?php if(in_array($publisher['id'], $selectedP)){ echo "checked"; } ?> onclick="executeSearchP(this.id, this.value);" type="checkbox" value="<?php echo $publisher['id']; ?>" />
                                                <span class="checkmark"></span>
                                            </label>
                                <?php
                                        }
                                    }
                                ?>

                            </div>
                            <!-- select-Categories End -->
                            <!-- select-Categories start -->
                            <div class="select-Categories">
                                <div class="small-tittle mb-20">
                                    <h4>Filter by Author Name</h4>
                                </div>
                                
                                <?php
                                    if($book_authors){
                                        foreach($book_authors as $author){
                                            $selectedA = array();
                                            if(!empty($_POST['author'])){
                                                $selectedA = explode(",", $_POST['author']);
                                            }
                                ?>
                                            <label class="container">
                                                <?php echo $author['author_name']; ?>
                                                <input id="checkbox_a_<?php echo $author['id']; ?>" <?php if(in_array($author['id'], $selectedA)){ echo "checked"; } ?> onclick="executeSearchA(this.id, this.value);" type="checkbox" value="<?php echo $author['id']; ?>" />
                                                <span class="checkmark"></span>
                                            </label>
                                <?php
                                        }
                                    }
                                ?>

                            </div>
                            <!-- select-Categories End -->
                        </div>
                    </div>
                    <!-- Category Listing End -->
                </div>
                <!--?  Right content -->
                <div class="col-xl-8 col-lg-8 col-md-6">
                    <div class="row justify-content-end">
                        <div class="col-xl-4">
                           <div class="product_page_tittle">
                            <div class="short_by">
                                <select name="#" id="product_short_list">
                                    <option>Browse by popularity</option>
                                    <option>Name</option>
                                    <option>NEW</option>
                                    <option>Old</option>
                                    <option>Price</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="best-selling p-0">
                    <div class="row">
                        
                        <?php
                            if($books){
                                foreach($books as $book){
                        ?>
                                    <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-12 col-sm-6">
                                        <div class="properties pb-30">
                                            <div class="properties-card">
                                                <div class="properties-img">
                                                    <a href="book-details.php?book_id=<?php echo $book['id']; ?>"><img src="<?php echo $book['book_poster']; ?>" alt=""></a>
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
                                                                        <i class="fas fa-star" style="color:black;"></i>
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
                            }else{
                        ?>
                                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-12 col-sm-6">
                                No Book Found as Per Selected Filters!
                                </div>
                        <?php        
                            }
                        ?>

                    </div>
                </div>
                <!-- button -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="more-btn text-center mt-15">
                            <a href="#" class="border-btn border-btn2 more-btn2">Browse More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="searchForm" action="categories.php" method="POST">
    <?php if(!empty($_POST['genres'])){ ?>
        <input type="hidden" id="genres" name="genres" value="<?php echo $_POST['genres']; ?>" />
    <?php }else{ ?>
        <input type="hidden" id="genres" name="genres" value="" />
    <?php } ?>

    <?php if(!empty($_POST['priceRange'])){ ?>
        <input type="hidden" id="priceRange" name="priceRange" value="<?php echo $_POST['priceRange']; ?>" />
    <?php }else{ ?>
        <input type="hidden" id="priceRange" name="priceRange" value="" />
    <?php } ?>

    <?php if(!empty($_POST['rated'])){ ?>
        <input type="hidden" id="rated" name="rated" value="<?php echo $_POST['rated']; ?>" />
    <?php }else{ ?>
        <input type="hidden" id="rated" name="rated" value="" />
    <?php } ?>

    <?php if(!empty($_POST['publisher'])){ ?>
        <input type="hidden" id="publisher" name="publisher" value="<?php echo $_POST['publisher']; ?>" />
    <?php }else{ ?>
        <input type="hidden" id="publisher" name="publisher" value="" />
    <?php } ?>

    <?php if(!empty($_POST['author'])){ ?>
        <input type="hidden" id="author" name="author" value="<?php echo $_POST['author']; ?>" />
    <?php }else{ ?>
        <input type="hidden" id="author" name="author" value="" />
    <?php } ?>
    
</form>

<script type="text/javascript">
    //For Genres
    function executeSearch(id, value){
        if($("#genres").val() != ""){

            var splitedGenre = $("#genres").val().split(",");
            
            if($.inArray($("#"+id).val(), splitedGenre) !== -1){
                splitedGenre = splitedGenre.filter(item => item !== $("#"+id).val());
                $("#genres").val( splitedGenre );
            }else{
                var appendVal = $("#genres").val() + "," + value;
                $("#genres").val( appendVal );
            }

        }else{
            $("#genres").val(value);
        }

        $("#searchForm").submit();

    }
    //For Price
    function executeSearchPrice(value){
        $("#priceRange").val(value);
        $("#searchForm").submit();
    }
    //For Rated
    function executeSearchRated(value){
        if(value != ""){
            $("#rated").val(value);
            $("#searchForm").submit();
        }
    }
    //For Publishers
    function executeSearchP(id, value){
        if($("#publisher").val() != ""){

            var splitedPublisher = $("#publisher").val().split(",");
            
            if($.inArray($("#"+id).val(), splitedPublisher) !== -1){
                splitedPublisher = splitedPublisher.filter(item => item !== $("#"+id).val());
                
                $("#publisher").val( splitedPublisher );
            }else{
                var appendVal = $("#publisher").val() + "," + value;
                $("#publisher").val( appendVal );
            }

        }else{
            $("#publisher").val(value);
        }

        $("#searchForm").submit();

    }
    //For Authors
    function executeSearchA(id, value){
        if($("#author").val() != ""){

            var splitedAuthor = $("#author").val().split(",");
            
            if($.inArray($("#"+id).val(), splitedAuthor) !== -1){
                splitedAuthor = splitedAuthor.filter(item => item !== $("#"+id).val());
                
                $("#author").val( splitedAuthor );
            }else{
                var appendVal = $("#author").val() + "," + value;
                $("#author").val( appendVal );
            }

        }else{
            $("#author").val(value);
        }

        $("#searchForm").submit();

    }

</script>
<!-- listing-area Area End -->

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