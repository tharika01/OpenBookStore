<?php
include('../includes/connect.php');
//Only when insert categories is pressed then insert to database
if (isset($_POST['insert_cat'])) {
  $category_title = $_POST['cat_title'];
  //select data from database
  $select_query = "Select * from categories where category_title='$category_title'";
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select);
  if ($number > 0) //duplicate data cannot be entered
  {
    echo "<script>alert('This category is already present inside database')</script>";
  } else {
    $insert_query = "insert into `categories` (category_title) values ('$category_title')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      echo "<script>alert('Category has been inserted successfully')</script>";
    }
  }
}

?>
<h2 class="text-center">Insert categories</h2>
<form action="" method="post" class="mb-2">
  <div class="input-group w-90 mb-2">
    <span class="input-group-text" id="basic-addon1">
      <i class="fa-solid fa-book"></i>
    </span>
    <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="Username" aria-describedby="basic-addon1">
  </div>
  <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="border-0 p-2 my-3" name="insert_cat" value="Insert categories" style="background-color: #9A5222; color: antiquewhite;">


  </div>
</form>