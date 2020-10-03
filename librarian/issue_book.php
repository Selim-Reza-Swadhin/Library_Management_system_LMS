<?php
//require_once 'header.php';
require_once 'header_mota.php';
?>

<?php
if (isset($_POST['issue_book'])){
    //var_dump($_POST);
    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];
    $book_issue_date = $_POST['book_issue_date'];

    $insert_query = "INSERT INTO issue_books(student_id,book_id,book_issue_date ) VALUES ('$student_id', '$book_id', '$book_issue_date')";
    $result = mysqli_query($conn, $insert_query);
    if($result){
        //increment, decrement book
        $decrement_book =  "UPDATE books
                        SET
                        available_qty = available_qty - 1
                        WHERE id='$book_id'";
        mysqli_query($conn, $decrement_book);
        ?>
        <script>
            alert("<?= ucwords($_SESSION['librarian_username']); ?> Book issue successfully!");
        </script>
   <?php }else {?>
    <script>
        alert("<?= ucwords($_SESSION['librarian_username']); ?> Book issue not successfully!");
    </script>
<?php }} ?>

            <!-- content HEADER -->
            <!-- ========================================================= -->
            <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                        <!--click add #-->
                        <!--<li><a href="#">Issue Book</a></li>-->
                        <!--click avoid #-->
                        <li><a href="javascript:avoid(0);">Issue Book</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row animated fadeInUp">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-inline" action="" method="post">
                                        <div class="form-group">

                                            <select class="form-control" name="student_id" id="">
                                                <?php
                                                $query = "SELECT * FROM students WHERE status='1'";
                                                $result = mysqli_query($conn, $query);
                                                while ($row = mysqli_fetch_assoc($result)){ ?>
                                                        <option value="<?= $row['id'];?>"><?= ucwords($row['fname'].' '.$row['lname']).' - (Roll = '.$row['roll'].' )';?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!--Search Option-->
                            <?php
                            if (isset($_POST['search'])){
                                //var_dump($_POST);
                                $student_id = $_POST['student_id'];
                                //echo $student_id;
                                $query = "SELECT * FROM students WHERE id='$student_id' AND status='1'";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                //var_dump($row);
                                ?>

                                <div class="panel">
                                    <div class="panel-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label for="email">Student Name</label>
                                                        <input type="text" name="student_id" class="form-control" id="email" value="<?= ucwords($row['fname'].' '.$row['lname']);?>" readonly>
                                                        <!--<input type="hidden" name="student_hidden_id" class="form-control" id="email" value="--><?//= $row['id'];?><!--">-->
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Student Hidden Id</label>
                                                        <input type="text" name="student_id" class="form-control" id="email" value="<?= $row['id'];?>" readonly>
                                                    </div>
                                                    <!--Select book from books table-->
                                                    <div class="form-group">
                                                        <label for="email">Book Name</label>
                                                        <select class="form-control" id="email" name="book_id" id="" readonly="">
                                                            <?php
                                                            $query = "SELECT * FROM books WHERE available_qty > 0";
                                                            $result = mysqli_query($conn, $query);
                                                            while ($rowbook = mysqli_fetch_assoc($result)){ ?>
                                                                <option value="<?= $rowbook['id'];?>"><?= ucwords($rowbook['book_name']);?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Today Book Issue Date</label>
                                                        <input type="text" name="book_issue_date" class="form-control" id="email" value="<?= date('d-m-Y h:i:s a');?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Student Username</label>
                                                        <input type="text" name="username" class="form-control" id="email" value="<?= ucwords($row['username']);?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="issue_book" class="btn btn-primary">Save issue book</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>


                        </div>
                    </div>
                </div>
            </div>


<?php require_once 'footer.php'; ?>