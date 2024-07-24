<?php session_start();?>
<?php
 include('connect.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST["email"];
    $pass = $_POST["pass"];     
        $en_pass=hash('sha256', $pass);
        $re = "SELECT * FROM `profile` WHERE email = '$email' AND pass = '$en_pass';";
        // $sql = "INSERT INTO `register` (`email`, `pass`) VALUES ('$email', '$en_pass');";
        // $result1 = mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $re);
        $row  = mysqli_fetch_array($result);
    
     $_SESSION["serial"] = $row['serial'];
     $_SESSION["filename"] = $row['filename']; 
     $_SESSION["filepath"] = $row['filepath']; 
     $_SESSION["name"] = $row['name'];
     $_SESSION["usn"] = $row['usn'];
     $_SESSION["branch"] = $row['branch'];
     $_SESSION["email"] = $row['email'];
     $_SESSION["uname"] = $row['uname'];
     $_SESSION["pass"] = $row['pass'];
        
        $count = mysqli_num_rows($result);
        if($count==1 && isset($_SESSION["email"]) && isset($_SESSION["pass"])){
          header("Location: dashboard.php");
          }
          else{
              echo '<div>
              <h1>Invalid Email or Password</h1>
          </div>';
          }
      }
?>