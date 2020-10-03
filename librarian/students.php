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
                <li><a href="javascript:avoid(0);">All Students</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <div class="pull-left">
                <h4 class="section-subtitle"><b>All Students</b></h4>
            </div>
            <!--Print Part-->
            <div class="pull-right">
                <a class="btn btn-primary" target="_blank" href="print_all_students.php"><i class="fa fa-print"></i> Print</a>
            </div>
            <div class="clearfix"></div>

            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-striped nowrap table-hover"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Roll</th>
                                <th>Reg No.</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $query = "SELECT * FROM students";
                            $result = mysqli_query($conn, $query);
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)){ $i++ ;?>

                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['id']; ?></td>
                                <td><?= ucwords($row['fname'].' '. $row['lname']); ?></td>
                                <td><?= $row['roll']; ?></td>
                                <td><?= $row['reg_no']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= ucwords($row['username']); ?></td>
                                <td><?= $row['phone']; ?></td>
                                <td>
                                    <img width="35px" height="40px" src="<?= $row['image']; ?>" alt="">
                                </td>
                                <!--<td>--><?//= //$row['status']; ?><!--</td>-->
                                <td><?= $row['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == 1){?>
<!--                                    <a class="btn btn-primary" href="status_inactive.php?inactive_id=--><?//= $row['id'];?><!--"><i class="fa fa-arrow-up"></i></a>-->
                                    <a class="btn btn-primary" title="Are you ready? For inactive." href="status_inactive.php?inactive_id=<?= base64_encode($row['id']);?>"><i class="fa fa-arrow-up"></i></a>
                                    <?php }else{?>
<!--                                    <a class="btn btn-warning" href="status_active.php?active_id=--><?//= $row['id'];?><!--"><i class="fa fa-arrow-down"></i></a>-->
                                    <a class="btn btn-warning" title="Are you ready? For active." href="status_active.php?active_id=<?= base64_encode($row['id']);?>"><i class="fa fa-arrow-down"></i></a>
                                    <?php } ?>
                                </td>
                                <td><?= date('Y-m-d h:i:s a', strtotime($row['date_time'])); ?></td>
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