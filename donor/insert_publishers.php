<?php
include('../includes/connect.php');
//Only when insert categories is pressed then insert to database
if (isset($_POST['insert_publisher'])) {
  $publisher_title = $_POST['publisher_title'];
  //select data from database
  $select_query = "Select * from publisher where publisher_title='$publisher_title'";
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select);
  if ($number > 0) //duplicate data cannot be entered
  {
    echo "<script>alert('This Publisher name is already present inside database')</script>";
  } else {
    $insert_query = "insert into `publisher` (publisher_title) values ('$publisher_title')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      echo "<script>alert('Publisher name has been inserted successfully')</script>";
    }
  }
}
?>

<h2 class="text-center">Insert Publishers</h2>
<form action="" method="post" class="mb-2">
  <div class="input-group w-90 mb-2">
    <span class="input-group-text" id="basic-addon1">
      <i class="fa-solid fa-book"></i></span>
    <input type="text" class="form-control" name="publisher_title" placeholder="Insert Publishers" aria-label="Publishers" aria-describedby="basic-addon1">
  </div>
  <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="border-0 p-2 my-3" name="insert_publisher" value="Insert Publishers" style="background-color: #9A5222; color: antiquewhite;">
  </div>
</form>