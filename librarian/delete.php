<?php
require_once '../db_conn.php';
//var_dump($_GET);
//$id = base64_decode($_GET['book_delete']);

if (isset($_GET['book_delete'])){
    //echo 'test';
    $id = base64_decode($_GET['book_delete']);
    //echo $id;

    $query = "DELETE FROM books WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if ($result){
        header('Location: manage_book.php');
        die();
    }
}

