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
    <label for="">image</label>
    <img src="./assets/images/<?php echo $data_c['image']?>" alt="">
    <input type="file" name="image_s" id="" class="form-control bg-light text-dark">
</div>
<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name_s" id="" value="<?php echo $data_c['name']?>" class="form-control bg-light text-dark">
</div>
<div class="form-group">
    <label for="">Service ID</label>
   <select name="s_id" id="" class="form-control bg-light text-dark" >
    <option value="">Select Service</option>
    <?php 
    $query=$pdo->query("select * from subcription_plane");
    $result_u=$query->fetchALL(PDO::FETCH_ASSOC);
    foreach($result_u as $sata){
        ?>
        <option value="<?php echo $sata['sub_id']?>"><?php echo $sata['sub_id']?></option>
        <?php
    }
    ?>
   </select>
   <button class="btn btn-primary mt-3" type="submit"  id="liveAlertBtn1" value="Update Product" name="update_movie">Update</button>
</div>
</form>
</div>

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
</body>

</html>