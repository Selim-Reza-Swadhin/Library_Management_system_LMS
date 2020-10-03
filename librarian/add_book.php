<?php
//require_once 'header.php';
require_once 'header_mota.php';
?>

<?php

if (isset($_POST['save_book'])){
    //var_dump($_FILES);
    //var_dump($_POST);
    $book_name = $_POST['book_name'];
    $book_author_name = $_POST['book_author_name'];
    $book_puplication_name = $_POST['book_puplication_name'];
    $book_purchase_date = $_POST['book_purchase_date'];
    $book_price = $_POST['book_price'];
    $book_qty = $_POST['book_qty'];
    $available_qty = $_POST['available_qty'];
    $librarian_username = $_SESSION['librarian_username'];//login.php

    //image validation
    $image = explode('.', $_FILES['book_image']['name']);
    $image_ext = end($image);
    //$image_name = date('Ymdhis').'.'.$image_ext;//add dot
    $book_image_name = date('Ymdhis.').$image_ext;//add dot
    //$book_image_name = date('Y-M-D-h-i-s.').$image_ext;//add dot
    //echo $book_image_name;



   $query = "INSERT INTO books(book_name, book_image, book_author_name, book_puplication_name, book_purchase_date, book_price, book_qty, available_qty,librarian_username) VALUES ('$book_name','$book_image_name', '$book_author_name', '$book_puplication_name', '$book_purchase_date', '$book_price', '$book_qty', '$available_qty', '$librarian_username')";
    $result = mysqli_query($conn, $query);
    if (isset($result )){
        move_uploaded_file($_FILES['book_image']['tmp_name'], '../images/books/'.$book_image_name);
        $success= "$librarian_username Data Save successfully.";
    }else{
        $error = "$librarian_username Data not save.";
    }
}

?>



    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="../student/index.php">Dashboard</a></li>
                <li><a href="javascript:avoid(0);">Add Books</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInLeftBig">
        <div class="col-sm-6 col-sm-offset-3">
            <!-- Data added success message-->
            <?php
            if (isset($success)) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?= $success; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <!-- Data not added message-->
            <?php
            if (isset($error)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="panel">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                                <h5 class="mb-lg">Add Book</h5>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="book_name" class="form-control" id="book_name" placeholder="Book Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Book Pic</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="book_image" class="form-control" id="book_name" placeholder="Book Image" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Book Author</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="book_author_name" class="form-control" id="book_name" placeholder="Book Author" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Book Publication</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="book_puplication_name" class="form-control" id="book_name" placeholder="Book Publication Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Book Purchase</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="book_purchase_date" class="form-control" id="book_name" placeholder="Book Purchase Date" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Book Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="book_price" class="form-control" id="book_name" placeholder="Book Price" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Book Qty</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="book_qty" class="form-control" id="book_name" placeholder="Book Qty" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="book_name" class="col-sm-4 control-label">Available Qty</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="available_qty" class="form-control" id="book_name" placeholder="Available Qty" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" name="save_book" class="btn btn-primary"><i class="fa fa-save"></i> Save Book</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php require_once 'footer.php'; ?>