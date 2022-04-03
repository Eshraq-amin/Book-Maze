<style>
    #cartItems{
        position:absolute;content:"0";width:24px;height:24px;background:#FF1616;color:#fff;line-height:24px;text-align:center;border-radius:30px;font-size:12px;top:-8px;right:-8px;-webkit-transition:all .3s ease-out 0s;-moz-transition:all .3s ease-out 0s;-ms-transition:all .3s ease-out 0s;-o-transition:all .3s ease-out 0s;transition:all .3s ease-out 0s;box-shadow:0 2px 5px rgba(0,0,0,0.3);
    }
</style>
<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<header>
        <div class="header-area">
         <div class="main-header ">
             <div class="header-top ">
                <div class="container">
                   <div class="row">
                    <div class="col-xl-12">
                        <div class="d-flex justify-content-between align-items-center flex-sm">
                            <div class="header-info-left d-flex align-items-center">
                                <!-- logo -->
                                <div class="logo">
                                    <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                                </div>
                                <!-- Search Box -->
                                <form id="search" action="categories.php" method="POST" class="form-box">
                                    <input type="text" name="author_publisher" placeholder="Search book by name, author or publisher">
                                    <div class="search-icon">
                                        <i class="ti-search" onclick="proceed();"></i>
                                    </div>
                                </form>
                            </div>
                            <?php
                                $url_cart = 'cart.php';
                                $items = 0;
                                if(!isset($_SESSION['books_cart'])){
                                    $url_cart = 'cart.php';
                                }
                                if(isset($_SESSION['books_cart'])){
                                    $items = count($_SESSION['books_cart']);
                                }
                            ?>
                            <div class="header-info-right d-flex align-items-center">
                                <ul>                                   
                                
                                    <li class="shopping-card">
                                        <a href="<?php echo $url_cart; ?>"><img src="assets/img/icon/cart.svg" alt=""></a>
                                        <span id="cartItems">
                                            <?php echo $items; ?>
                                        </span>
                                    </li>

                                    <?php
                                    if(isset($_SESSION['email']))
                                    {
                                        echo "<li><a href=\"account.php\">My Account</a></li>";
                                    }else
                                    {
                                        echo "<li><a href=\"login.php\" class=\"btn header-btn sign_in-btn\">Sign in</a></li>";
                                    }


                                    

                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom  header-sticky">
         <div class="container">
             <div class="row align-items-center">
                <div class="col-xl-12">
                    <!-- logo 2 -->
                    <div class="logo2">
                        <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                    </div>
                    <!-- Main-menu -->
                    <div class="main-menu text-center d-none d-lg-block">
                        <nav>                                                
                            <ul id="navigation">    
                                <li><a href="index.php" class="navbar-buttons-index">Home</a></li>
                                <li><a href="categories.php" class="navbar-buttons-index">Categories</a></li>
                                <li><a href="about.php" class="navbar-buttons-index">About</a></li>
                                <li><a href="contact.php" class="navbar-buttons-index">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div> 
                <!-- Mobile Menu -->
                <div class="col-xl-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>                         
    </div>
</div>

<script type="text/javascript">
    function proceed(){
        document.getElementById("search").submit();
    }
</script>

</div>
</header>