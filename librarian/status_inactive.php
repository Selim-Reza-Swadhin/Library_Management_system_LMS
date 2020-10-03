<?php
require_once '../db_conn.php';

//print_r($_GET);

//$inactive_id = $_GET['inactive_id'];
//echo $inactive_id;

$inactive_id = base64_decode($_GET['inactive_id']);
//echo $inactive_id;

if (isset($inactive_id)){
    $query = "UPDATE students
              SET
              status = '0'
              WHERE id='$inactive_id'
              ";
    mysqli_query($conn, $query);
    header('Location: students.php?inactive=success');
}