<?php

function check_login($con)
{

if(isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
    $query = "select * from users where email = '$email' limit 1";

    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0)
    {

        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
    }
}

function get_genres($con){
    $query = "select * from book_genres ORDER BY genre_name ASC";
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $book_genres = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $book_genres[$index]['id'] = $row['id'];
            $book_genres[$index]['genre_name'] = $row['genre_name'];

            $index = $index+1;
        }

        return $book_genres;
    }
}

function get_publishers($con){
    $query = "select * from book_publishers ORDER BY publisher_name ASC";
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $book_publishers = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $book_publishers[$index]['id'] = $row['id'];
            $book_publishers[$index]['publisher_name'] = $row['publisher_name'];

            $index = $index+1;
        }

        return $book_publishers;
    }
}

function get_authors($con){
    $query = "select * from book_authors ORDER BY author_name ASC";
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $book_authors = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $book_authors[$index]['id'] = $row['id'];
            $book_authors[$index]['author_name'] = $row['author_name'];
            $book_authors[$index]['author_description'] = $row['author_description'];

            $index = $index+1;
        }

        return $book_authors;
    }
}

function get_books($con){
    if(isset($_POST['author_publisher'])){
        $query_Authors = "SELECT * FROM book_authors WHERE author_name LIKE '".$_POST['author_publisher']."%'";
        $resultAuthors = mysqli_query($con,$query_Authors);
        if($resultAuthors && mysqli_num_rows($resultAuthors) > 0){
            $authors = array();
            while($row = $resultAuthors->fetch_assoc()) {
                $authors[] = $row['id'];
            }
        }

        $query_Publishers = "SELECT * FROM book_publishers WHERE publisher_name LIKE '".$_POST['author_publisher']."%'";
        $resultPublishers = mysqli_query($con,$query_Publishers);
        if($resultPublishers && mysqli_num_rows($resultPublishers) > 0){
            $publishers = array();
            while($row = $resultPublishers->fetch_assoc()) {
                $publishers[] = $row['id'];
            }
        }

        $query_Books = "SELECT * FROM books WHERE book_title LIKE '".$_POST['author_publisher']."%'";
        $resultBooks = mysqli_query($con,$query_Books);
        if($resultBooks && mysqli_num_rows($resultBooks) > 0){
            $books_list = array();
            while($row = $resultBooks->fetch_assoc()) {
                $books_list[] = $row['id'];
            }
        }

        $query = "select * from books";
        $checker = 0;
        if( isset($authors) ){
            $query .= " WHERE book_authors_id IN (". implode(",", $authors) .")";
            $checker = 1;
        }
        if( isset($publishers) ){
            if($checker == 1){
                $query .= " AND book_publishers_id IN (". implode(",", $publishers) .")";
            }else{
                $query .= " WHERE book_publishers_id IN (". implode(",", $publishers) .")";
            }
        }
        if( isset($books_list) ){
            if($checker == 1){
                $query .= " AND id IN (". implode(",", $books_list) .")";
            }else{
                $query .= " WHERE id IN (". implode(",", $books_list) .")";
            }
        }
        
        $query .= " ORDER BY book_title ASC";
        
    }else{
        $query = "select * from books";

        if($_POST){
            $isWhere = 0;
            if(!empty($_POST['genres'])){
                $query .= " WHERE book_genres_id IN (". implode(",", (array)$_POST['genres']) .")";
                $isWhere = 1;
            }

            if(!empty($_POST['publisher'])){
                if($isWhere == 0){
                    $query .= " WHERE book_publishers_id IN (". implode(",", (array)$_POST['publisher']) .")";
                    $isWhere = 1;
                }else{
                    $query .= " AND book_publishers_id IN (". implode(",", (array)$_POST['publisher']) .")";
                }    
            }

            if(!empty($_POST['author'])){
                if($isWhere == 0){
                    $query .= " WHERE book_authors_id IN (". implode(",", (array)$_POST['author']) .")";
                    $isWhere = 1;
                }else{
                    $query .= " AND book_authors_id IN (". implode(",", (array)$_POST['author']) .")";
                }    
            }
            if(!empty($_POST['priceRange'])){
                $explodePrice = explode(";", $_POST['priceRange']);
                $start = $explodePrice[0];
                $end = $explodePrice[1];
                if($isWhere == 0){
                    $query .= " WHERE book_price >= '".$start."' AND book_price <= '".$end."'";
                    $isWhere = 1;
                }else{
                    $query .= " AND book_price >= '".$start."' AND book_price <= '".$end."'";
                }
            }

        }
        $query .= " ORDER BY book_title ASC";
    }

    //echo '<pre>';print_r($_POST);
    //echo $query;
    
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $books = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $books[$index]['id'] = $row['id'];
            $books[$index]['book_title'] = $row['book_title'];
            $books[$index]['book_poster'] = $row['book_poster'];
            $books[$index]['book_authors_id'] = $row['book_authors_id'];
            $books[$index]['book_price'] = $row['book_price'];

            $index = $index+1;
        }

        if(!empty($_POST['rated'])){
            $queryRating = "select * from books_rating";
            $resultRating = mysqli_query($con,$queryRating);

            if($resultRating && mysqli_num_rows($resultRating) > 0){
                $allBooksRating = array();
                while($rowRating = $resultRating->fetch_assoc()) {
                    if (array_key_exists($rowRating['book_id'], $allBooksRating)) {
                        $allBooksRating[$rowRating['book_id']]['book_id'] = $rowRating['book_id'];
                        $allBooksRating[$rowRating['book_id']]['total_rating'] = $allBooksRating[$rowRating['book_id']]['total_rating']+$rowRating['given_rating'];
                        $allBooksRating[$rowRating['book_id']]['total_orders'] = $allBooksRating[$rowRating['book_id']]['total_orders']+1;
                        $allBooksRating[$rowRating['book_id']]['average_rating'] = $allBooksRating[$rowRating['book_id']]['total_rating'] / $allBooksRating[$rowRating['book_id']]['total_orders'];
                    }else{
                        $allBooksRating[$rowRating['book_id']]['book_id'] = $rowRating['book_id'];
                        $allBooksRating[$rowRating['book_id']]['total_rating'] = $rowRating['given_rating'];
                        $allBooksRating[$rowRating['book_id']]['total_orders'] = 1;
                        $allBooksRating[$rowRating['book_id']]['average_rating'] = $rowRating['given_rating'];
                    }
                }

            }

            $finalBooks = array();
            if($books){
                foreach($books as $item){
                    if (array_key_exists($item['id'], $allBooksRating)) {
                        if( $allBooksRating[$item['id']]['average_rating'] >= $_POST['rated'] ){
                            $finalBooks[] = $item;
                        }
                    }
                }
            }

            $books = array();
            $books = $finalBooks;

            //echo '<pre>';print_r($books);exit;
        }

        return $books;
    }
}

