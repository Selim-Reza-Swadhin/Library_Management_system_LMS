<?php
require_once '../db_conn.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print All Students</title>
    <style>
        body{
            margin: 0;
            font-family: Kalpurush;
        }
        .print-area{
            width: 755px;
            height: 1080px;
            margin: auto;
            box-sizing: border-box;
            page-break-after: always;
        }
        .header, .page-info{
            text-align: center;
        }
        .header h3{
            margin: 0;
        }
        .data-info{
        }
        .data-info table{
            width: 100%;
            border-collapse: collapse;}
        .data-info table th,
        .data-info table td{
            border: 1px solid #555;
            padding: 4px;
            line-height: 1em;
        }
    </style>
</head>
<body onload="window.print();">

<!-- Header Part
<div class="print-area">
    <div class="header">
        <h3>Smart Soft IT, Pabna.</h3>
        <h3>স্মার্ট সফট আইটি, পাবনা ।</h3>
    </div>
    <div class="data-info">
        <table>
            <tr>
                <th>SL No.</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Roll</th>
                <th>Reg No.</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>-->


<?php
$select_query = "SELECT * FROM students";
$result = mysqli_query($conn, $select_query);
$sl = 1;//start serial no. 1
$page = 1;//start page 1;
$per_page = 3;//per page print 25 data
$total = mysqli_num_rows($result);
//echo $total;
while ($row = mysqli_fetch_assoc($result)){
if ($sl % $per_page == 1){
    echo page_header();
}
    ?>
            <tr align="center">
                <td><?= $sl; ?></td>
                <td><?= ucwords($row['fname']); ?></td>
                <td><?= ucwords($row['lname']); ?></td>
                <td><?= $row['roll']; ?></td>
                <td><?= $row['reg_no']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= ucwords($row['username']); ?></td>
                <td><?= $row['phone']; ?></td>
            </tr>
<?php
    if ($sl % $per_page == 0 || $total == $per_page){
        echo page_footer($page++);
    }

    $sl++;
} ?>

<!-- Footer Part
        </table>
        <div class="page-info">Page :- 1</div>
    </div>
</div>-->
</body>
</html>

<?php
function page_header(){
    $data = '
<div class="print-area">
    <div class="header">
        <h3>Smart Soft IT, Pabna.</h3>
        <h3>স্মার্ট সফট আইটি, পাবনা ।</h3>
    </div>
    <div class="data-info">
        <table>
            <tr>
                <th>SL No.</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Roll</th>
                <th>Reg No.</th>
                <th>Email</th>
                <th>Username</th>
                <th>Phone</th>
            </tr>';
    return $data;
}
function page_footer($page){
    $data = '
        </table>
        <div class="page-info">Page :- '.$page.'</div>
    </div>
</div>';
    return $data;
}

?>
