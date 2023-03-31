<?php
include_once 'trait.php';
include_once 'UsersManager.php';
include_once 'generalTraitement.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['admin']==0){
  ?>
  <script>window.location="index.php";</script>    
     <?php
}
$user=$_SESSION['user'];
$profilepicture=UsersManager::getProfilePictureByUserName($user);
$email=UsersManager::getEmailByUserName($user);
$pass=UsersManager::getPassByUserName($user);
$n=15;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}

?>
<?php 
      if(isset($_POST['modi'])){
        $newuser=$_POST['u'];
        $pass=$_POST['p'];
        $newemail=$_POST['e'];
        $newphoto="";
        if($_FILES['im']['name']!=""){
          $fn=$_FILES['im']['name'];
          $locationtemp=$_FILES['im']['tmp_name'];
          if($profilepicture!="im/utilisateur.png"){
            unlink($profilepicture);
          }
          move_uploaded_file($locationtemp,"uploadedimg/$user $fn");
          $newphoto="uploadedimg/$user $fn";
        }
        else{
          $newphoto=$profilepicture;
        }
        $t=UsersManager::Modifier($user,$newuser,$pass,$newemail,$email,$newphoto);
        
        if($t!=0){
          $_SESSION['user']=$newuser;
          $user=$_SESSION['user'];
          $_SESSION['pass']=$pass;
          $password=$_SESSION['pass'];
          $profilepicture=$newphoto;
          $email=$newemail;
        }
      }

      ?>
      

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin's CRUD</title>
    <link href="ass\css\bootstrap-grid.css" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.css.map" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.min.css.map" rel="stylesheet">
    <link href="ass\css\bootstrap-reboot.css" rel="stylesheet">
    <link href="ass\css\bootstrap-reboot.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap.css" rel="stylesheet">
    <link href="ass\css\bootstrap.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap.min.css.map" rel="stylesheet">
    <link href="ass\css\glyphicones.css" rel="stylesheet">
    <link href="ass\admin.css" rel="stylesheet">
    <link href="ass\bootstrap-icons\bootstrap-icons.css" rel="stylesheet">
    <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="ass\js\jquery-3.3.1.slim.min.js"></script>   
 <script src="ass\js\jquery-1.11.1.min.js"></script>   
 <script src="ass\js\popper.min.js"></script>
  <script src="ass\js\bootstrap.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <link href="ass/test.css" rel="stylesheet">

  

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

</head>
<style>
      

.form {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 940px;
  padding: 20px;
  width:100%;
}

.title {
  color: #eee;
  font-family: sans-serif;
  font-size: 36px;
  font-weight: 600;
}

.subtitle {
  color: #eee;
  font-family: sans-serif;
  font-size: 16px;
  font-weight: 600;
  margin-top: 10px;
}

.input-container {
  height: 50px;
  position: relative;
  width: 100%;
}

.ic1 {
  margin-top: 40px;
}

.ic2 {
  margin-top: 30px;
}

.input {
  background-color: #303245;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  font-size: 18px;
  height: 100%;
  outline: 0;
  padding: 4px 20px 0;
  width: 100%;
}

.cut {
  background-color: #15172b;
  border-radius: 10px;
  height: 20px;
  left: 20px;
  position: absolute;
  top: -20px;
  transform: translateY(0);
  transition: transform 200ms;
  width: 76px;
}

.cut-short {
  width: 50px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
  transform: translateY(8px);
}
.form input::placeholder{
  color:white
}

.placeholder {
  color: #65657b;
  font-family: sans-serif;
  left: 20px;
  line-height: 14px;
  pointer-events: none;
  position: absolute;
  transform-origin: 0 50%;
  transition: transform 200ms, color 200ms;
  top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
  transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
  color: #808097;
}

.input:focus ~ .placeholder {
  color: #dc2f55;
}
input 
.submit {
  background-color: #08d;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 18px;
  height: 50px;
  margin-top: 38px;
  // outline: 0;
  text-align: center;
  width: 100%;
}

.submit:active {
  background-color: #06b;
}
</style>
<script>
  function verifiermodifier(){
                var ok=true;
                let x=document.getElementById('confir').value;
                let y=document.getElementById('config').innerHTML;
                if(x!=y)
                {
                    document.getElementById("remarque").innerHTML="<h6 style='color:red;font-size:9pt'>le code est incorrect!</h6>";
                    ok=false;
                }
                return ok;
            }
          

         
    
