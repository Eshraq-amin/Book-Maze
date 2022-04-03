<?php
    include("connection.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_REQUEST['order_id']) && isset($_REQUEST['givenStars'])){

        $query = "select * from order_items WHERE order_id = '".$_REQUEST['order_id']."'";
        
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
    
            while($row = $result->fetch_assoc()) {

                $rating = "insert into books_rating (customer_id, order_id, book_id, given_rating, created) values ('".$_SESSION['loggedIn_User_Id']."', '".$_REQUEST['order_id']."', '".$row['item_id']."', '".$_REQUEST['givenStars']."', '".date('Y-m-d H:i:s')."')";
                mysqli_query($con, $rating);
            
            }

            header('Location: account.php?order_history=Yes');exit;

        }

    }else{
        header('Location: index.php');exit;
    }
?>