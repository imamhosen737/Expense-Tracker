<?php
require_once("header.php");
require_once("sidebar.php");

if (isset($_POST['start_date'])) {
  $start = $_POST['start_date'];
  $end = $_POST['end_date'];

  $expense = $conn->query("SELECT * FROM expense JOIN expense_category ON expense_category.id=expense.categoryID WHERE `date` BETWEEN '" . $start . "' AND '" . $end . "'");
} else {
  $expense = $conn->query("SELECT * FROM expense JOIN expense_category ON expense_category.id=expense.categoryID");
} ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1> <i class="fas fa-home"></i> Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

            <center>
              <h2>Company Name</h2>
            </center>
            <center>
              <h4>All Expense list</h4>
            </center>
            <center>
              <h5></h5>
              <?php if (isset($_POST['start_date'])) {
                echo "<h5>For the period of  $start  To  $end</h5>";
              } ?>
            </center>


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <!-- start table for searching epsenses by date wise         -->
        <div class="container">
          <div class="row">
            <div class="col-md-4"></div>
            <form action="" method="post">
              <table>
                <tr>
                  <th>From:</th>
                  <th>To:</th>
                </tr>

                <tr>
                  <td>
                    <input type="date" name="start_date" class="form-control">
                  </td>
                  <td>
                    <input type="date" name="end_date" class="form-control">
                  </td>
                  <td>
                    <input type="submit" value="SEARCH" class="btn btn-info btn-block">
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>

        <br>
        <br>

        <table class="table table-bordered text-center table-striped hover">
          <thead class="thead-dark">
            <tr>
              <th>SL</th>
              <th>Category</th>
              <th>Date</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $i = 0;
            $total_expense = 0;

            while ($d = $expense->fetch_assoc()) { ?>
              <tr>
                <td><?php echo ++$i ?></td>
                <td><?php echo $d['category_name'] ?></td>
                <td><?php echo $d['date'] ?></td>
                <td><?php echo number_format($d['amount']) ?></td>
              </tr>
            <?php
              $total_expense += $d['amount'];
            } ?>
            <tr>
              <th colspan="3">Total</th>
              <th><?php echo 'TK ' . number_format($total_expense, 2); ?></th>
            </tr>

          </tbody>

        </table>

        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<?php require("footer.php"); ?>