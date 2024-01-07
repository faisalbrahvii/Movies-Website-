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
						<label for="formFile" class="form-label">Select Movie</label>
						<input name="m_video" class="form-control" type="file" id="formFile" Required>
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label"> Name</label>
						<input name="m_name" type="text" class="form-control" id="exampleFormControlInput1"
							placeholder="Video Name" Required>
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label"> Details</label>
						<input name="m_detail" type="text" class="form-control" id="exampleFormControlInput1"
							placeholder="Video Name" Required>
					</div>
					<div class="form-group">
    <label for="">Service ID</label>
   <select name="ss_id" id="" class="form-control bg-light text-dark" >
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
			</div>
			<div class="modal-footer">
				<button name="add_movie" class="btn btn-primary" id="addMovieBtn" >Add Movies/Shows</button>
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
							<h5 class="m-b-10">Video</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Video</a></li>
							<li class="breadcrumb-item"><a href="#!">Total Videos</a></li>
						</ul>
					</div>
					<div class="col-6">
						<div class="add-btn text-right">
							<input data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
								value="Add Movies/Shows" class="btn btn-primary">
						</div>
					</div>
				</div>
			</div>
			<div class="mt-3" id="liveAlertPlaceholder">
			<?php 
if(isset($_SESSION['mesg'])){
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?php echo $_SESSION['mesg'];?>  
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php }?>

<?php 
if(isset($_SESSION['mes'])){
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?php echo $_SESSION['mes'];?>  
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php }?>

			</div>
			<h1 class="text-center">Movies</h1>
		</div>
		<div class="card">
			<div class="card-body table-border-style">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Image</th>
								<th>Name</th>
								<th>Service ID</th>
								<th>Opearations</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = $pdo->query("select * from shows");
							$result = $query->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $Video) {
								?>
								<tr>
									<td>
										<?php echo $Video['id'] ?>
									</td>
									<td class="pt-4">
									    <img src=<?php echo "./assets/images/" . $Video['image']?> width="50px" alt="">
									</td>
									<td class="pt-4">
										<?php echo $Video['name'] ?>
									</td>
									
									<td class="pt-4">
										<?php echo $Video['services_id'] ?>

							</td>
							<td class="pt-4 d-flex">
							<button type="button" class="btn btn-success me-3">
                    <a href="movies_update.php?id=<?php echo $Video['id']?>" class="text-dark" style="text-decoration:none;">Update</a>
                    </button>			
                    <button  class="btn btn-danger" id="liveAlertBtn">
                    <a  href="movies_shows.php?id=<?php echo $Video['id']?>" class="text-dark" style="text-decoration:none;">Delete</a> 
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
	unset($_SESSION['mesg']);
        $id_s = $_GET['id'];
        $query = $pdo->prepare("delete from shows where id = :id");
        $query->bindParam("id",$id_s);
       $query->execute();
	//    echo "<script>
    //             location.assign('movies_shows.php')</script>";
        }
?>

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>

<script>
const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
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

const alertTrigger = document.getElementById('liveAlertBtn')
if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    appendAlert('Nice, you triggered this alert message!', 'success')
  })
}
</script>
</body>
</html>