<?php
session_start();
require_once("header.php");
require_once("sidebar.php");?>
<?php
$id = $_GET['id'];
$data=$conn->query("DELETE FROM expense  WHERE exoenseID = $id");
$_SESSION['msg']='Deleted infofully!';
$_SESSION['class']='danger'; ?>

<script> 
  window.location.assign("expense.php");
</script>
		