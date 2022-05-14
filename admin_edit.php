<?php
require_once("header.php");
require_once("sidebar.php"); ?>
<?php
          $id = $_GET['id'];
          $admin_data = $conn->query("SELECT * FROM `admin` WHERE adminID=$id");

          $result = $admin_data->fetch_assoc();

          if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($name == '' || is_numeric($name) || $email == '' || $password == '' || (strlen($password) != 5)) {
              
            if ($name == '') {
              $name_error['name'] = "Name is required";
            } elseif (is_numeric($name)){
              $name_error['name'] = "Only letters allowed";
            }
            if ($email == '') {
              $email_error['email'] = "Email is required";
            } 
            if ($password == '') {
              $password_error['password'] = "Password is required";
            } elseif((strlen($password) != 5)){
              $password_error['password'] = "Password should be 5 characters";
            }
            }else{
              $conn->query("UPDATE `admin` SET `name`='$name',`email`='$email',`password`='$password' WHERE `admin`.`adminID` = $id"); ?>

              <script>
              window.location.assign("admin.php");
              </script>

<?php	
} } ?>


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <!-- <h1>Edit Expense</h1> -->
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Admin</li>
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
            <h3 class="card-title">Admin</h3>
          </div>
          <!-- /.card-header -->

          <div class="container">
            <div class="card-body">
              <h1 class="text-center text-success">Edit Admin</h1>
              <form action=" " method="post">
                <div>
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" value="<?php echo $result['name'] ?>"><span style="color: red;"><?php if (isset($name_error['name'])) {
										echo $name_error['name'];
									} ?></span><br>
                  <label for="name">Email</label>
                  <input type="text" name="email" class="form-control" value="<?php echo $result['email'] ?>"><span style="color: red;"><?php if (isset($email_error['email'])) {
										echo $email_error['email'];
									} ?></span><br>
                  <label for="name">Password</label>
                  <input type="text" name="password" class="form-control" value="<?php echo $result['password'] ?>"><span style="color: red;"><?php if (isset($password_error['password'])) {
										echo $password_error['password'];
									} ?></span><br>

                  <td colspan="6">
                    <input type="Submit" name="submit" value="Submit" class="btn btn-success btn-block">
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