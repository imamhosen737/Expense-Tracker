<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

<?php
        require_once("header.php");
        require_once("sidebar.php");

        if (isset($_POST['submit'])) {
          $category_name = $_POST['category_name'];

          $check = $conn->query("SELECT * from expense_category WHERE category_name='$category_name'");
          $checkrows = mysqli_num_rows($check);

          if ($category_name == '' || $checkrows > 0) {
            if ($category_name == '') {
              $cat_error['category_name'] = "Category name field is required!";
            } elseif ($checkrows > 0) {
              $cat_error['category_name'] = "Category exists!";
            }
          } else {
            $conn->query("INSERT INTO `expense_category`(`category_name`) VALUES ('$category_name')"); ?>
            <script>
              window.location.assign("expense_catt.php");
            </script>
<?php
  }
}

$cat_data = $conn->query("SELECT * FROM expense_category");

?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="expense_catt.php">Category Name</a></li>
          <!-- <li class="breadcrumb-item active"></li> -->
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
          <div class="card-body">

            <form action="" method="post">
              <table class="table table-bordered table-striped table-hover">
                <tr>

                  <th>Add Category</th>
                  <td>
                    <input type="text" name="category_name" class="form-control">
                    <span style="color: red;"><?php if (isset($cat_error['category_name'])) {
                        echo $cat_error['category_name'];
                      } ?></span>
                  </td>

                  <td>
                    <input type="submit" value="Submit" name="submit" class="btn btn-sm btn-info">
                  </td>
                </tr>

              </table>
            </form>

            <h3 class="mt-5 text-success text-center mb-3">Expense Categories</h3>

            <table class="table text-center table-striped table-hover">
             <thead class="thead-dark">
             <tr>
                <th>SL</th>
                <th>Category Name</th>
                <th>Action</th>
              </tr>
             </thead>

              <?php $sl = 0;
              while ($data = $cat_data->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo ++$sl; ?></td>
                  <td><?php echo $data['category_name']; ?></td>
                  <td>
                    <a href="expense_catt_up.php?id=<?php echo  $data['id']; ?>" class="btn btn-sm btn-info fas fa-edit"></a>
                    <a href="expense_catt_delete.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger fas fa-trash-alt" onclick="return confirm('Are you sure to delete?')"></a>
                  </td>
                </tr>
              <?php } ?>
            </table>


          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<?php require("footer.php"); ?>