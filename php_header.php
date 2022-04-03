<?php
//session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$book_genres = get_genres($con);
$book_publishers = get_publishers($con);
$book_authors = get_authors($con);

$books = get_books($con);

$bestSellingBooks = get_books_best_selling($con);

$featuredBooksThisWeek = get_books_featured_this_week($con);

//Latest Published Last 3 Days against Each Genre
$latestPublished_all = get_books_latest_published($con, '');
$latestPublished_history = get_books_latest_published($con, 1);
$latestPublished_horror = get_books_latest_published($con, 2);
$latestPublished_love = get_books_latest_published($con, 3);
$latestPublished_science = get_books_latest_published($con, 4);
$latestPublished_bio = get_books_latest_published($con, 5);

//Detail Page Specific Book Details
if(isset($_REQUEST['book_id']) && !empty($_REQUEST['book_id'])){
    $bookDetails = get_book_by_id($con, $_REQUEST['book_id']);

    $bookDetails = $bookDetails[0];
}

//echo '<pre>';print_r($bookDetails);exit;
?>