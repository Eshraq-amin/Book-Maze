<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book Shop</title>
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
                                                <button class="nav-link active" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Account Overview</button>
                                                <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Order History</button>
                                                <button class="nav-link" id="changepassword-tab" data-bs-toggle="tab" data-bs-target="#changepassword" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Change Password</button>
                                                <button class="nav-link" id="payment-method-tab" data-bs-toggle="tab" data-bs-target="#payment-method" type="button" role="tab" aria-controls="address-edit" aria-selected="false">Payment Options  </button>
                                                <button class="nav-link" onclick="window.location.href='login.html'" type="button">Logout</button>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="nav-tabContent">
                                            <!-- ACCOUNT OVERVIEW -->
                                            <div class="tab-pane fade show active" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                                                <div class="myaccount-content">
                                                    <h3>Account Details</h3>
                                                    <div class="account-details-form">
                                                        <form action="#">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">First Name</label>
                                                                        <input type="text" id="first-name" placeholder="John"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Last Name</label>
                                                                        <input type="text" id="last-name" placeholder="Doe"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Display Name</label>
                                                                <input type="text" id="display-name" placeholder="John Doe"/>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="email" class="required">Email Address</label>
                                                                <input type="email" id="email" placeholder="Johndoe@gmail.com"/>
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label for="shipping-address" class="required"> Shipping Address</label>
                                                                <input type="text" id="shipping-address" placeholder="28185 Ridgecove Ct SRancho Palos Verdes, California"/>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <button class="check-btn sqr-btn">Save Changes</button>
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
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>12/01/2022</td>
                                                                    <td>Pending</td>
                                                                    <td>$1000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>13/01/2022</td>
                                                                    <td>Delivered</td>
                                                                    <td>$1500</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>19/01/2022</td>
                                                                    <td>Delivered</td>
                                                                    <td>$227</td>
                                                                </tr>
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
                                                        <form action="#">
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Current Password</label>
                                                                <input type="password" id="current-pwd" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">New Password</label>
                                                                        <input type="password" id="new-pwd" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Confirm Password</label>
                                                                        <input type="password" id="confirm-pwd" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <button class="check-btn sqr-btn">Save Changes</button>
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

            <!--== Start News Letter Area Wrapper ==-->
            <section class="news-letter-area section-bottom-space">
                <div class="container">
                    <div class="newsletter-content-wrap" data-bg-img="assets/img/blackbackground.jpeg">
                        <div class="newsletter-content">
                            <h2 class="title">Want to Connect with Us and Let Us Know Your Thoughts?</h2>
                            <p>Send Us What You Have in Mind!</p>
                            <div class="newsletter-form">
                                <form>
                                    <input type="email" class="form-control" placeholder="Email address">
                                    <button class="btn-submit" type="submit"><i class="fa fa-arrow-circle-right fa-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--== End News Letter Area Wrapper ==-->

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

</body>

</html>