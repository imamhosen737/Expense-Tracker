  <?php
  require_once("header.php");
  require_once("sidebar.php");

  $expense_data = $conn->query("SELECT `exoenseID`,expense_category.category_name,`date`,`amount` FROM `expense` JOIN expense_category ON expense_category.id=expense.categoryID");

  $mm = $conn->query("SELECT * FROM expense_category");

  if (isset($_POST['submit'])) {
    $categoryID = $_POST['categoryID'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];

    $current_date = date('Y-m-d H:i:s');

    // $cat_error['categoryID'] = '';
    // $date_error['date'] = '';
    // $amount_error['amount'] = '';
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
      $conn->query("INSERT INTO `expense`(`categoryID`, `date`, `amount`) VALUES ('$categoryID','$date','$amount')");
      ?>
       <script>
      window.location.assign("expense.php");
      </script>
   <?php }    

  }
  ?>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Expense Tables</h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home/ Expense</a></li>
            <!-- <li class="breadcrumb-item active">Expense Tables</li> -->
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
                <h1 style="text-align: center;" class="text-success">Add Expense</h1>


                <form action=" " method="post">
                  <!-- <div> -->
                  <label for="category name">Category Name</label>
                  <select name="categoryID" class="form-control">
                    <option value="0">Select Category</option>
                    <?php
                    while ($rr = $mm->fetch_assoc()) {
                    ?>
                      <option value="<?php echo $rr['id'] ?>"><?php echo $rr['category_name'] ?></option>
                    <?php } ?>
                  </select>
                  <span style="color: red;"><?php if (isset($cat_error['categoryID'])) {
										echo $cat_error['categoryID'];
									} ?></span><br>

                  <label for="date">Date</label>
                  <input type="date" name="date" placeholder="Date" class="form-control">
                  <span style="color: red;"><?php if (isset($date_error['date'])) {
										echo $date_error['date'];
									} ?></span><br>

                  <label for="amount">Amount</label>
                  <input type="text" name="amount" placeholder="Amount" class="form-control">
                  <span style="color: red;"><?php if (isset($amount_error['amount'])) {
										echo $amount_error['amount'];
									} ?></span><br>


                  <td colspan="6">
                    <input type="Submit" name="submit" value="Submit" class="btn btn-outline-success btn btn-block">
                  </td>

                </form>

                <br><br>
                <h3 class="text-center text-success mb-3 ">Expense List</h3>

                <div class="container">
                  <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php $i = 0;
                      while ($expense = $expense_data->fetch_assoc()) { ?>
                        <tr>
                          <td><?php echo ++$i ?></td>
                          <td><?php echo $expense['category_name'] ?></td>
                          <td><?php echo $expense['date'] ?></td>
                          <td><?php echo $expense['amount'] ?></td>
                          <td>
                            <a href="./expense_edit.php?id=<?php echo $expense['exoenseID']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>

                            <a href="./expense_delete.php?id=<?php echo $expense['exoenseID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash"></i></a>
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