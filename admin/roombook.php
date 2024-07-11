<?php
session_start();
include '../config.php';

$rsql ="select * from room";
$rre= mysqli_query($conn,$rsql);
$r = 0;
$sc = 0;
$gh = 0;
$sr = 0;
$dr = 0;

while($rrow=mysqli_fetch_array($rre))
{
    $r = $r + 1;
    $s = $rrow['type'];
    if($s=="Superior Room")
    {
        $sc = $sc+ 1;
    }
    if($s=="Guest House")
    {
        $gh = $gh + 1;
    }
    if($s=="Single Room" )
    {
        $sr = $sr + 1;
    }
    if($s=="Deluxe Room" )
    {
        $dr = $dr + 1;
    }
}

$csql ="select * from payment";
$cre= mysqli_query($conn,$csql);
$cr =0 ;
$csc =0;
$cgh = 0;
$csr = 0;
$cdr = 0;
while($crow=mysqli_fetch_array($cre))
{
    $cr = $cr + 1;
    $cs = $crow['RoomType'];
                
    if($cs=="Superior Room")
    {
        $csc = $csc + 1;
    }
                
    if($cs=="Guest House" )
    {
        $cgh = $cgh + 1;
    }
    if($cs=="Single Room")
    {
        $csr = $csr + 1;
    }
    if($cs=="Deluxe Room")
    {
        $cdr = $cdr + 1;
    }
}
// room availablity
// Superior Room =>
$f1 =$sc - $csc;
if($f1 <=0 )
{	
    $f1 = "NO";
}
// Guest House =>
$f2 =  $gh -$cgh;
if($f2 <=0 )
{	
    $f2 = "NO";
}
// Single Room =>
$f3 =$sr - $csr;
if($f3 <=0 )
{	
    $f3 = "NO";
}
// Deluxe Room =>
$f4 =$dr - $cdr; 
if($f4 <=0 )
{	
    $f4 = "NO";
}
//total available room =>
$f5 =$r-$cr; 
if($f5 <=0 )
{
    $f5 = "NO";
}
?>
<!-- room availablity end-->

<!-- ==== room book php ====-->
<?php   
       $cin = "";
       $cout = "";
    if (isset($_POST['guestdetailsubmit'])) {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Country = $_POST['Country'];
        $Phone = $_POST['Phone'];
        $RoomType = $_POST['RoomType'];
        $Bed = $_POST['Bed'];
        $NoofRoom = $_POST['NoofRoom'];
        $Meal = $_POST['Meal'];
        $cin = $_POST['cin'];
        $cout = $_POST['cout'];

        if($Name == "" || $Email == "" || $Country == ""){
            echo "<script>swal({
                title: 'Fill the proper details',
                icon: 'error',
            });
            </script>";
        }
        else{
            $sta = "NotConfirm";
            $sql = "INSERT INTO roombook(Name,Email,Country,Phone,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays) VALUES ('$Name','$Email','$Country','$Phone','$RoomType','$Bed','$NoofRoom','$Meal','$cin','$cout','$sta',datediff('$cout','$cin'))";
            $result = mysqli_query($conn, $sql);

            // if($f1=="NO")
            // {
            //     echo "<script>swal({
            //         title: 'Superior Room is not available',
            //         icon: 'error',
            //     });
            //     </script>";
            // }
            // else if($f2=="NO")
            // {
            //     echo "<script>swal({
            //         title: 'Guest House is not available',
            //         icon: 'error',
            //     });
            //     </script>";
            // }
            // else if($f3 == "NO")
            // {
            //     echo "<script>swal({
            //         title: 'Si Room is not available',
            //         icon: 'error',
            //     });
            //     </script>";
            // }
            // else if($f4 == "NO")
            // {
            //     echo "<script>swal({
            //         title: 'Deluxe Room is not available',
            //         icon: 'error',
            //     });
            //     </script>";
            // }
            // else if($result = mysqli_query($conn, $sql))
            // {
                if ($result) {
                    echo "<script>swal({
                        title: 'Reservation successful',
                        icon: 'success',
                    });
                </script>";
                } else {
                    echo "<script>swal({
                            title: 'Something went wrong',
                            icon: 'error',
                        });
                </script>";
                }
            // }
        }
    }

?>

<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BlueBird Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="./bluebirdlogo.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Blue</strong><strong>Bird</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">B</strong><strong>B</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          
             
            <!-- Tasks-->
           
            <!-- Tasks end-->
            <!-- Megamenu-->
          
            <!-- Megamenu end     -->
            <!-- Languages dropdown    -->
         
            <!-- Log out               -->
            <div class="list-inline-item logout">                   <a href="./logout.php" class="nav-link">Logout <i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="./adminPhoto.jpeg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Jaydeep Satrotiya</h1>
            <p>Admin</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li><a href="admin.php"> <i class="icon-home"></i>Home </a></li>
                <li class="active"><a href="roombook.php"> <i class="icon-grid"></i>Room Booking </a></li>
                <li><a href="payment.php"> <i class="fa fa-bar-chart"></i>Payments </a></li>
                <li><a href="staff.php"> <i class="icon-padnote"></i>Staff </a></li>
       
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Main</a></li>
            <li class="breadcrumb-item active">Booking            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-11">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Room Booking</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                        <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Country</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Type of Room</th>
                    <th scope="col">Type of Bed</th>
                    <th scope="col">No of Room</th>
                    <th scope="col">Meal</th>
                    <th scope="col">Check-In</th>
                    <th scope="col">Check-Out</th>
                    <th scope="col">No of Day</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="action">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php
                        
                          $roombooktablesql = "SELECT * FROM roombook";
                          $roombookresult = mysqli_query($conn, $roombooktablesql);
                          $nums = mysqli_num_rows($roombookresult);
                     
            while ($res = mysqli_fetch_array($roombookresult)) {
            ?>
                <tr>
                    <td><?php echo $res['id'] ?></td>
                    <td><?php echo $res['Name'] ?></td>
                    <td><?php echo $res['Email'] ?></td>
                    <td><?php echo $res['Country'] ?></td>
                    <td><?php echo $res['Phone'] ?></td>
                    <td><?php echo $res['RoomType'] ?></td>
                    <td><?php echo $res['Bed'] ?></td>
                    <td><?php echo $res['NoofRoom'] ?></td>
                    <td><?php echo $res['Meal'] ?></td>
                    <td><?php echo $res['cin'] ?></td>
                    <td><?php echo $res['cout'] ?></td>
                    <td><?php echo $res['nodays'] ?></td>
                    <td><?php echo $res['stat'] ?></td>
                    <td class="action">
                        <?php
                            if($res['stat'] == "Confirm")
                            {
                                echo " ";
                            }
                            else
                            {
                                echo "<a href='roomconfirm.php?id=". $res['id'] ."'><button class='btn btn-success'>Confirm</button></a>";
                            }
                        ?>
                        <a href="roombookedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                        <a href="roombookdelete.php?id=<?php echo $res['id'] ?>"><button class='btn btn-danger'>Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?> 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
             
             
             
            </div>
          </div>
        </section>
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <p class="no-margin-bottom">Created By SJ</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>