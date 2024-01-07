<?php
include("query.php");
if (!isset($_SESSION['username'])) {
	header("location:signin.php");
}
include("header.php")
	?>
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
						<label for="exampleFormControlInput1" class="form-label">Service Name</label>
						<input name="s_name" type="text" class="form-control" id="exampleFormControlInput1"
							placeholder="Service Name" Required>
					</div>
					<div class="mb-3">
						<label for="formFile" class="form-label">Logo</label>
						<input name="logo" class="form-control" type="file" id="formFile" Required>
					</div>
			</div>
			<div class="modal-footer">
				<button name="add_provider" class="btn btn-primary">Add Provider</button>
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
								value="Add Service Provider" class="btn btn-primary">
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="card">
			<div class="card-body table-border-style">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Provider Name</th>
								<th>Operations</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = $pdo->query("select * from service_p");
							$result = $query->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $service) {
								?>
								<tr>
									<td>
										<?php echo $service['service_id'] ?>
									</td>
									
									<td class="pt-4">
										<?php echo $service['service_name'] ?>
									</td>
									
									<td class="pt-4 d-flex">
									<p><a class="mx-3" href="service_update.php?id=<?php echo $service['service_id']?>"><i
									class="feather icon-edit"></i>update</a></p>
									 <p><a class="text-danger" href="services.php?id=<?php echo $service['service_id'] ?>"><i
									class="feather icon-trash-2"></i>delete</a></p>
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
<?php
	if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = $pdo->prepare("delete from service_p where service_id = :id");
        $query->bindParam("id",$id);
        if($query->execute()){
           echo "<script>location.assign('services.php')</script>";
        }

    }
?>
</section>
<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>



</body>

</html>