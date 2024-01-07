<?php
include("query.php");
if (!isset($_SESSION['username'])) {
    header("location:signin.php");
}
include("header.php")
    ?>
<!-- [ Header ] end -->

<!-- [ Modal ] start -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Package Name</label>
						<input name="p_name" type="text" class="form-control" id="exampleFormControlInput1"
							placeholder="Package Name" Required>
					</div>
                    <div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Package Price</label>
						<input name="p_price" type="number" class="form-control" id="exampleFormControlInput1"
							placeholder="Package Price" Required>
					</div>
					
			</div>
			<div class="modal-footer">
				<button name="add_package" class="btn btn-primary">Add Package</button>
			</div>
			</form>
		</div>
	</div>
</div>
</div>

<!-- [ Modal ] end -->


<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-6">
						<div class="page-header-title">
							<h5 class="m-b-10">Music</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Music</a></li>
							<li class="breadcrumb-item"><a href="#!">Total Musics</a></li>
						</ul>
					</div>
					<div class="col-6">
						<div class="add-btn text-right">
							<input data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
								value="Add Package" class="btn btn-primary">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mt-3" id="liveAlertPlaceholder1">
			<?php 
if(isset($_SESSION['package_add'])){
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?php echo $_SESSION['package_add'];?>  
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php }?>

<?php 
if(isset($_SESSION['package_update'])){
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?php echo $_SESSION['package_update'];?>  
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php }?>

			</div>
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subscription Name</th>
                                <th>Price</th>
                                <th>Opearations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $pdo->query("select * from subcription_plane limit 3");
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $user) {
                                ?>
                                <tr>
                                <td>
                                <?php echo $user['sub_id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $user['subscription'] ?>
                                    </td>
                                    <td>
                                        <?php echo $user['price'] ?>
                                    </td>
                                    <td class="pt-4 d-flex">
									<button type="button" class="btn btn-success me-3">
                    <a href="package_update.php?id=<?php echo $user['sub_id']?>" class="text-dark" style="text-decoration:none;">Update</a>
                    </button>			
                    <button  class="btn btn-danger" id="liveAlertBtn1">
                    <a  href="package.php?id=<?php echo $user['sub_id']?>" class="text-dark" style="text-decoration:none;">Delete</a> 
                    </button>
									</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

 
    </div>
</section>

<?php
	if(isset($_GET['id'])){
		unset($_SESSION['package_add']);
		unset($_SESSION['package_update']);
        $id = $_GET['id'];
        $query = $pdo->prepare("delete from subcription_plane where sub_id = :id");
        $query->bindParam("id",$id);
        if($query->execute()){
           echo "<script>location.assign('package.php')</script>";
        }

    }
?>


<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>

<script>
const alertPlaceholder = document.getElementById('liveAlertPlaceholder1')
const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertTrigger = document.getElementById('liveAlertBtn1')
if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    appendAlert('Nice, you triggered this alert message!', 'success')
  })
}

</body>

</html>