<?php
include("connection.php");
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}

if(isset($_REQUEST['logout'])){
    session_destroy();
    header("Location: admin_login.php");
    exit;
}

if(isset($_REQUEST['delete']) && isset($_REQUEST['book_id'])){
    $queryDEL = "DELETE FROM books WHERE id = '".$_REQUEST['book_id']."'";
    mysqli_query($con,$queryDEL);

    header("Location: admin_dashboard.php?deleted=Yes");
    exit;
}

if(isset($_REQUEST['order_id']) && isset($_REQUEST['status'])){
    $queryUpdate = "UPDATE orders SET status = '".$_REQUEST['status']."' WHERE id = '".$_REQUEST['order_id']."'";
    mysqli_query($con,$queryUpdate);

    header("Location: admin_dashboard.php?updated=Yes");
    exit;
}

if($_POST){
    $error = "";
    $target_dir = "assets/img/gallery/";
    $target_file = $target_dir . basename($_FILES["book_poster"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["book_poster"]["size"] > 500000) {
        $error = "Book Record is not created. Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg") {
        $error = "Book Record is not created. Sorry, only JPG files are allowed.";
        $uploadOk = 0;
    }
    
    //Get Max Id For Movie Poster Name 
    $sqlMax          = "SELECT MAX(id) as maxId FROM books"; //set up our query to fetch Max Row Id from db 
    $resultMax       = mysqli_query($con, $sqlMax); //store the result of our query into the $resultMAx

    $row = $resultMax->fetch_assoc();
    
    if(!empty($row['maxId'])){
        $row['maxId'] = $row['maxId']+1;
        $utarget_file = $target_dir . $row['maxId'] . "." . $imageFileType;
    }else{
        $utarget_file = $target_dir . "1." . $imageFileType;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["book_poster"]["tmp_name"], $utarget_file)) {
            
            $query = "INSERT INTO books (book_title,book_poster,book_genres_id,book_publishers_id,book_authors_id,featured,book_description,book_price,created) 
            VALUES('".$_POST['book_title']."', '".$utarget_file."', '".$_POST['book_genres_id']."', '".$_POST['book_publishers_id']."', '".$_POST['book_authors_id']."', '".$_POST['featured']."', '".$_POST['book_description']."', '".$_POST['book_price']."', '".date('Y-m-d H:i:s')."')";
            mysqli_query($con,$query);

            header('Location: admin_dashboard.php?info=changed');
            exit;

        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Dashboard</title>
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

        <main class="main-content">

      <!--== Start Page Header Area Wrapper ==-->
      <section class="page-header-area" style="padding-top: 60px; padding-bottom: 0px;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="page-header-content">
                                <h2 class="page-header-title">Admin Dashboard</h2>
                                <div><?php if(isset($error)){ echo $error; } ?></div>
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
                                                <button class="account-nav nav-link nav-link-100  active" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Add a Book</button>
                                                <button class="account-nav nav-link nav-link-100" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">Book List / Delete</button>
                                                <button class="account-nav nav-link nav-link-100" id="changepassword-tab" data-bs-toggle="tab" data-bs-target="#changepassword" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Orders</button>
                                                <button class="account-nav nav-link nav-link-100" onclick="window.location.href='admin_dashboard.php?logout=Yes'" type="button">Logout</button>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="nav-tabContent">
                                            <!-- ACCOUNT OVERVIEW -->
                                            <div class="tab-pane fade show active" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                                                <div class="myaccount-content">
                                                    <h3>Add New Book</h3>
                                                    <div class="account-details-form">
                                                        <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="info" />
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Book Title</label>
                                                                        <input type="text" id="book_title" name="book_title" placeholder="Book Title" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Select Book Poster</label>
                                                                        <input type="file" id="book_poster" name="book_poster" placeholder="Select Book Poster" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Select Book Genre</label>
                                                                <select required class="form-control" name="book_genres_id">
                                                                    <option value="">Please Select One</option>
                                                                    <?php
                                                                        $query = "select * from book_genres";
                                                                        $result = mysqli_query($con,$query);
                                                                        if($result && mysqli_num_rows($result) > 0){
                                                                    
                                                                            while($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['genre_name']; ?></option>
                                                                    <?php        
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Select Book Publisher</label>
                                                                <select required class="form-control" name="book_publishers_id">
                                                                    <option value="">Please Select One</option>
                                                                    <?php
                                                                        $query = "select * from book_publishers";
                                                                        $result = mysqli_query($con,$query);
                                                                        if($result && mysqli_num_rows($result) > 0){
                                                                    
                                                                            while($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['publisher_name']; ?></option>
                                                                    <?php        
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Select Book Author</label>
                                                                <select required class="form-control" name="book_authors_id">
                                                                    <option value="">Please Select One</option>
                                                                    <?php
                                                                        $query = "select * from book_authors";
                                                                        $result = mysqli_query($con,$query);
                                                                        if($result && mysqli_num_rows($result) > 0){
                                                                    
                                                                            while($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['author_name']; ?></option>
                                                                    <?php        
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Featured</label>
                                                                <select required class="form-control" name="featured">
                                                                    <option value="">Please Select One</option>                                                                    
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="single-input-item">
                                                                <label class="required">Book Description</label>
                                                                <input type="text" id="book_description" name="book_description" placeholder="Enter Book Description" required/>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label class="required">Book Price</label>
                                                                <input type="number" id="book_price" name="book_price" placeholder="Enter Book Price" required/>
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
                                                    <h3>All Books</h3>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Book Title</th>
                                                                    <th>Book Poster</th>
                                                                    <th>Price</th>
                                                                    <th>Created</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            <?php
                                                                $query = "select * from books";
                                                                $result = mysqli_query($con,$query);
                                                                if($result && mysqli_num_rows($result) > 0){
                                                            
                                                                    while($row = $result->fetch_assoc()) {
                                                            ?>
                                                                        <tr style="background:black;">
                                                                            <td><?php echo $row['book_title']; ?></td>
                                                                            <td><img src="<?php echo $row['book_poster']; ?>" width="50px" height="50px" /></td>
                                                                            <td><?php echo "$".$row['book_price']; ?></td>
                                                                            <td><?php echo $row['created']; ?></td>
                                                                            <td><a style="color:red;" href="admin_dashboard.php?delete=Yes&&book_id=<?php echo $row['id']; ?>">Delete</a></td>
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
                                                    <h3>All Orders</h3>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Order Id</th>
                                                                    <th>Customer Name</th>
                                                                    <th>Total Price</th>
                                                                    <th>Created</th>
                                                                    <th>Stats</th>
                                                                    <th>Update Stats</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            <?php
                                                                $query = "select * from orders";
                                                                $result = mysqli_query($con,$query);
                                                                if($result && mysqli_num_rows($result) > 0){
                                                            
                                                                    while($row = $result->fetch_assoc()) {
                                                                        $customerName = "";
                                                                        $queryN = "select * from users WHERE id = '".$row['customer_id']."'";
                                                                        $resultN = mysqli_query($con,$queryN);
                                                                        if($resultN && mysqli_num_rows($resultN) > 0){
                                                                    
                                                                            while($rowN = $resultN->fetch_assoc()) {
                                                                                $customerName = $rowN['user_name'];
                                                                            }
                                                                        }
                                                            ?>
                                                                        <tr style="background:black;">
                                                                            <td><?php echo $row['id']; ?></td>
                                                                            <td><?php echo $customerName; ?></td>
                                                                            <td><?php echo "$".$row['total_amount']; ?></td>
                                                                            <td><?php echo $row['created']; ?></td>
                                                                            
                                                                            <?php if($row['status'] == "Placed"){ ?>
                                                                                <td style="color:Blue !important;">Order Placed</td>
                                                                            <?php }else if($row['status'] == "Pending"){  ?>
                                                                                <td style="color:Pink !important;">Order Pending</td>
                                                                            <?php }else if($row['status'] == "Failure"){  ?>
                                                                                <td style="color:Red !important;">Order Failed</td>
                                                                            <?php }else if($row['status'] == "Completed"){  ?>
                                                                                <td style="color:Grenn !important;">Order Completed</td>
                                                                            <?php } ?>
                                                                            
                                                                            <td>
                                                                                <select id="status" name="status" onchange="updateStatus('<?php echo $row['id']; ?>', this.value);">
                                                                                    <option <?php if($row['status'] == "Placed"){ echo "selected"; } ?> value="Placed">Placed</option>
                                                                                    <option <?php if($row['status'] == "Pending"){ echo "selected"; } ?> value="Pending">Pending</option>
                                                                                    <option <?php if($row['status'] == "Failure"){ echo "selected"; } ?> value="Failure">Failure</option>
                                                                                    <option <?php if($row['status'] == "Completed"){ echo "selected"; } ?> value="Completed">Completed</option>
                                                                                </select>
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
        function updateStatus(orderId, value){
            window.location.href = "admin_dashboard.php?order_id=" + orderId + "&&status=" + value;
        }

        window.onload = function(){
            <?php
                if(isset($_REQUEST['deleted'])){
            ?>
                    alert('Selected Book Deleted Successfully!...');
                    $("#orders-tab").click();
            <?php        
                }else if(isset($_REQUEST['updated'])){
            ?>
                    alert('Order Status Updated Successfully!...');
                    $("#changepassword-tab").click();
            <?php
                }else if(isset($_REQUEST['info'])){
            ?>
                    $("#orders-tab").click();
            <?php
                }
            ?>
        }
    </script>
</body>

</html>