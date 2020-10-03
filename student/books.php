<?php require_once 'header.php'; ?>
    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                <li><a href="books.php">Books</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row pt-md">
                                    <div class="form-group col-sm-9 col-lg-10">
                                                <span class="input-with-icon">
                                            <input type="text" class="form-control" name="search_everything" id="lefticon" placeholder="Search Books" required>
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                    <div class="form-group col-sm-3  col-lg-2 ">
                                        <button type="submit" name="search_book" class="btn btn-primary btn-block">Search Book</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['search_book'])) {
            $book_result = $_POST['search_everything']; ?>

            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-content">
                        <div class="row">

                            <?php
                            $search_query = "SELECT * FROM books WHERE book_name LIKE '%$book_result%' || book_author_name LIKE '%$book_result%'";
                            $result = mysqli_query($conn, $search_query);
                            $not_found = mysqli_num_rows($result);
                            if ($not_found > 0){
                                while ($search_book = mysqli_fetch_assoc($result)){
                                ?>

                                <div class="col-sm-3 col-md-2">
                                    <img style="width: 100%;height: 200px;" src="../images/books/<?= $search_book['book_image']; ?>" alt="">
                                    <p><?= ucwords($search_book['book_name']); ?></p>
                                    <span><b><?= ucwords($search_book['book_author_name']); ?></b></span>
                                    <br>
                                    <span><b>Available ( <?= $search_book['available_qty']; ?> )</b></span>
                                </div>

                            <?php } ?>
                           <?php }else{?>
                                <div align="center">
                                    <img src="images3.jpg" alt="">
                                    <h2 style="color: red;"> <span style="color: #1b6d85"><?= $book_result; ?></span> Books Not Found !</h2>
                                </div>
                           <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
       <?php }else{?>

            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-content">
                        <div class="row">

                            <?php
                            $search_query = "SELECT * FROM books";
                            $result = mysqli_query($conn, $search_query);
                            while ($search_book = mysqli_fetch_assoc($result)){
                                ?>

                                <div class="col-sm-3 col-md-2">
                                    <img style="width: 100%;height: 100px;" src="../images/books/<?= $search_book['book_image']; ?>" alt="">
                                    <p><?= ucwords($search_book['book_name']); ?></p>
                                    <span><b><?= ucwords($search_book['book_author_name']); ?></b></span>
                                    <br>
                                    <span><b>Available ( <?= $search_book['available_qty']; ?> )</b></span>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>



    </div>


<?php require_once 'footer.php'; ?>