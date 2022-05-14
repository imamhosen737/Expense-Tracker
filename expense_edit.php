<?php
require_once("header.php");
require_once("sidebar.php"); ?>

<?php
$id = $_GET['id'];
$expense_data = $conn->query("SELECT * FROM `expense` WHERE exoenseID = $id");

$result = $expense_data->fetch_assoc();
$cat = $conn->query("SELECT * FROM expense_category");

if (isset($_POST['submit'])) {
	$categoryID = $_POST['categoryID'];
	$date = $_POST['date'];
	$amount = $_POST['amount'];

	$current_date = date('Y-m-d');

    if ($categoryID == 0 || $date == '' || $amount == '' || $date >$current_date ) {
      if ($categoryID == 0) {
        $cat_error['categoryID'] = "Category field is required";
      }
      
    if ($date >$current_date ) {
      $date_error['date'] = "Date should be previous or current! Future date is not allowed!";
    }elseif($date == ''){
      $date_error['date'] = "Date is required!";
    }

    if ($amount == '') {
      $amount_error['amount'] = "Amount is required!";
    }elseif(!is_numeric($amount)){
      $amount_error['amount'] = "Amount should be a intiger number!";
    }

    }else{
		$conn->query("UPDATE `expense` SET  `categoryID` = '$categoryID',`date`='$date', `amount` = '$amount' WHERE `expense`.`exoenseID` = $id"); ?>
       <script>
      window.location.assign("expense.php");
      </script>


<?php } } ?>

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<!-- <h1>Edit Expense</h1> -->
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<!-- <li class="breadcrumb-item active">Edit Expense</li> -->
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
						<h3 class="card-title">Expense</h3>
					</div>
					<!-- /.card-header -->

					<div class="container">
						<div class="card-body">
							<h1 class="text-center text-success">Update Expense</h1>
							<form action=" " method="post">
								<!-- <div> -->
								<label for="category name">Expense Category</label>
								<select name="categoryID" class="form-control">
									<option value="NULL">Select Category</option>
									<?php
									while ($c = $cat->fetch_assoc()) {
									?>
									<option value="<?php echo $c['id'] ?>" <?php if($c['id'] == $result['categoryID']){echo "selected";} ?>><?php echo $c['category_name'] ?></option>
									<?php	} ?>
								</select>
								<span style="color: red;"><?php if (isset($cat_error['categoryID'])) {
										echo $cat_error['categoryID'];
									} ?></span><br>

								<label for="date">Date</label>
								<!-- <input type="date" name="date" max="<?php echo date('Y-m-d'); ?>" class="form-control" value="<?php echo $result['date'] ?>">  -->

								<input type="date" name="date" class="form-control" value="<?php echo $result['date'] ?>"> 
								<span style="color: red;"><?php if (isset($date_error['date'])) {
										echo $date_error['date'];
									} ?></span><br>

								<label for="amount">Amount</label>
								<input type="text" name="amount" class="form-control" value="<?php echo $result['amount'] ?>">
								<span style="color: red;"><?php if (isset($amount_error['amount'])) {
										echo $amount_error['amount'];
									} ?></span><br>

								<br>
								<td colspan="6">
									<input type="Submit" name="submit" value="Submit" class="btn btn-outline-primary btn btn-block">
								</td>

							</form>

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