function get_book_by_id($con, $id){
    $query = "select * from books";

    if(!empty($id)){
        $query .= " WHERE id = '".$id."'";
    }

    //echo $query;
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $book = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $book[$index]['id'] = $row['id'];
            $book[$index]['book_title'] = $row['book_title'];
            $book[$index]['book_poster'] = $row['book_poster'];
            $book[$index]['book_authors_id'] = $row['book_authors_id'];
            $book[$index]['book_price'] = $row['book_price'];
            $book[$index]['book_description'] = $row['book_description'];

            $index = $index+1;
        }

        return $book;
    }
}

function get_books_best_selling($con){
    $query = "SELECT * FROM order_items";
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $books = array();
        while($row = $result->fetch_assoc()) {
            $books[] = $row['item_id'];
        }
    
    }

    $imploded_ids = implode(',',$books); 
    $query = "SELECT * FROM books WHERE id IN ($imploded_ids)";
    
    $query .= " ORDER BY book_title ASC";
    //echo $query;
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $bestSellingBooks = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $bestSellingBooks[$index]['id'] = $row['id'];
            $bestSellingBooks[$index]['book_title'] = $row['book_title'];
            $bestSellingBooks[$index]['book_poster'] = $row['book_poster'];
            $bestSellingBooks[$index]['book_authors_id'] = $row['book_authors_id'];
            $bestSellingBooks[$index]['book_price'] = $row['book_price'];

            $index = $index+1;
        }

        return $bestSellingBooks;
    }
}

function get_books_featured_this_week($con){
    $query = "SELECT * FROM books WHERE featured = 'Yes'";

    $query .= " ORDER BY book_title ASC";
    //echo $query;
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $featuredBooksThisWeek = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $featuredBooksThisWeek[$index]['id'] = $row['id'];
            $featuredBooksThisWeek[$index]['book_title'] = $row['book_title'];
            $featuredBooksThisWeek[$index]['book_poster'] = $row['book_poster'];
            $featuredBooksThisWeek[$index]['book_authors_id'] = $row['book_authors_id'];
            $featuredBooksThisWeek[$index]['book_price'] = $row['book_price'];

            $index = $index+1;
        }

        return $featuredBooksThisWeek;
    }
}

function get_books_latest_published($con, $genre_id){
    $query = "SELECT * FROM books";

    if($genre_id != ""){
        $query .= " WHERE book_genres_id = " . $genre_id;
    }

    $query .= " ORDER BY book_title ASC";
    //echo $query;
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){

        $books = array();
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $books[$index]['id'] = $row['id'];
            $books[$index]['book_title'] = $row['book_title'];
            $books[$index]['book_poster'] = $row['book_poster'];
            $books[$index]['book_authors_id'] = $row['book_authors_id'];
            $books[$index]['book_price'] = $row['book_price'];

            $index = $index+1;
        }

        return $books;
    }
}


}