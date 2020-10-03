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
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row animated fadeInUp">
                <div class="col-sm-12">
                    <div class="row">

                        <!--BOX Style 1-->
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="panel widgetbox wbox-1 bg-darker-1">
                                <a href="#">
                                    <div class="panel-content">
                                        <h1 class="title color-w"><i class="fa fa-globe"></i> Views </h1>
                                        <h4 class="subtitle color-lighter-1 text-center">
                                            <?php
                                            $filename = "counter.txt";
                                            $fp = fopen($filename, 'r');
                                            $counter = fread($fp, filesize($filename));
                                            fclose($fp);
                                            $counter = $counter + 1;
                                            echo '('.$counter.')';
                                            $fp = fopen($filename, 'w');
                                            fwrite($fp, $counter);
                                            fclose($fp);
                                            ?>
                                        </h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!--Total Books-->
                        <?php
                        $select_book = "SELECT * FROM books";
                        $data = mysqli_query($conn, $select_book);
                        $count_books = mysqli_num_rows($data);

                        //total book qty
                        $total_book_qty = "SELECT SUM(book_qty) as total FROM books";
                        $data_query = mysqli_query($conn, $total_book_qty);
                        $books_qty = mysqli_fetch_assoc($data_query);
                        //var_dump($books_qty);
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="panel widgetbox wbox-1 bg-darker-2 color-light">
                                <a href="manage_book.php">
                                    <div class="panel-content">
                                        <h1 class="title color-light-1"> <i class="fa fa-book"></i> <?= $count_books.' ('.$books_qty['total'].')';?> </h1>
                                        <h4 class="subtitle">Total Books</h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!--Total Books Available-->
                        <?php
                        $select_book = "SELECT * FROM books";
                        $data = mysqli_query($conn, $select_book);
                        $count_books = mysqli_num_rows($data);

                        //total book qty
                        $total_book_available_qty = "SELECT SUM(available_qty) as total_pis FROM books";
                        $data_query_available_qty = mysqli_query($conn, $total_book_available_qty);
                        $books_available_qty = mysqli_fetch_assoc($data_query_available_qty);
                        //var_dump($books_available_qty);
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="panel widgetbox wbox-1 bg-darker-2 color-light">
                                <a href="manage_book.php">
                                    <div class="panel-content">
                                        <h1 class="title color-light-1"> <i class="fa fa-book"></i> <?= $count_books.' ('.$books_available_qty['total_pis'].')';?> </h1>
                                        <h4 class="subtitle">Total Books Copy</h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!--Total Students-->
                        <?php
                        $query = "SELECT * FROM students";
                        $data = mysqli_query($conn, $query);
                        $total_students = mysqli_num_rows($data);
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="panel widgetbox wbox-3 bg-lighter-2 color-light">
                                <a href="students.php">
                                    <div class="panel-content">
                                        <h1 class="title color-darker-2"> <i class="fa fa-users"></i> <?= $total_students; ?> </h1>
                                        <h4 class="subtitle color-darker-1">Total Students</h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!--Total Librarian-->
                        <?php
                        $query = "SELECT * FROM librarian";
                        $data = mysqli_query($conn, $query);
                        $count_librarian = mysqli_num_rows($data);
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="panel widgetbox wbox-3 bg-success">
                                <a href="javascript:avoid(0);">
                                    <div class="panel-content">
                                        <h1 class="title color-darker-2"> <i class="fa fa-users"></i> <?= $count_librarian; ?> </h1>
                                        <h4 class="subtitle color-darker-1">Total Librarian</h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!--BOX Style 1-->
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="panel widgetbox wbox-3 bg-light color-darker-2">
                                <a href="#">
                                    <div class="panel-content">
                                        <h1 class="title"> Total </h1>
                                        <h4 class="subtitle">$14.550,00</h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


<?php require_once 'footer.php'; ?>