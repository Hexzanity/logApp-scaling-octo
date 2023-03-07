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



<?php 
    require("config/db.php");
    if (!isset ($_GET['search']) ) {  
        $search = "";  
    } else {  
        $search = $_GET['search'];   
    }
    
    $nresults = 25;

    $query = "SELECT * FROM transaction";
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
        $query = 'SELECT transaction.id,transaction.datelog, transaction.documentcode, transaction.action, employee.firstname 
        as office_name, CONCAT(employee.lastname,", ", employee.firstname) AS employee_fullname, transaction.remarks  
        FROM c.transaction, c.employee, c.office
        WHERE transaction.employee_id=employee.id and transaction.office_id=office.id 
        and transaction.documentcode='. $search . ' ORDER BY transaction.documentcode, transaction.datelog LIMIT ' . $pfirstr . ',' . $nresults;

    }else{
        $query = 'SELECT transaction.id,transaction.datelog, transaction.documentcode, transaction.action, office.name 
        as office_name, CONCAT(employee.lastname,", ", employee.firstname) AS employee_fullname, transaction.remarks  
        FROM c.transaction, c.employee, c.office
        WHERE transaction.employee_id=employee.id and transaction.office_id=office.id ORDER BY transaction.documentcode, transaction.datelog LIMIT ' . $pfirstr . ',' . $nresults;
    }

	$result = mysqli_query($db, $query);
	$transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
    mysqli_close($db);

?>
<body>
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
                                    <form action="transaction.php" method="GET">
                                        <input type="text" name="search" />
                                        <input type="submit" value="Search" class="btn btn-info btn-fill" />
                                    </form>
                                </div>
                                <br>
                                <div class="col-md-12" >
                                <a href="transaction-add.php">
                                <button type="submit" class="btn btn-info btn-fill pull-right">Add New Transaction</button>
                                </a>
                                </div>        
                                </br>
                                <div class="card-header ">
                                    <h4 class="card-title">Transaction</h4>
                                    <p class="card-category">We are the Employees</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>

                                            <th>datelog</th>
                                            <th>action</th>
                                            <th>remarks</th>
                                            <th>documentCode</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach($transactions as $transaction): ?>
                                            <tr>
                                             
        
                                                <td><?php echo $transaction['datelog'] ?></td>
                                                <td><?php echo $transaction['action'] ?></td>
                                                <td><?php echo $transaction['remarks'] ?></td>
                                                <td><?php echo $transaction['documentcode'] ?></td>
                                                <td>
                                                <a href="transaction-edit.php?id=<?php echo $transaction['id'] ?>">
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
                      echo '<a href = "transaction.php?page=' . $page . '">' . $page . ' </a>';  
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