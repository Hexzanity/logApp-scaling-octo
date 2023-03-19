<?php
require 'vendor/autoload.php';
$faker = Faker\Factory::create();
$db = mysqli_connect("localhost","root","Loveisshit143","recordsapp");

$result = $db->query("SELECT COUNT(*) FROM office");
$row = $result->fetch_row();
$num_rows = $row[0];

if ($num_rows < 200) {
    $db->query("UPDATE FROM office");

    for ($i=$num_rows; $i < 200; $i++){
        $db->query("
            INSERT INTO office (name, contactnum, email, address, city, country, postal)
            VALUES ('$faker->company','$faker->e164PhoneNumber','$faker->email',
            '$faker->address','$faker->city','$faker->country','$faker->postcode')
        ");
    }
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    
<?php 
    require("config/db.php");

    if (!isset ($_GET['search']) ) {  
        $search = "";  
    } else {  
        $search = $_GET['search'];   
    }

    $nresults = 10;

    $query = "SELECT * FROM office";
    $query = "SELECT * FROM employee";
    $r = mysqli_query($db,$query);
    $nor = mysqli_num_rows($r);

    $numberOfPage = ceil($nor/$nresults);

    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }

    $pfirstr = ($page-1) *$nresults;

    if (strlen($search) > 0){
        $query = 'SELECT * FROM office WHERE office.postal= '. $search . ' ORDER BY name LIMIT '. $pfirstr . ',' . $nresults;
    }else{
        $query = 'SELECT * FROM office ORDER BY name LIMIT '. $pfirstr . ',' . $nresults;
    }
    
    $r = mysqli_query($db,$query);

    $offices =  mysqli_fetch_all($r,MYSQLI_ASSOC);


    mysqli_free_result($r);


    mysqli_close($db);
?>
    <div class="wrapper">
       <?php include "includes/sidebar.php"?>
        </div>
        <div class="main-panel">
        <?php include "includes/navbar.php"?>   
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                            <br/>
                                <div class="col-md-12">
                                    <form action="office.php" method="GET">
                                        <input type="text" name="search" />
                                        <input type="submit" value="Search" class="btn btn-info btn-fill" />
                                    </form>
                                </div>
                                <br>
                                <div class="col-md-12" >
                                <a href="office-add.php">
                                <button type="submit" class="btn btn-info btn-fill pull-right">Add New Office</button>
                                </a>
                                </div>        
                                </br>
                                <div class="card-header ">
                                    <h4 class="card-title">Offices</h4>
                                    <p class="card-category">We are the Employees</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Postal</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($offices as $office): ?>
                                            <tr>
                                                <td><?php echo $office['name'] ?></td>
                                                <td><?php echo $office['contactnum'] ?></td>
                                                <td><?php echo $office['email'] ?></td>
                                                <td><?php echo $office['address'] ?></td>
                                                <td><?php echo $office['city'] ?></td>
                                                <td><?php echo $office['country'] ?></td>
                                                <td><?php echo $office['postal'] ?></td>
                                                <td>
                                                <a href="office-edit.php?id=<?php echo $office['id'] ?>">
                                                <button type="submit" class="btn btn-warning btn-fill pull-right">Edit</button>
                                                </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                  for($page = 1; $page<= $numberOfPage; $page++) {  
                      echo '<a href = "office.php?page=' . $page . '">' . $page . '&nbsp;&nbsp;&nbsp; </a>';  
                  }
                  ?> 
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
    <!--   -->
    <!-- <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>

        <ul class="dropdown-menu">
			<li class="header-title"> Sidebar Style</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Background Image</p>
                    <label class="switch">
                        <input type="checkbox" data-toggle="switch" checked="" data-on-color="primary" data-off-color="primary"><span class="toggle"></span>
                    </label>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <p>Filters</p>
                    <div class="pull-right">
                        <span class="badge filter badge-black" data-color="black"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-purple active" data-color="purple"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Sidebar Images</li>

            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-1.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-3.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="..//assets/img/sidebar-4.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-5.jpg" alt="" />
                </a>
            </li>

            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/light-bootstrap-dashboard" target="_blank" class="btn btn-info btn-block btn-fill">Download, it's free!</a>
                </div>
            </li>

            <li class="header-title pro-title text-center">Want more components?</li>

            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/light-bootstrap-dashboard-pro" target="_blank" class="btn btn-warning btn-block btn-fill">Get The PRO Version!</a>
                </div>
            </li>

            <li class="header-title" id="sharrreTitle">Thank you for sharing!</li>

            <li class="button-container">
				<button id="twitter" class="btn btn-social btn-outline btn-twitter btn-round sharrre"><i class="fa fa-twitter"></i> · 256</button>
                <button id="facebook" class="btn btn-social btn-outline btn-facebook btn-round sharrre"><i class="fa fa-facebook-square"></i> · 426</button>
            </li>
        </ul>
    </div>
</div>
 -->
</body>

