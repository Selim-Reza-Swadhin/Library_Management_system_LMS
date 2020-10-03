<?php
require_once '../db_conn.php';

//print_r($_GET);

//$active_id = $_GET['active_id'];
//echo $active_id;

$active_id = base64_decode($_GET['active_id']);
//echo $active_id;

if (isset($active_id)){
    $query = "UPDATE students
              SET
              status = '1'
              WHERE id='$active_id'
              ";
    mysqli_query($conn, $query);
    header('Location: students.php?active=success');
}
