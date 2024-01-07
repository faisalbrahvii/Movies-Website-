<?php
include("query.php");
include("header.php");
?>
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Users</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Users</a></li>
                            <li class="breadcrumb-item"><a href="#!">Total Users</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name" id="" value="<?php echo $data_c['service_name'] ?>" class="form-control bg-light text-dark">
</div>
<div class="form-group">
    <label for="">image</label>
    <img src="./assets/images/<?php echo $data_c['logo'] ?>" alt="">
    <input type="file" name="image" id="" class="form-control bg-light text-dark">
</div>
   <input class="btn btn-primary mt-3" type="submit" value="update" name="update_service">
</div>
</form>
</div>







<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
</body>

</html>