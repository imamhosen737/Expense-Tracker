<?php 
require_once("header.php");
require_once("sidebar.php");

          $id=$_GET['id'];
          $cat_up = $conn->query("SELECT * FROM expense_category WHERE id=$id");
          $result = $cat_up->fetch_assoc();

          if(isset($_POST['submit'])){
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

          $conn->query("UPDATE `expense_category` SET `category_name`='$category_name' WHERE id=$id"); ?>

          <script>
          window.location.assign("expense_catt.php");
          </script>

          <?php } } ?>
     
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="add_emp.php">Home</a></li>
              <li class="breadcrumb-item active"></li>
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
                <h3 class="card-title">Bordered Table</h3>

              </div>
              <!-- /.card-header -->
        <div class="card-body">
       <h3 class="text-center text-success mt-3"> Update Expense Category</h3>

       <form action="" method="post">
       <table class="table table-bordered table-striped table-hover">
        <tr>
          
          <label>Category Name</label>
          <td>
            <input type="text" name="category_name" class="form-control" value="<?php echo $result['category_name']?>">
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



              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<?php require("footer.php"); ?>

<!-- 
<style>
  table{
    text-align: center;
  }
</style> -->