</script>
<body>
    
    <nav class="sticky-top" style="position:fixed;width:100%;z-index:1000">
        <div  class="logo"><a href="#header"><img src="im\Good_Travel-removebg-preview.png" height="75px" width="180px" style="padding-bottom: 12px;"></a></div>
        <i class="bi bi-list toggle-sidebar-btn" id="menu" style="font-size: 36px;font-weight: bold;cursor: pointer;"></i>

        <ul>
          <li style="position: absolute;left: 85%;top:15px;font-weight:bold;cursor:pointer" data-toggle="modal" data-target="#edit"><?=$user?></li>
        </ul>
      </nav>
      <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item" id="dashbord">
        <a class="nav-link collapsed" href="#Dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item" id="travelSet">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#Travel_Setting">
          <i class="bi bi-menu-button-wide"></i><span>Travel Setting</span>
        </a>
      </li>
      <li class="nav-item" id="PackageSet">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#Package_Setting">
          <i class="bi bi-menu-button-wide"></i><span>Package Setting</span>
        </a>
      </li>
      <li class="nav-item" id="UsersSet">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#UsersSetting">
          <i class="bi bi-menu-button-wide"></i><span>Users Setting</span>
        </a>
      </li>
      <li class="nav-item" id="MSG">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#Messages_From_Users">
          <i class="bi bi-menu-button-wide"></i><span>Messages From Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="logout.php">
          <i class="bi bi-menu-button-wide"></i><span>Log Out</span>
        </a>
      </li>
      <!-- End Components Nav -->
    </ul>
  </aside>
  
  <aside id="sidebar1" class="sidebar" style="left:-300px">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item" id="dashbord1">
        <a class="nav-link collapsed" href="#Dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item" id="travelSet1">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#Travel_Setting">
          <i class="bi bi-menu-button-wide"></i><span>Travel Setting</span>
        </a>
      </li>
      <li class="nav-item" id="PackageSet1">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#Package_Setting">
          <i class="bi bi-menu-button-wide"></i><span>Package Setting</span>
        </a>
      </li>
      <li class="nav-item" id="UsersSet1">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#UsersSetting">
          <i class="bi bi-menu-button-wide"></i><span>Users Setting</span>
        </a>
      </li>
      <li class="nav-item" id="MSG1">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#Messages_From_Users">
          <i class="bi bi-menu-button-wide"></i><span>Messages From Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="logout.php">
          <i class="bi bi-menu-button-wide"></i><span>Log Out</span>
        </a>
      </li>
      <!-- End Components Nav -->
    </ul>
  </aside>
  <div  class="container-fluid " style="position:absolute;top:50px" >
  <div class="container-fluid " id="custumers" >
      <div class="row mt-5" >
          <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
          <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3  mx-auto ">
            <div class="card info-card sales-card">

                <div class="card-body" >
                  <h5 class="card-title">Sales <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                    <?php 
                       $nbr= Tvg::NBRbilletpermonth();
               
                      
                         echo " <h6> $nbr Billets </h6>";
                        ?>

                    </div>
                  </div>
                </div>

              </div>
          </div>
          <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3  mx-auto">
            <div class="card info-card revenue-card">

                <div class="card-body" >
                  <h5 class="card-title">Revenue <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      
                      <?php 
                       $curs= Tvg::Totalbilletpermonth();
               
                       while ($row =$curs->fetch() )
                       {
                         echo " <h6>".(int)$row[0]." DH</h6>";
                       }
                        ?>
                      

                    </div>
                  </div>
                </div>

              </div>
          </div>
          <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3  mx-auto " >
            <div class="card info-card customers-card">


                <div class="card-body" >
                  <h5 class="card-title">Views <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                      <?php
       $ip=$_SERVER['REMOTE_ADDR'];
      $datev=date('Y-m-d');
      $r=Tvg:: GetVuesNumber();
      echo($r." View");
        ?> </h6>

                    </div>
                  </div>

                </div>
              </div>
          </div>

      </div>
  </div>

  <div class="container-fluid" id="insights" >
   <div class="row mt-5" >
    <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
  <div class="card" >

    <div class="card-body">
      <h5 class="card-title">Insights<span>
    </div>
    <div class="container">
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<div class="card mt-4">
						<div class="card-header">Reservations</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="pie_chart"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mt-4">
						<div class="card-header">Visitors By City</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="doughnut_chart"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mt-4 mb-4">
						<div class="card-header">Visitors By Country</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="bar_chart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    </div>
     </div>
     </div>
     </div>

 <!-- TABLE VOYAGES -->
 <div class="container-fluid " style="position:absolute;top:50px">
 <div class="container-fluid" id="TABV" hidden="hidden">
   <div class="row mt-5" >
    <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
  <div class="card" >

    <div class="card-body">
      <h5 class="card-title">Les voyages <span>
      <input type="button" style='float:right;color:white;background-color:black;padding:8px;border-radius:8px;text-decoration:none;border:0;font-size:18px' value="ajouter +" data-toggle="modal" data-target="#addtravel">
      </span></h5>
      <br>
      <!-- Line Chart -->
      <div id="voyages">
      <table width="100%" id="myTable" class="display table-responsive">
        <br>
        <thead>
            <tr style="color:white"> 
                  <th style="width:15%">Depart</th>
                  <th style="width:15%">Destination</th> 
                  <th style="width:15%">Depart date</th> 
                  <th style="width:15%">Arrival date</th> 
                  <th style="width:15%">Depart hour</th>
                  <th style="width:15%">Arrival hour</th>
                  <th style="width:15%">Capacite</th>
                  <th style="width:15%">Way</th>
                  <th style="width:15%">Price</th>
                   <th style="width:15%"></th>
                   <th style="width:15%"></th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
            $curs= Tvg::getAllTravels();     
                    while ($row = $curs->fetch())
                            {
                        echo "<tr style='color:black'>";
                        
                        echo "<td style='color:black;width:15%'>$row[1] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[2] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[3] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[4] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[5] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[6] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[7] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[8] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[9] </td>"; 
                        echo "<td style='width:15%'><input type='button' value='modifier' class='modifier' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]' data-toggle='modal' data-target='#traveledite'></td>";
                        echo "<td style='width:15%'><input type='button' value='supprimer' class='supprimer' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";
                        echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>      
                          </div>
                          </div>
                          </div> 
                          </div>
                          </div>
                          </div> 
   <br>
   <div class="container-fluid" id="TABBV" hidden="hidden">
   <div class="row mt-5" >
    <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
  <div class="card" >

    <div class="card-body">
      <h5 class="card-title">Les Billet Des Voyages<span>
     </h5>
      <br>
      <!-- Line Chart -->
      <div id="reportsChart">
      <table width="100%"  id="myTable1" class="display table-responsive">
        <thead >
            <tr style="color:white;width:100%;height:40px"> 
                  <th style="width:20%;text-align:center">UserName</th>
                  <th style="width:10%;text-align:center">IdVoyage</th> 
                  <th style="width:20%;text-align:center">Places Number</th> 
                  <th style="width:50%;text-align:center">Seats</th> 
                  <th style="width:20%;text-align:center">Bought In</th>
                  <th style="width:20%;text-align:center">Price</th>
                  <th></th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
                  $curs= Tvg::getTravelBillet();     
                  while ($row = $curs->fetch())
                            {
                        echo "<tr style='color:black'>";
                        
                        echo "<td style='color:black;width:20%'>$row[1] </td>"; 
                        echo "<td style='color:black;width:10%'>$row[3] </td>"; 
                        echo "<td style='color:black;width:10%'>$row[5] </td>"; 
                        echo "<td style='color:black;width:40%'>$row[6] </td>"; 
                        echo "<td style='color:black;width:20%'>$row[7] </td>"; 
                      echo "<td style='color:black;width:20%'>$row[8] </td>"; 
                      echo "<td style='width:15%'><input type='button' value='Check' class='voirV' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";        
                        echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>
                          </div>
                          </div>
                          </div>  
                          </div>
                          </div>
                          </div> 
                          </div>
   <br>
   <div id="tour"  class="container-fluid" style="position:absolute;top:50px">
  
                          <div class="container-fluid" id="TABTC" hidden="hidden">
   <div class="row mt-5" >
    <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
  <div class="card" >

    <div class="card-body">
      <h5 class="card-title">Tours Categories<span>
      <input type="button" style='float:right;color:white;background-color:black;padding:8px;border-radius:8px;text-decoration:none;border:0;font-size:18px' value="ajouter +" data-toggle="modal" data-target="#addtourcategorie">
      </span></h5>
      <br>
      <!-- Line Chart -->
      <div id="reportsChart">
        <div id="tourscategories">
      <table width="100%" id="myTable2" class="display table-responsive">
        <br>
        <thead>
            <tr style="color:white"> 
                  <th style="width:20%">Tiltle</th>
                  <th style="width:60%">Description</th> 
                   <th style="width:10%"></th>
                   <th style="width:10%"></th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
            $curs= Tvg:: getToursCategories();     
                    while ($row = $curs->fetch())
                            {
                        echo "<tr style='color:black'>";
                        echo "<td style='color:black;width:30%'>$row[1] </td>"; 
                        echo "<td style='color:black;width:70%'>$row[2] </td>"; 
                        echo "<td style='width:10%'><input type='button' value='modifier' class='modifiertc' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]' data-toggle='modal' data-target='#tourcategorieedite'></td>";
                        echo "<td style='width:10%'><input type='button' value='supprimer' class='supprimertc' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>"; echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>     
    </div> 
                          </div>
                          </div>
                          </div> 
                          </div>
                          </div>
                          </div> 
                          <br>
  
  <div class="container-fluid" id="TABT" hidden="hidden">
<div class="row mt-5" >
<div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
<div class="card" >

<div class="card-body">
<h5 class="card-title">Tours<span>
<input type="button" style='float:right;color:white;background-color:black;padding:8px;border-radius:8px;text-decoration:none;border:0;font-size:18px' value="ajouter +" data-toggle="modal" data-target="#addtour">
</span></h5>
<br>
<!-- Line Chart -->
<div id="reportsChart">
  <div id="tou">
<table width="100%" id="myTable3" class="display table-responsive">
<br>
<thead>
<tr style="color:white"> 
                  <th style="text-align:center">Categorie</th> 
                  <th style="text-align:center">Title</th> 
                  <th style="text-align:center">City</th>
                  <th style="text-align:center">Depart Date</th>
                  <th style="text-align:center">Capacite</th>
                  <th style="text-align:center">picture</th>
                   <th style="text-align:center">Price</th>
                   <th></th>
                   <th></th>

</tr> 
</thead> 
<tbody> 
<?php  
$curs= Tvg:: getTours();     
while ($row = $curs->fetch())
    {
      echo "<tr style='color:black'>";
                        
      echo "<td style='color:black;width:5%'>$row[1] </td>"; 
      echo "<td style='color:black'>$row[2] </td>"; 
      echo "<td style='color:black'>$row[3] </td>"; 
      echo "<td style='color:black'>$row[4] </td>"; 
      echo "<td style='color:black'>$row[6] </td>"; 
      echo "<td style='color:black;width:200px;height:200px'><img src='$row[7]' width='100%' height='100%' style='border-radius:10px'> </td>"; 
      echo "<td style='color:black'>$row[8] </td>"; 
        echo "<td ><input type='button' value='modifier' class='modifiert' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]' data-toggle='modal' data-target='#touredite'></td>";
                        echo "<td ><input type='button' value='supprimer' class='supprimert' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";
      echo "</tr>"; 

    }
$curs->closeCursor();


 ?>
</tbody> 
</table>  
</div>    
  </div>
  </div>
  </div> 
  </div>
  </div>
  </div> 
  <br>
   <div class="container-fluid" id="TABTB" hidden="hidden">
   <div class="row mt-5" >
    <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
  <div class="card" >

    <div class="card-body">
      <h5 class="card-title">Les Billet Des Tours<span>
     </h5>
      <br>
      <!-- Line Chart -->
      <div id="reportsChart">
      <table width="100%"  id="myTable4" class="display table-responsive">
        <thead >
            <tr style="color:white;width:100%;height:40px"> 
                  <th style="width:20%;text-align:center">UserName</th>
                  <th style="width:1%;text-align:center">IdTours</th> 
                  <th style="width:20%;text-align:center">Places Number</th> 
                  <th style="width:20%;text-align:center">Seats</th> 
                  <th style="width:20%;text-align:center">Bought In</th>
                  <th style="width:20%;text-align:center">Price</th>
                  <th></th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
                  $curs= Tvg::getTourBillet();     
                  while ($row = $curs->fetch())
                            {
                              echo "<tr style='color:black'>";
                        
                              echo "<td style='color:black;width:20%'>$row[1] </td>"; 
                              echo "<td style='color:black;width:10%'>$row[4] </td>"; 
                              echo "<td style='color:black;width:10%'>$row[5] </td>"; 
                              echo "<td style='color:black;width:40%'>$row[6] </td>"; 
                              echo "<td style='color:black;width:20%'>$row[7] </td>"; 
                            echo "<td style='color:black;width:20%'>$row[8] </td>"; 
                            echo "<td style='width:15%'><input type='button' value='Check' class='voirT' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";        

      
                            
                              echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>
                          </div>
                          </div>
                          </div>  
                          </div>
                          </div>
                          </div> 
                          </div>
                            
   <br>
   <div id="user" class="container-fluid" style="position:absolute;top:50px">
   <div class="container-fluid" id="TABU" hidden="hidden">
   <div class="row mt-5" >
    <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
  <div class="card" >

    <div class="card-body">
      <h5 class="card-title">Users Informations<span>
     </h5>
      <br>
      <!-- Line Chart -->
      <div id="reportsChart">
        <div id="users">
      <table width="100%"  id="myTable5" class="display table-responsive">
        <thead >
            <tr style="color:white;width:100%;height:40px"> 
                  <th style="width:20%;text-align:center">UserName</th>
                  <th style="width:1%;text-align:center">Email</th> 
                  <th style="width:20%;text-align:center">Password</th> 
                  <th style="width:20%;text-align:center">Birthday</th> 
                  <th style="width:20%;text-align:center">Profile Picture</th>
                  <th style="width:20%;text-align:center">Admin</th>
                  <th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
                  $curs= Tvg::getUsers();     
                  while ($row = $curs->fetch())
                            {
                        echo "<tr style='color:black'>";
                        echo "<td style='color:black;width:20%'>$row[0] </td>"; 
                        echo "<td style='color:black;width:10%;'>$row[1] </td>"; 
                        echo "<td style='color:black;width:20%'>$row[2] </td>"; 
                        echo "<td style='color:black;width:20%'>$row[3] </td>"; 
                        echo "<td style='color:black;width:20%'><img src='$row[4]' width='100px' height='100px' style='border-radius:50%'> </td>"; 
                        if($row[5]==0){
                          echo "<td style='color:black;width:20%'>False</td>"; 
                          echo "<td style='width:15%'><input type='button' value='Add Admin' class='hire' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";        
                        }
                        else{
                          echo "<td style='color:black;width:20%'>True</td>"; 
                          echo "<td style='width:15%'><input type='button' value='Remove Admin' class='fire' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";        

                        }


                        echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>
    </div>
                          </div>
                          </div>
                          </div>  
                          </div>
                          </div>
                          </div> 
                          </div>
   <br>
   <div id="msg" class="container-fluid" style="position:absolute;top:50px">
   <div class="container-fluid" id="TABM" hidden="hidden">
   <div class="row mt-5" >
    <div class="col-sm-12 col-xs-12 col-md-0 col-xl-0 col-lg-3  mx-auto" id="faragh"></div>
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-9  mx-auto " >
  <div class="card" >

    <div class="card-body">
      <h5 class="card-title">Message From Users<span>
     </h5>
      <br>
      <!-- Line Chart -->
      <div id="reportsChart">
      <table width="100%"  id="myTable6" class="display table-responsive">
        <thead >
            <tr style="color:white;width:100%;height:40px"> 
                  <th style="width:20%;text-align:center">From The User</th>
                  <th style="width:20%;text-align:center">Email</th> 
                  <th style="width:20%;text-align:center">Subject</th> 
                  <th style="width:60%;text-align:center">Message</th> 
                  <th style="width:10%"></th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
                  $curs= Tvg::getMessages();     
                  while ($row = $curs->fetch())
                            {
                        echo "<tr style='width:100%;color:black'>";              
                        echo "<td style='width:20%;color:black'>$row[1] </td>"; 
                        echo "<td style='width:20%;color:black'>$row[2] </td>"; 
                        echo "<td style='width:20%;color:black'>$row[3] </td>"; 
                        echo "<td style='width:60%;color:black'>$row[4] </td>"; 
                        echo "<td style='width:10%'><input type='button' value='repondre' class='repondre1' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[2]' data-toggle='modal' data-target='#repondremodal'></td>";
                        echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>
                          </div>
                          </div>
                          </div>  
                          </div>
                          </div>
                          </div> 
                          </div>
   <br>



   <div class="modal fade" id="edit"  >
    <div class="modal-dialog" >
      <div class="modal-content" >
        <div class="modal-body" >
          <form action="adminCrud.php" method="POST" enctype="multipart/form-data" onsubmit="return verifiermodifier()">
          <div class="form-group mt-3">
                <input type="file" class="form-control"  id="chosefile"   rows="5"  name="im" hidden="hidden"/>
              </div>
              <div class="form-group mt-3" style="display:flex">
              <input  type="text" readonly name="chemaine" id="m5" value="<?=$profilepicture;?>" hidden="hidden" >
              </div>
              <br>
        <img src="<?=$profilepicture;?>" width="100px" height="100px" id="fake" style="margin-left:40%;cursor:pointer;border-radius:100%;border:3px solid #BC1616">
        <br>
        <br>
          <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Utilisateur</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="u"  value="<?=$user;?>" placeholder="Password" required>
    </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Email</label>
    <div class="col-sm-7">
      <input type="email" class="form-control" style="font-size:14px" value="<?=$email;?>" name="e" placeholder="Email" required>
    </div>
  </div>
  <br>
  <div class="form-group offset-1 row">
    <label  class="col-sm-4 col-form-label">Mot De Passe</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" value="<?=$pass;?>" placeholder="Password" name="p" required>
    </div>
  </div>
  <br>
  <br>
  <div class="form-group offset-2 row">
    <div class="col-sm-10">
      <input type="text" id="confir" class="form-control" style="text-align:center" name="conf"    placeholder="Confirmer avec Le code ci dessus" required>
    </div>
  </div>
  <br>
  <div class="text-center" id="config" style="color:red;"><?=$randomString;?></div>
<br>
<div id="remarque" class="text-center"></div>
<br>
      </div>
        <div class="modal-footer mx-auto" >
          <input class="btn btn-primary" type="submit" style="background-color:#BC1616;border:0" value="Modifier" name="modi">

          </form>
          <button class="btn btn-secondary"  id="dimiss">Fermer</button>
          <script>
             const b=document.getElementById("dimiss");
          b.addEventListener("click",function(){
            window.location="adminCrud.php";
            });
                const real=document.getElementById("chosefile");
                const fake=document.getElementById("fake");
                const chem=document.getElementById("m5");


                fake.addEventListener("click",function(){
                  real.click();
                });
                real.addEventListener("change",function(){
                  if(real.value){
                    chem.value=real.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                    const im=this.files[0];
                    if(im){
                      const reader=new FileReader();
                      reader.addEventListener("load",function(){
                        fake.setAttribute('src',reader.result);
                      });
                      reader.readAsDataURL(im);
                    }
                  }
                });
          </script>
          
        </div>
      </div>
    </div>
  </div> 

  <div id="addtravel" class="modal fade">
    <div class="modal-dialog" style="max-height:1200px;background-color:#15172b">
      <div class="modal-content" style="background-color:#15172b">
        <div class="modal-header">
          <button data-dismiss="modal" class="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form">
      <div class="title" style="text-align:center">Ajouter des nouveaux voyages</div>
      <div class="subtitle" style="text-align:center">Ajouter maintenant!</div>
      <form >
      <div class="input-container ic1">     
        <input id="vd" class="input" type="text" name="vd" placeholder="Ville depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="va" class="input" type="text" name="vr" placeholder="Ville arriver" required  />
      </div>
      <div class="input-container ic2">
        <input id="dd" class="input" type="text" name="dd" placeholder="Date depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="da" class="input" type="text" name="dr" placeholder="Date arriver" required  />
      </div>
      <div class="input-container ic2">
        <input id="hd" class="input" type="text" name="hd" placeholder="Heure depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="ha" class="input" type="text" name="hr" placeholder="Heure arriver" required  />
      </div>
      <div class="input-container ic2">
        <input id="c" class="input" type="number" name="cp" placeholder="Capacite" required  />
      </div>
      <div class="input-container ic2">
        <input id="o" class="input" type="text" name="ot" placeholder="Outile" required  />
      </div>
      <div class="input-container ic2">
        <input id="p" class="input" type="number" name="pr" placeholder="Prix"  required />
      </div>
      <br>
<div id="remarqueajoutertravel"></div>
</form>

    </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" id="fermer" data-dismiss="modal">Fermer</button>
          <button class="btn btn-primary" id="ajoutertravel" data-toggle="tooltip" data-placement="bottom" title="Bientôt disponible">Ajouter +</button>
        </div>
      </div>
    </div>
  </div>

  <div id="traveledite"  class="modal fade">
    <div class="modal-dialog" style="max-height:1200px;background-color:#15172b">
      <div class="modal-content" style="background-color:#15172b">
        <div class="modal-header">
          <button data-dismiss="modal" class="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form">
      <div class="title" style="text-align:center">Modifier Une Voyage</div>
      <div class="subtitle" style="text-align:center">Modifier maintenant!</div>
      <div id="editetravel"></div>

    </div>
        </div>
        
        <div class="modal-footer">
        <button class="btn btn-primary modifiertravel"    data-toggle="tooltip" data-placement="bottom" title="Bientôt disponible">Modifier</button>
          <button class="btn btn-secondary" id="fermer1" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <div id="addtourcategorie" class="modal fade">
    <div class="modal-dialog" style="background-color:#15172b">
      <div class="modal-content" style="background-color:#15172b">
        <div class="modal-header">
          <button data-dismiss="modal" class="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
      <div class="title" style="text-align:center">Ajouter des nouveaux categories</div>
      <div class="subtitle" style="text-align:center">Ajouter maintenant!</div>
      <div class="input-container ic1">     
        <input id="cn" class="input" type="text" name="vd" placeholder="Category Name" required  />
      </div>
      <div class="input-container ic2">
      <textarea id="cd" placeholder="Category Description" style="height:200px"  class="input">
</textarea>
      </div>
      <div style="height:150px"></div>
<div id="remarqueajoutertourcategorie"></div>

    </div>
    <div class="modal-footer">
          <button class="btn btn-secondary" id="fermertc" data-dismiss="modal">Fermer</button>
          <button class="btn btn-primary" id="ajoutertourcategorie" data-toggle="tooltip" data-placement="bottom" title="Bientôt disponible">Ajouter +</button>
        </div>
        </div>
       
      </div>
    </div>
  </div>

  <div id="tourcategorieedite"  class="modal fade">
    <div class="modal-dialog" style="background-color:#15172b">
      <div class="modal-content" style="background-color:#15172b">
        <div class="modal-header">
          <button data-dismiss="modal" class="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
      <div class="title" style="text-align:center">Modifier Une Categorie</div>
      <div class="subtitle" style="text-align:center">Modifier maintenant!</div>
      <div id="editecategorie"></div>

    </div>
        
        <div class="modal-footer">
        <button class="btn btn-primary modifierctegorie"    data-toggle="tooltip" data-placement="bottom" title="Bientôt disponible">Modifier</button>
          <button class="btn btn-secondary" id="fermert" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
              </div>

              <div id="repondremodal"  class="modal fade">
    <div class="modal-dialog" style="background-color:#15172b">
      <div class="modal-content" style="background-color:#15172b">
        <div class="modal-header">
          <button data-dismiss="modal" class="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
      <div class="title" style="text-align:center">Give Users Response</div>
      <div class="subtitle" style="text-align:center">Via Email!</div>
      <div class="input-container ic1">     
        <input id="subject" class="input" type="text" name="vd" placeholder="Subject" required  />
      </div>
      <div class="input-container ic2">
      <textarea id="msgg" placeholder="Message" style="height:200px"  class="input">
</textarea>
      </div>
      <div style="height:150px"></div>
<div id="repremarque"></div>
    </div>
        
        <div class="modal-footer">
        <button class="btn btn-primary repondre"    data-toggle="tooltip" data-placement="bottom" title="Bientôt disponible">Repondre</button>
          <button class="btn btn-secondary" id="fermerm" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
              </div>

              <div id="addtour" class="modal fade">
    <div class="modal-dialog" style="max-height:1200px;background-color:#15172b">
      <div class="modal-content" style="background-color:#15172b">
        <div class="modal-header">
          <button data-dismiss="modal" class="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form">
      <div class="title" style="text-align:center">Ajouter des nouveaux Tours</div>
      <div class="subtitle" style="text-align:center">Ajouter maintenant!</div>
      <form action="adminCrud.php" method="POST" enctype="multipart/form-data">
      <div class="input-container ic1">
      <input class="input" id="categorie" type="text" name="categorie" list="categories" placeholder="Choose Category..." >
                       <datalist id="categories">
                         <?php
                         $cur=Tvg::getToursCategories();
                         while($row=$cur->fetch()){
                           echo("<option value='$row[0]'>$row[1]");
                         }
                         $cur->closeCursor();
                         ?>
                       </datalist>
      </div>
      <div class="input-container ic2">
        <input id="tt" class="input" type="text" name="tt" placeholder="Tirte tour" required  />
      </div>
      <div class="input-container ic2">
        <input id="ci" class="input" type="text" name="ct" placeholder="City" required  />
      </div>
      <div class="input-container ic2">
        <input id="Ddt" class="input" type="text" name="ddt" placeholder="Date depart" required  />
      </div>
      <div class="input-container ic2">
        <input id="dt" class="input" type="text" name="dt" placeholder="Description Tour" required  />
      </div>
      <div class="input-container ic2">
        <input id="ca" class="input" type="number" name="ca" placeholder="Capacite" required  />
      </div>
      <div class="input-container ic2">
        <input id="i" class="input" type="text" name="image" placeholder="Image" required  />
      </div>
      <div class="input-container ic2">
        <input id="pr" class="input" type="number" name="pr" placeholder="Prix"  required />
      </div>
      <div class="input-container ic2">
        <input id="re" class="input" type="text" name="re" placeholder="Region"  required />
      </div>
  <div id="remarqueajoutertour"></div>
  

    </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" id="fermer" data-dismiss="modal">Fermer</button>
          <input type="submit" name="ajoutertour" class="btn btn-primary" id="ajoutertour" data-toggle="tooltip" data-placement="bottom" value="Ajouter +">
          </form>

        </div>
      </div>
    </div>
  </div>

  <div id="touredite"  class="modal fade">
    <div class="modal-dialog" style="background-color:#15172b">
      <div class="modal-content" style="background-color:#15172b">
        <div class="modal-header">
          <button data-dismiss="modal" class="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
      <div class="title" style="text-align:center">Modifier Une Tour</div>
      <div class="subtitle" style="text-align:center">Modifier maintenant!</div>
      <div id="editetour"></div>

    </div>
        
        </div>
      </div>
    </div>
  </div>
  <script>
    function afficher(){
      $.ajax({ 
     type: "POST", 
     url: "ShowTours.php", 
      }).done(function(res){
            $('#tou').html(res);
          })
    }
  </script>
  <?php
  if(isset($_POST['ajoutertour'])){
    $categorie=$_POST['categorie'];
    $tt=$_POST['tt'];
    $ct=$_POST['ct'];
    $ddt=$_POST['ddt'];
    $dt=$_POST['dt'];
    $ca=$_POST['ca'];
    $imagename=$_FILES['image']['name'];
    $imagelocationtemp=$_FILES['image']['tmp_name'];
    $pr=$_POST['pr'];
    $re=$_POST['re'];
    $image="toursimages/$ct $imagename";
    move_uploaded_file($imagelocationtemp,"toursimages/$ct $imagename");
    $r=Tvg::addtour($categorie,$tt,$ct,$ddt,$dt,$ca,$image,$pr,$re);
    if($r!=0){

      $emailsandnamescurs=Tvg::selecteallmailsandnamespub();
    $emails=array();
    if($emailsandnamescurs->rowCount()!=0){
      while($row=$emailsandnamescurs->fetch()){
       array_push($emails,$row[0]);
      }
    }
    $allmails= base64_encode(json_encode($emails));
    $categorienamee=Traitement::getcategorienamebyid($categorie);
    $list1=explode(" ",$categorienamee);
    $categoriename="";
    foreach ($list1 as $x) {
       $categoriename.=$x;
       $categoriename.=".";
    }

    $list2=explode(" ",$tt);
    $title="";
    foreach ($list2 as $x) {
       $title.=$x;
       $title.=".";
    }
    
    $list3=explode(" ",$ct);
    $city="";
    foreach ($list3 as $x) {
       $city.=$x;
    }

    $list4=explode(" ",$ddt);
    $dated="";
    foreach ($list4 as $x) {
       $dated.=$x;
       $dated.="at";
    }
    
    shell_exec("pythonfiles\sendpub.py $allmails $categoriename $title $city $dated");

    ?>
    <script>
       $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').removeAttr("hidden");
      $('#TABT').removeAttr("hidden");
      $('#TABTB').removeAttr("hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");
      afficher();
      window.location="adminCrud.php#TABT";
     
    </script>
    <?php
    }
    
  }
  ?>
  <?php
  if(isset($_POST['modifiertour'])){
    $categoriee=$_POST['categoriee'];
    $tte=$_POST['tte'];
    $cte=$_POST['cte'];
    $ddte=$_POST['ddte'];
    $dte=$_POST['dte'];
    $cae=$_POST['cae'];
    $pre=$_POST['pre'];
    $ree=$_POST['ree'];
    $tourid=$_POST['id'];
    if(isset($_FILES['imagee'])){
      $imagenamee=$_FILES['imagee']['name'];
    $imagelocationtempe=$_FILES['imagee']['tmp_name'];
    $imagee="toursimages/$cte $imagenamee";
    unlink($_POST['old']);
    move_uploaded_file($imagelocationtempe,"toursimages/$cte $imagenamee");
    $r=Tvg::editetour($tourid,$categoriee,$tte,$cte,$ddte,$dte,$cae,$imagee,$pre,$ree);
    }
    else{
      $imagee=$_POST['old'];
      $r=Tvg::editetour($tourid,$categoriee,$tte,$cte,$ddte,$dte,$cae,$imagee,$pre,$ree);

    }
   
   
    
    ?>
    <script>
       $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').removeAttr("hidden");
      $('#TABT').removeAttr("hidden");
      $('#TABTB').removeAttr("hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");
      afficher();
      window.location="adminCrud.php#TABT";


    </script>
    <?php
  }
  ?>

  
<script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script src="ass/js/Chart.bundle.min.js"></script>

   <script>
 	
$( function () {

  $('#ajoutertravel').click(function(){
    var vd=$('#vd').val();
    var va=$('#va').val();
    var dd=$('#dd').val();
    var da=$('#da').val();
    var hd=$('#hd').val();
    var ha=$('#ha').val();
    var c=$('#c').val();
    var o=$('#o').val();
    var p=$('#p').val();

    if(vd=="" || va=="" || dd=="" || da=="" || hd=="" || ha=="" || c=="" || o=="" || p==""){
      $('#remarqueajoutertravel').html("<h6 style='color:red;font-size:12pt' align='center'>Vous Devez remplir tout les champs</h6>");
    }
    if(dd>da){
      $('#remarqueajoutertravel').html("<h6 style='color:red;font-size:12pt' align='center'>La date d'Arriver doit etre plus que de depart!</h6>");
    }
    else{
      $.ajax({ 
     type: "POST", 
     url: "AjouterTravel.php", 
     data: 'vd='+vd+'&va='+va+'&dd='+dd+'&da='+da+'&hd='+hd+'&ha='+ha+'&c='+c+'&o='+o+'&p='+p
      }).done(function(res){
            $('#voyages').html(res);
          })
          $('#vd').val('');
    $('#va').val('');
    $('#dd').val('');
    $('#da').val('');
    $('#hd').val('');
    $('#ha').val('');
    $('#c').val('');
    $('#o').val('');
    $('#p').val('');
    $('#fermer').click();
          
    }


  })

  $('.modifier').click(function(){
    
      var travelid=$(this).attr('id');
      $.ajax({ 
     type: "POST", 
     url: "remplirmodaledittravel.php", 
     data: 'travelid='+travelid
      }).done(function(res){
            $('#editetravel').html(res);
          })
      $('.modifiertravel').attr('id',travelid);
   
  })
  $('.modifiertravel').click(function(){
    var travelid=$(this).attr('id');
    var vd=$('#vde').val();
    var va=$('#vae').val();
    var dd=$('#dde').val();
    var da=$('#dae').val();
    var hd=$('#hde').val();
    var ha=$('#hae').val();
    var c=$('#ce').val();
    var o=$('#oe').val();
    var p=$('#pe').val();
    $.ajax({ 
     type: "POST", 
     url: "ModifierTravel.php", 
     data: 'travelid='+travelid+'&vd='+vd+'&va='+va+'&dd='+dd+'&da='+da+'&hd='+hd+'&ha='+ha+'&c='+c+'&o='+o+'&p='+p
      }).done(function(res){
            $('#voyages').html(res);
          })
          $('#fermer1').click();

  })

  $('.supprimer').click(function(){
    var idtravel=$(this).attr('id');
    $.ajax({ 
     type: "POST", 
     url: "Removetravel.php", 
     data: 'travelid='+idtravel
      }).done(function(res){
            $('#voyages').html(res);
          })
  })

  $('.voirV').click(function(){
    window.location="billet.php?idbillet="+$(this).attr('id')+"&type=voyage";
  })

  $('#ajoutertourcategorie').click(function(){
    var cn=$('#cn').val();
    var cd=$('#cd').val();
    if(cn=="" || cd==""){
      $('#remarqueajoutertourcategorie').html("<h6 style='color:red;font-size:12pt' align='center'>Vous Devez remplir tout les champs</h6>");
    }
    else{
      $.ajax({ 
     type: "POST", 
     url: "AjouterTourCategory.php", 
     data: 'cn='+cn+'&cd='+cd
      }).done(function(res){
            $('#tourscategories').html(res);
          })
    $('#cn').val('');
    $('#cd').val('');
    $('#fermertc').click();
    }
   
          
  })

  $('.modifiertc').click(function(){
    var categorieid=$(this).attr('id');
    $.ajax({ 
     type: "POST", 
     url: "remplirmodaleditecategorie.php", 
     data: 'categorieid='+categorieid
      }).done(function(res){
            $('#editecategorie').html(res);
          })
          $('.modifierctegorie').attr('id',categorieid);


  })
  $('.modifierctegorie').click(function(){
    var categorieid=$(this).attr('id');
    var cn=$('#cne').val();
    var cd=$('#cde').val();
    $.ajax({ 
     type: "POST", 
     url: "ModifierCategorie.php", 
     data: 'categorieid='+categorieid+'&cn='+cn+'&cd='+cd
      }).done(function(res){
            $('#tourscategories').html(res);
          })
          $('#fermert').click();
  })

$('.supprimertc').click(function(){
  var categorieid=$(this).attr('id');
  $.ajax({ 
     type: "POST", 
     url: "Removecategorie.php", 
     data: 'categorieid='+categorieid
      }).done(function(res){
            $('#tourscategories').html(res);
          })
})


$('.modifiert').click(function(){
  var tourid=$(this).attr('id');
    $.ajax({ 
     type: "POST", 
     url: "remplirmodaleditetour.php", 
     data: 'tourid='+tourid
      }).done(function(res){
            $('#editetour').html(res);
          })
          $('.modifiertour').attr('id',tourid);
})

$('.supprimert').click(function(){
  var tourid=$(this).attr('id');
  $.ajax({ 
     type: "POST", 
     url: "Removetour.php", 
     data: 'tourid='+tourid
      }).done(function(res){
            $('#tou').html(res);
          })
       $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').removeAttr("hidden");
      $('#TABT').removeAttr("hidden");
      $('#TABTB').removeAttr("hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");
      afficher();
      window.location="adminCrud.php#TABT";
})

$('.voirT').click(function(){
  window.location="billet.php?idbillet="+$(this).attr('id')+"&type=Tour";

})

$('.hire').click(function(){
  var user=$(this).attr('id');
  $.ajax({ 
     type: "POST", 
     url: "addadmin.php", 
     data: 'user='+user
      }).done(function(res){
            $('#users').html(res);
          })
})

$('.fire').click(function(){
  var user=$(this).attr('id');
  $.ajax({ 
     type: "POST", 
     url: "removeadmin.php", 
     data: 'user='+user
      }).done(function(res){
            $('#users').html(res);
          })
})

$('.repondre1').click(function(){
  var user=$(this).attr('id');
  $('.repondre').attr('id',user);
})

$('.repondre').click(function(){
  $('#repremarque').html("<h6 style='color:yellow;font-size:12pt' align='center'>Please Wait A Moment!</h6>");
  var user=$(this).attr('id');
  var subject=$('#subject').val();
  var msg=$('#msgg').val();
  if(subject=="" || msg==""){
    $('#repremarque').html("<h6 style='color:red;font-size:12pt' align='center'>Vous Devez remplir tout les champs</h6>");
  }
  else{
    $.ajax({ 
     type: "POST", 
     url: "repondreemail.php", 
     data: 'user='+user+'&subject='+subject+'&msg='+msg
      }).done(function(res){
            $('#repremarque').html(res);
          })
  }
  
})

  $('#dd').focus(function(){
    $(this).attr('type', 'date');
  })
  $('#da').focus(function(){
    $(this).attr('type', 'date');
  })
  $('#hd').focus(function(){
    $(this).attr('type', 'time');
  })
  $('#ha').focus(function(){
    $(this).attr('type', 'time');
  })
  $('#Ddt').focus(function(){
    $(this).attr('type', 'datetime-local');
  })
  $('#i').focus(function(){
    $(this).attr('type', 'file');
  })



  $.ajax({
                type:"POST",
                  url:"VisitorsPerCountryinsights.php",
                  dataType:'json'
                }).done(function(msg){
                  //  $('#result').html('');
                    var Countries=msg[0];
                    var colors=msg[1];
                    var counter=msg[2];
                    console.log(msg)

                    var chart_data = {
		            labels:Countries,
	            	datasets:[
			        {
			             label:'',
			             backgroundColor:colors,
			             data:counter
			        }
					        ]
	            	};

                    var group_chart1 = $('#bar_chart');

                    var graph1 = new Chart(group_chart1, {
	                	type:"pie",
	                	data:chart_data
	            	});

                  /*  $('#result').append(graph1);*/


                });   
    
  $.ajax({
                type:"POST",
                  url:"Reservationinsights.php",
                  dataType:'json'
                }).done(function(msg){
                  //  $('#result').html('');
                    var Types=msg[0];
                    var colors=msg[1];
                    var counter=msg[2];
                    console.log(msg)

                    var chart_data = {
		            labels:Types,
	            	datasets:[
			        {
			             label:'',
			             backgroundColor:colors,
			             data:counter
			        }
					        ]
	            	};

                    var group_chart1 = $('#pie_chart');

                    var graph1 = new Chart(group_chart1, {
	                	type:"pie",
	                	data:chart_data
	            	});

                  /*  $('#result').append(graph1);*/


                });   


                $.ajax({
                type:"POST",
                  url:"Visitorsinsights.php",
                  dataType:'json'
                }).done(function(msg){
                  //  $('#result').html('');
                    var Cities=msg[0];
                    var colors=msg[1];
                    var counter=msg[2];
                    console.log(msg)

                    var chart_data = {
		            labels:Cities,
	            	datasets:[
			        {
			             label:'',
			             backgroundColor:colors,
			             data:counter
			        }
					        ]
	            	};

                    var group_chart1 = $('#doughnut_chart');

                    var graph1 = new Chart(group_chart1, {
	                	type:"pie",
	                	data:chart_data
	            	});

                  /*  $('#result').append(graph1);*/


                });   
    
    $('#myTable').DataTable();
    $('#myTable1').DataTable();
    $('#myTable2').DataTable();
    $('#myTable3').DataTable();
    $('#myTable4').DataTable();
    $('#myTable5').DataTable();
    $('#myTable6').DataTable();

    //menu work

    $('#dashbord').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').removeAttr("hidden");
      $('#insights').removeAttr("hidden");
      


    })

    $('#travelSet').click(function(){
      $('#TABV').removeAttr("hidden");
      $('#TABBV').removeAttr("hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })

    $('#PackageSet').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').removeAttr("hidden");
      $('#TABT').removeAttr("hidden");
      $('#TABTB').removeAttr("hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })

    $('#UsersSet').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').removeAttr("hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })

    $('#MSG').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').removeAttr("hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })


    $('#dashbord1').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').removeAttr("hidden");
      $('#insights').removeAttr("hidden");
      


    })

    $('#travelSet1').click(function(){
      $('#TABV').removeAttr("hidden");
      $('#TABBV').removeAttr("hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })

    $('#PackageSet1').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').removeAttr("hidden");
      $('#TABT').removeAttr("hidden");
      $('#TABTB').removeAttr("hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })

    $('#UsersSet1').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').removeAttr("hidden");
      $('#TABM').attr("hidden","hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })

    $('#MSG1').click(function(){
      $('#TABV').attr("hidden","hidden");
      $('#TABBV').attr("hidden","hidden");
      $('#TABTC').attr("hidden","hidden");
      $('#TABT').attr("hidden","hidden");
      $('#TABTB').attr("hidden","hidden");
      $('#TABU').attr("hidden","hidden");
      $('#TABM').removeAttr("hidden");
      $('#custumers').attr("hidden","hidden");
      $('#insights').attr("hidden","hidden");


    })


    $('.nav-link').click(function(){
      $('.nav-link').removeClass('collapsed');
      $(this).addClass('collapsed');
    })
    
    var ind=0;
    $('#menu').click(function(){
      if(ind==0){
        $('#sidebar1').css('left','0');
        ind=1;
      }
      else{
        $('#sidebar1').css('left','-300px');
        ind=0;
      }
    })




} );
    
    </script>





</body>
</html>