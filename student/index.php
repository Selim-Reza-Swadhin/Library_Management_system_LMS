<?php require_once 'header.php'; ?>
            <!-- content HEADER -->
            <!-- ========================================================= -->
            <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <h4 class="section-subtitle"><b>All Issue Books</b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Book Name</th>
                                <th>Book Image</th>
                                <th>Book Issue Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            //var_dump($_SESSION);
                            //exit();

                            $students_idd = $_SESSION['students_iid'];//sign-in.php
                            $inner_join_query = "SELECT issue_books.book_issue_date, books.book_name, books.book_image
                                                 FROM books 
                                                 INNER JOIN issue_books
                                                 ON issue_books.book_id = books.id
                                                 WHERE issue_books.student_id='$students_idd'";
                            $result = mysqli_query($conn, $inner_join_query);
                            $i=0;
                            while ($row = mysqli_fetch_assoc($result)){
                                $i++;
                            //var_dump($row);
                            ?>

                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= ucwords($row['book_name']); ?></td>
                                    <td>
                                        <img width="35px" height="40px" src="../images/books/<?= $row['book_image']; ?>" alt="">
                                    </td>
                                    <td><?= $row['book_issue_date']; ?></td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php require_once 'footer.php'; ?>