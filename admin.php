	<?php
	require_once("header.php");
	require_once("sidebar.php"); ?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Admin</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
						</div>
						<!-- /.card-header -->

		<?php

				if (isset($_POST['submit'])) {
					$name = $_POST['name'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					$email_pattern = "/\S+@\S+\.\S+/";

					if ($name == '' || is_numeric($name) || $email == '' || !preg_match($emai_pattern,$email) || $password == '' || (strlen($password) != 5)) {
						
					if ($name == '') {
						$name_error['name'] = "Name is required";
					} elseif (is_numeric($name)){
						$name_error['name'] = "Only letters allowed";
					} 
					if ($email == '') {
						$email_error['email'] = "Email is required";
					} elseif (!preg_match($email_pattern,$email)){
						$email_error['email'] = "Invalid email";
					}
					if ($password == '') {
						$password_error['password'] = "Password is required";
					} elseif((strlen($password) != 5)){
						$password_error['password'] = "Password should be 5 characters";
					}
					}else{
						$conn->query("INSERT INTO `admin` (`adminID`, `name`, `email`, `password`) VALUES (NULL,'$name', '$email', '$password')"); ?>

						<script>
						window.location.assign("admin.php");
						</script>

		<?php	} } ?>


						<div class="card-body">
							<h1 class="text-center text-success">Add New Admin</h1>
							<form action=" " method="post">
								<div>
									<label for="name">Name</label>
									<input type="text" name="name" placeholder="Name" class="form-control">
									<span style="color: red;"><?php if (isset($name_error['name'])) {
										echo $name_error['name'];
									} ?></span><br>

									<label for="email">Email</label>
									<input type="text" name="email" placeholder="Email" class="form-control">	<span style="color: red;"><?php if (isset($email_error['email'])) {
										echo $email_error['email'];
									} ?></span><br>
									<label for="password">Password</label>
									<input type="text" name="password" placeholder="Password" class="form-control">	<span style="color: red;"><?php if (isset($password_error['password'])) {
										echo $password_error['password'];
									} ?></span><br>

									<td colspan="6">
										<input type="Submit" name="submit" value="Submit" class="btn btn-success btn-block">
									</td>
							</form>

							<br><br>
							<h1 class="text-center text-success">Admin List</h1>

							<div class="container">
								<table class="table table-striped table-hover">
									<thead class="thead-dark">
										<tr>
											<th>SL</th>
											<th>Name</th>
											<th>Email</th>
											<th>Password</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<?php
										$admin_data = $conn->query("SELECT * FROM `admin`");
										$i = 0;
										while ($d = $admin_data->fetch_assoc()) { ?>

											<tr>
												<td><?php echo ++$i ?></td>
												<td><?php echo $d['name'] ?></td>
												<td><?php echo $d['email'] ?></td>
												<td><?php echo $d['password'] ?></td>
												<td>
													<a href="./admin_edit.php?id=<?php echo $d['adminID']; ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
													<a href="./admin_delete.php?id=<?php echo $d['adminID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash"></i></a>
												</td>
											</tr>
										<?php   } ?>
									</tbody>
								</table>
							</div>


						</div>
					</div>
				</div>
				<!-- /.card -->
			</div>
		</div>
		</div><!-- /.container-fluid -->
	</section>

	<?php require("footer.php"); ?>


























	<?php
	// $name_error = '';
	// $email_error = '';
	// $password_error = '';

	// if (isset($_POST['submit'])) {
	// 	$name = $_POST['name'];
	// 	$email = $_POST['email'];
	// 	$password = $_POST['password'];

	// 	if ($name == '') {
	// 		$name_error = "Name is required";
	// 	} elseif ($email == '') {
	// 		$email_error = "Email is required";
	// 	} elseif ($password == '') {
	// 		$password_error = "Password is required";
	// 	}else {
	// 		$conn->query("INSERT INTO `admin` (`adminID`, `name`, `email`, `password`) VALUES (NULL,'$name', '$email', '$password');");
	// 	}


	// } 
	?>