<?php session_start();
include('connect.php');
if(!isset($_SESSION['email'])){
  header("Location: login.html");
  exit();
}
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  extract($_POST);

   $targetDir="uploads/";
   $fileName = basename($_FILES["file"]["name"]);
   //$targetPath = $targetDir.$fileName;
   if($_FILES["file"]["tmp_name"]!=''){
    $targetPath = $targetDir . basename($_FILES["file"]["name"]);
   if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)){
    @unlink("uploads/".$_POST['old_website_image']);
   } else {
    echo "Sorry, there was an error uploading your file.";
}
}
else {
 $fileName =$_POST['old_website_image'];
}

       // $en_pass=hash('sha256', $pass);
   $sql="UPDATE `profile` SET `name` = '$name', `filename` = '$fileName', `filepath` = '$targetPath', `usn` = '$usn', `branch` = '$branch', `uname` = '$uname' 
    WHERE `profile`.`email` = '".$_SESSION["email"]."'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: dashboard.php");
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
?>