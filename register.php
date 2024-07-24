<?php
 include('connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $usn = $_POST['usn'];
    $branch = $_POST["branch"];
    $email = $_POST["email"];
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];

  $targetDir="uploads/";

  if(isset($_FILES['file']) && $_FILES['file']['error'] == 0)
  { 
    // Submit these to a database
    // Sql query to be executed 
    $fileName = basename($_FILES["file"]["name"]);
$targetPath = $targetDir.$fileName;


if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) 
{
    if($pass==$cpass){
        $en_pass=hash('sha256', $pass);
    $sql = "INSERT INTO `profile` (`name`, filename, filepath, `usn`, `branch`, `email`, `uname`, `pass`) 
    VALUES ('$name', '$fileName', '$targetPath', '$usn', '$branch', '$email', '$uname', '$en_pass');";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: login.html");
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your entry has been submitted successfully!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>';
    }
    else{
        // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>';
    }
  }
}} }
?>