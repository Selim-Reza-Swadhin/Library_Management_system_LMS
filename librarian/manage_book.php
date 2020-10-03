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
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="../student/index.php">Dashboard</a></li>
                <li><a href="javascript:avoid(0);">Manage Books</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUpBig">
        <div class="col-sm-12">
            <h4 class="section-subtitle"><b>Manage Books</b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Id</th>
                                <th>Book Name</th>
                                <th>Book Image</th>
                                <th>Author Name</th>
                                <th>Publication Name</th>
                                <th>Purchase Date</th>
                                <th>Book Price</th>
                                <th>Book Quality</th>
                                <th>Available</th>
                                <th>Lib username</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $query = "SELECT * FROM books";
                            $result = mysqli_query($conn, $query);
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)){ $i++ ;?>

                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= ucwords($row['book_name']); ?></td>
                                    <td>
                                        <img width="45px" height="50px" src="../images/books/<?= $row['book_image']; ?>" alt="">
                                    </td>
                                    <td><?= $row['book_author_name']; ?></td>
                                    <td><?= $row['book_puplication_name']; ?></td>
                                    <td><?= date('d/M/Y', strtotime($row['book_purchase_date'])); ?></td>
                                    <td><?= $row['book_price']; ?></td>
                                    <td><?= $row['book_qty']; ?></td>
                                    <td><?= $row['available_qty']; ?></td>
                                    <td><?= ucwords($row['librarian_username']); ?></td>
                                    <td>
                                        <a class="btn btn-info" data-toggle="modal" data-target="#book_view-<?= $row['id'];?>" href="javascript:avoid(0);"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-warning" data-toggle="modal" data-target="#book_update-<?= $row['id'];?>" href="javascript:avoid(0);"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" onclick="return confirm('<?= ucwords($_SESSION['librarian_username']); ?> Are you ready for deleted ?');" href="delete.php?book_delete=<?= base64_encode($row['id']); ?>"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    <td><?= date('d-m-Y h:i:s a', strtotime($row['date_time'])); ?></td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--VIEW modal-->
<!--    <button type="button" class="btn btn-wide btn-info" data-toggle="modal" data-target="#info-modal">Info</button>-->
    <!-- Modal -->
<?php
$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)){?>

    <div class="modal fade" id="book_view-<?= $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Info</h4>
                </div>
                <div class="modal-body">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered"
                           cellspacing="0" width="100%">

                        <tr>
                            <th>Book Id</th>
                            <td><?= $row['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Book Name</th>
                            <td><?= ucwords($row['book_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Book Image</th>
                            <td>
                                <img width="45px" height="50px" src="../images/books/<?= $row['book_image']; ?>" alt="">
                            </td>
                        </tr>

                        <tr>
                            <th>Publication Name</th>
                            <td><?= $row['book_puplication_name']; ?></td>
                        </tr>

                        <tr>
                            <th>Author Name</th>
                            <td><?= $row['book_author_name']; ?></td>
                        </tr>

                        <tr>
                            <th>Purchase Date</th>
                            <td><?= date('d/M/Y', strtotime($row['book_purchase_date'])); ?></td>

                        </tr>

                        <tr>
                            <th>Book Price</th>
                            <td><?= $row['book_price']; ?></td>
                        </tr>

                        <tr>
                            <th>Book Quality</th>
                            <td><?= $row['book_qty']; ?></td>
                        </tr>

                        <tr>
                            <th>Available</th>
                            <td><?= $row['available_qty']; ?></td>
                        </tr>

                        <tr>
                            <th>Lib username</th>
                            <td><?= ucwords($row['librarian_username']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


    <!--UPDATE modal-->
    <!--    <button type="button" class="btn btn-wide btn-info" data-toggle="modal" data-target="#info-modal">Info</button>-->
    <!-- Modal -->
<?php
$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    $book_id_query = "SELECT * FROM books WHERE id='$id'";
    $book_result = mysqli_query($conn, $book_id_query);
    $book_info = mysqli_fetch_assoc($book_result);
    ?>

    <div class="modal fade" id="book_update-<?= $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Update Info</h4>
                </div>
                <div class="modal-body">

                        <div class="panel">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

                                            <h5 class="mb-lg">Update Book</h5>
                                            
                                            <?php
                                            //var_dump($book_info);
                                            //var_dump($row);
                                            ?>

                                            <div class="form-group">
                                                <label for="book_name">Book Name</label>
                                                <input type="text" name="book_name" class="form-control" id="book_name" placeholder="Book Name" required value="<?= $book_info['book_name'];?>">
                                                <br>
                                                <input type="text" name="id" class="form-control" id="book_name" value="<?= $book_info['id'];?>">
                                            </div>
                                            <!--<div class="form-group">
                                                <label for="book_name">Book Pic</label>
                                                <input type="file" name="book_image" class="form-control" id="book_name" placeholder="Book Image" required value="<?/*= $book_info['id'];*/?>">
                                                <br>
                                                <img width="35px" height="40px" src="../images/books/<?/*= $book_info['book_image'];*/?>" alt="">
                                            </div>-->
                                            <div class="form-group">
                                                <label for="book_name">Book Author</label>
                                                <input type="text" name="book_author_name" class="form-control" id="book_name" placeholder="Book Author" required value="<?= $book_info['book_author_name'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Publication</label>
                                                <input type="text" name="book_puplication_name" class="form-control" id="book_name" placeholder="Book Publication Name" required value="<?= $book_info['book_puplication_name'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Purchase</label>
                                                <input type="date" name="book_purchase_date" class="form-control" id="book_name" placeholder="Book Purchase Date" required value="<?= $book_info['book_purchase_date'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Price</label>
                                                <input type="number" name="book_price" class="form-control" id="book_name" placeholder="Book Price" required value="<?= $book_info['book_price'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Qty</label>
                                                <input type="number" name="book_qty" class="form-control" id="book_name" placeholder="Book Qty" required value="<?= $book_info['book_qty'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Available Qty</label>
                                                <input type="number" name="available_qty" class="form-control" id="book_name" placeholder="Available Qty" required value="<?= $book_info['available_qty'];?>">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" name="book_update"><i class="fa fa-save"></i> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



    <!--UPDATE modal 2-->
    <!--    <button type="button" class="btn btn-wide btn-info" data-toggle="modal" data-target="#info-modal">Info</button>-->
    <!-- Modal -->
<?php
$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)){?>

    <div class="modal fade" id="book_update-<?= $row[''];?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Update Info</h4>
                </div>
                <div class="modal-body">

                        <div class="panel">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

                                            <h5 class="mb-lg">Update Book</h5>

                                            <?php
                                            //var_dump($book_info);
                                            //var_dump($row);
                                            ?>

                                            <div class="form-group">
                                                <label for="book_name">Book Name</label>
                                                <input type="text" name="book_name" class="form-control" id="book_name" placeholder="Book Name" required value="<?= $row['book_name'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Pic</label>
                                                <input type="file" name="book_image" class="form-control" id="book_name" placeholder="Book Image" required value="<?= $row['id'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Author</label>
                                                <input type="text" name="book_author_name" class="form-control" id="book_name" placeholder="Book Author" required value="<?= $row['book_author_name'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Publication</label>
                                                <input type="text" name="book_puplication_name" class="form-control" id="book_name" placeholder="Book Publication Name" required value="<?= $row['book_puplication_name'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Purchase</label>
                                                <input type="date" name="book_purchase_date" class="form-control" id="book_name" placeholder="Book Purchase Date" required value="<?= $row['book_purchase_date'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Price</label>
                                                <input type="number" name="book_price" class="form-control" id="book_name" placeholder="Book Price" required value="<?= $row['book_price'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Book Qty</label>
                                                <input type="number" name="book_qty" class="form-control" id="book_name" placeholder="Book Qty" required value="<?= $row['book_qty'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="book_name">Available Qty</label>
                                                <input type="number" name="available_qty" class="form-control" id="book_name" placeholder="Available Qty" required value="<?= $row['available_qty'];?>">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" name="book_update"><i class="fa fa-save"></i> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!--Book Update Query-->

<?php
if (isset($_POST['book_update'])){
    //var_dump($_FILES);
    //var_dump($_POST);
    $book_update_id = $_POST['id'];//get hidden id
    $book_name = $_POST['book_name'];
    $book_author_name = $_POST['book_author_name'];
    $book_puplication_name = $_POST['book_puplication_name'];
    $book_purchase_date = $_POST['book_purchase_date'];
    $book_price = $_POST['book_price'];
    $book_qty = $_POST['book_qty'];
    $available_qty = $_POST['available_qty'];
    $librarian_username = $_SESSION['librarian_username'];//login.php

    //image validation
    //$image = explode('.', $_FILES['book_image']['name']);
    //$image_ext = end($image);
    //$image_name = date('Ymdhis').'.'.$image_ext;//add dot
    //$book_image_name = date('Ymdhis.').$image_ext;//add dot
    //$book_image_name = date('Y-M-D-h-i-s.').$image_ext;//add dot
    //echo $book_image_name;



   $query_update = "UPDATE books
                    SET
                    book_name='$book_name',
                    book_author_name='$book_author_name',
                    book_puplication_name='$book_puplication_name',
                    book_purchase_date='$book_purchase_date',
                    book_price='$book_price',
                    book_qty='$book_qty',
                    available_qty='$available_qty',
                    librarian_username='$librarian_username'
                    WHERE id='$book_update_id'
                    ";
    $result = mysqli_query($conn, $query_update);
    if($result){?>
        <script>
            //alert("<?//= ucwords($_SESSION['librarian_username']); ?> Book update successfully!");
            javascript:history.go(-1);//refresh or return before page
        </script>
    <?php }else {?>
        <script>
            alert("<?= ucwords($_SESSION['librarian_username']); ?> Book update not successfully!");
        </script>
    <?php }} ?>

<!--    if ($result){
        move_uploaded_file($_FILES['book_image']['tmp_name'], '../images/books/'.$book_image_name);
        $success= "$librarian_username Data Update successfully.";
        header('Location: manage_book.php');
        exit();
    }-->


<?php require_once 'footer.php'; ?>