<?php
//require_once 'header.php';
require_once 'header_mota.php';
?>
    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                <!--click add #-->
                <!--<li><a href="#">Students</a></li>-->
                <!--click avoid #-->
                <li><a href="javascript:avoid(0);">Return Books</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <h4 class="section-subtitle"><b>Return Books</b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <!--students table-->
                                <th>Name</th>
                                <th>Roll</th>
                                <th>Phone</th>
                                <!--books table-->
                                <th>Book Name</th>
                                <th>Book Image</th>
                                <!--issue_books table-->
                                <th>Book Issue Date</th>
                                <th>Return Book</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $inner_join_three_table_query = "SELECT issue_books.id, issue_books.book_id, issue_books.book_issue_date, students.fname, students.lname, students.roll, students.phone, books.book_name, book_image
                                                             FROM issue_books
                                                             INNER JOIN students
                                                             ON students.id = issue_books.student_id
                                                             INNER JOIN books
                                                             ON books.id = issue_books.book_id
                                                             WHERE issue_books.book_return_date=''";
                            $result = mysqli_query($conn, $inner_join_three_table_query);
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)){ $i++ ;?>

                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= ucwords($row['fname'].' '. $row['lname']); ?></td>
                                    <td><?= $row['roll']; ?></td>
                                    <td><?= $row['phone']; ?></td>
                                    <td><?= ucwords($row['book_name']); ?></td>
                                    <td>
                                        <img width="40px" height="45px" src="../images/books/<?= $row['book_image']; ?>" alt="">
                                    </td>
                                    <td><?= date('Y-m-d h:i:s a', strtotime($row['book_issue_date'])); ?></td>
                                    <td>
                                        <a href="return_book.php?return_book_id=<?= base64_encode($row['id']); ?>&return_book_id2=<?= base64_encode($row['book_id']); ?>">Return Book</a>
                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
if (isset($_GET['return_book_id']) && isset($_GET['return_book_id2'])){
    //var_dump($_GET);
    $return_book_id = base64_decode($_GET['return_book_id']);//from issue_books.id
    $return_book_id2 = base64_decode($_GET['return_book_id2']);//from issue_books.book_id
    $book_return_date = date('d-m-Y h:i:s a');
    $return_book_query = "UPDATE issue_books
                          SET
                          book_return_date = '$book_return_date'
                          WHERE id='$return_book_id'
                          ";
    $result = mysqli_query($conn, $return_book_query);
    if($result){
        //increment, decrement book
        $increment_book ="UPDATE books
                          SET
                          available_qty = available_qty + 1
                          WHERE id='$return_book_id2'";
        mysqli_query($conn, $increment_book);
        ?>
        <script>
            //alert("<?//= ucwords($_SESSION['librarian_username']); ?> Issue Book return successfully!");
            javascript:history.go(-1);//refresh or return before page
        </script>
    <?php }else {?>
        <script>
            alert("<?= ucwords($_SESSION['librarian_username']); ?> Issue Book return not successfully!");
        </script>
    <?php }} ?>


<?php require_once 'footer.php'; ?>