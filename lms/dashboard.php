<?php session_start();
 include('connect.php');
    if(!isset($_SESSION['email'])){
        header("Location: login.html");
        exit();
    }
//include('connect.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

 $que="select * from profile where email = '".$_SESSION["email"]."'";
 $query=$conn->query($que);
 while($row=mysqli_fetch_array($query))
 { 
   extract($row);
   $name = $row['name'];
   $usn = $row['usn'];
   $branch = $row['branch'];
   $email = $row['email'];
   $uname = $row['uname'];
   $filename = $row['filename'];
  //  $invoice_logo = $row['invoice_logo'];
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link rel="shortcut icon" href="nit2.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/eduwebstyle.css">
    <link rel="stylesheet" href="./assets/css/dashboardstyle.css">
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <!--- google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    <!--- #HEADER-->

    <?php include('header.php');?>

    <section class="section blog has-bg-image" id="blog" aria-label="blog" style="margin-top: 5vh;">
        <!-- <div id="ptbar">
        </div> -->
            <div id="topbar">
                <div>
                    <span id="username"><?php echo $uname;?></span>
                    <img src="./uploads/<?=$filename?>" alt="" width="40px">
                </div>
        </div>
        <div class="dbcenter">
            <div class="profile">
                <div id="profilesection">
                <img id="profilepic" src="./uploads/<?=$filename?>" alt="" height="200px">
                    <table class="profiledetail">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $name;?></td>
                    </tr>
                    <tr>
                        <th>USN</th>
                        <td><?php echo $usn;?></td>
                    </tr>
                    <tr>
                        <th>Branch</th>
                        <td><?php echo $branch;?></td>
                    </tr>
                    <tr>
                        <th>User Name</th>
                        <td><?php echo $uname;?></td>
                    </tr>
                        <tr>
                            <th>
                                <button id="usereditbutton">Edit</button>
                            </th>
                            <td></td>
                        </tr>
                    </table>


                    <form action="update.php" id="editform" method="POST" enctype="multipart/form-data" hidden> 
                    <table>
                        <tr>
                            <th>Profile Pic</th>
                            <td><img src="./uploads/<?=$filename?>" alt="" height="100" width="100"> <br>
                            <input type="hidden" value="<?=$filename?>" name="old_website_image">    
                            <input type="file" name="file" id="file">
                            </td>
                        </tr>
                        <tr>
                            <th><label for="uname">Name </label></th>
                            <td><input type="text" value="<?php echo $name;?>" id="name" name="name"></td>
                        </tr>
                        <tr>
                            <th><label for="usn">USN </label></th>
                            <td><input type="text" value="<?php echo $usn;?>" id="usn" name="usn"></td>
                        </tr>
                        <tr>
                            <th><label for="branch">Branch </label></th>
                            <td><input type="text" value="<?php echo $branch;?>" id="branch" name="branch"></td>
                        </tr>
                        <!-- <tr>
                            <th><label for="year">Email </label></th>
                            <td><input type="email" id="email" name="email"></td>
                        </tr> -->
                        <tr>
                            <th><label for="year">Username </label></th>
                            <td><input type="text" value="<?php echo $uname;?>" id="uname" name="uname"></td>
                        </tr>
                        <button id="closeformbtn"
                            style="background-color: rgb(255, 42, 42); padding:10px 15px; position: absolute; top: 20px; right: 20px; color:aliceblue;">X</button>
                    </table>
                    <button class="submitbtn" type="submit" >Submit</button>
                </form>
                    <script>
                        const editbtn = document.getElementById('usereditbutton');
                        const closebtn = document.getElementById('closeformbtn');
                        const editform = document.getElementById('editform');

                        editbtn.onclick = () => {
                            editform.style.display = 'block';
                        }

                        closebtn.onclick = () => {
                            editform.style.display = 'none';
                        }

                    </script>
                </div>
            </div>

            <div class="badges">
                <div class="indbadge">
                    <img src="./assets/images/" alt="">
                    <div>
                        <span>C Language</span>
                        <span></span>
                    </div>
                </div>
            </div>

            <div class="graph">
                <div id="chartContainer" style="height: 350px; width: 90%;"></div>
            </div>
            <script>
                window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        title: { text: "Time Spent" },
                        axisY: { title: "Time" },
                        data: [{
                            type: "column",
                            showInLegend: true,
                            legendMarkerColor: "grey",
                            legendText: "Day",
                            dataPoints: [
                                { y: 4, label: "D1" },
                                { y: 2, label: "D2" },
                                { y: 1, label: "D3" },
                                { y: 8, label: "D4" },
                                { y: 4, label: "D5" },
                                { y: 9, label: "D6" },
                                { y: 2, label: "D7" },
                                { y: 5, label: "D8" }
                            ]
                        }]
                    });
                    chart.render();

                }
            </script>


        </div>
        <div class="dbright">
            <div class="announcements">
                <ul>
                    <li>
                        <h2>New Announcement !!!</h2>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, illo.
                    </li>
                    <hr>
                    <li>
                        <h2>New Announcement !!!</h2>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, illo.
                    </li>
                    <hr>
                    <li>
                        <h2>New Announcement !!!</h2>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, illo.
                    </li>
                </ul>
            </div>

            <div class="studentlist">
                <ol>
                    <h2>Rank | Name</h2>
                    <li>1. Student-1</li>
                    <li>2. Student-2</li>
                    <li>3. Student-3</li>
                    <li>4. Student-4</li>
                    <li>5. Student-5</li>
                    <li>6. Student-6</li>
                    <li>7. Student-7</li>
                    <li>8. Student-8</li>
                    <li>9. Student-9</li>
                    <li>10. Student-10</li>
                    <li>11. Student-11</li>
                    <li>12. Student-12</li>
                    <li>13. Student-13</li>
                    <li>14. Student-14</li>
                    <li>15. Student-15</li>
                </ol>
            </div>

        </div>

    </section>

    <!--- #BACK TO TOP-->
    <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
        <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>
    <!---custom js link-->
    <script src="./assets/js/script.js" defer></script>
    <!--- ionicon link-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>