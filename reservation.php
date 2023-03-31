<?php
include_once 'generalTraitement.php';
session_start();
if(!isset($_SESSION['user'])){
    header("location:index.php");
  }


  include_once 'UsersManager.php';
$username="";
$password="";
if(isset($_COOKIE['user'])){
  $username=$_COOKIE['user'];
}
if (isset($_COOKIE['password'])) {
  $password=$_COOKIE['password'];
}

if(isset($_SESSION['user'])){

if(empty($_SESSION['id']) && empty($_GET['id'])){
  header("location:index.php");
}

else{
  $type="";
  if(!empty($_SESSION['id'])){
    $id=substr($_SESSION['id'], 0, -1);
    $t=substr($_SESSION['id'], -1);
    $_SESSION['id']="";
  }
  else{
    $res=$_GET['id'];
    $id=substr($res, 0, -1);
    $t=substr($res, -1);
    $_GET['id']="";
  }
  if($t=="v"){
    $type="voyage";
    
  }
  else{
    $type="Tour";
  }
  
  if($type=="Tour"){
    $empty=Traitement::emptyTourPlaces($id);}
  else{
    $empty=Traitement::travelEpmtyPlaces($id);
  }
    $user=$_SESSION['user'];
    $profilepicture=UsersManager::getProfilePictureByUserName($user);
    $email=UsersManager::getEmailByUserName($user);
    $pass=UsersManager::getPassByUserName($user);

}
$n=15;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}
 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui">
    <title>Reservation Section</title>
    <link rel="stylesheet" href="ass\map.css">
    <link href="ass\css\bootstrap-grid.css" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.css.map" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.min.css.map" rel="stylesheet">
    <link href="ass\css\bootstrap-reboot.css" rel="stylesheet">
    <link href="ass\css\bootstrap-reboot.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap.css" rel="stylesheet">
    <link href="ass\css\bootstrap.css.map" rel="stylesheet">
    <link href="ass\css\bootstrap.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap.min.css.map" rel="stylesheet">
    <link href="ass\css\glyphicones.css" rel="stylesheet">
    <link href="ass\cs.css" rel="stylesheet">
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

  

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="ass/reservation.css" rel="stylesheet">

</head>
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
<style>
  /*--------------------------------------------------------------
# Counts
--------------------------------------------------------------*/
body{
  background-image:url('im/bgreservation.png');
  background-size:cover;
  background-position:top right;
}
.counts {
  padding: 70px 0 60px;
}
.counts .count-box {
  padding: 30px 30px 25px 30px;
  width: 100%;
  position: relative;
  text-align: center;
  background: #BC1616;
  color:white;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;}
.counts .count-box i {
  position: absolute;
  top: -25px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 24px;
  background: black;
  padding: 12px;
  color: white;
  border-radius: 50px;
  line-height: 0;
}
.counts .count-box span {
  font-size: 36px;
  display: block;
  font-weight: 600;
  color: #fff;
}
.counts .count-box p {
  padding: 0;
  margin: 0;
  font-family: "Raleway", sans-serif;
  font-size: 14px;
}

</style>
<body >
  
    <nav class="sticky-top">
        <div  class="logo"><a href="index.php"><img src="im\Good_Travel-removebg-preview.png" height="75px" width="180px" style="padding-bottom: 12px;"></a></div>
       
        <?php
          if(!empty($user)){
            ?>
          <div class="dropdown" style="liste-style:none;margin-top:-10px;font-size: 17px;font-weight: 600;letter-spacing: 1px;">
              <a class="dropdown-toggle"  style="text-decoration: none;color: #263238;font-size: 17px;font-weight: 600;letter-spacing: 1px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$user; ?></a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a><img src="<?=$profilepicture; ?>" width="50px" height="50px" style="border-radius:50%;border:1px solid black;margin-left:31%"></a>
             <a class="dropdown-item" style="color:black;text-align:center" href=""  data-toggle="modal" data-target="#edit">Settings</a>
             <a class="dropdown-item" style="color:black;text-align:center" href="" data-toggle="modal" data-target="#archive">Archive</a>
             <a class="dropdown-item" style="color:black;text-align:center" href="logout.php">Log OUT</a>
            </div>
        </div>
            <?php
          }
          ?>
          <?php
        if(empty($user)){
          ?>
        <li><a class="nav-item" id="login1"  data-toggle="modal" data-target="#lo">Login</a></li>
          <?php
        }
        
        ?>
      </nav>
      <!-- ======= Counts ======= -->
    <div class="counts container">

<div class="row">

  

  <div class="col-lg-3 col-md-6 mt-5 mt-md-0 offset-lg-3" >
    <div class="count-box">
      <i class="bi bi-journal-richtext"></i>
      <span data-purecounter-start="0" data-purecounter-end="<?=$empty; ?>" data-purecounter-duration="1" class="purecounter"></span>
      <p>Empty Places</p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
    <div class="count-box">
      <i class="bi bi-headset"></i>
      <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
      <p>Hours Of Support</p>
    </div>
  </div>

  

</div>

</div><!-- End Counts -->
     
      <section style="background-color:#BC1616;box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;;padding:20px" id="contact" class="container contact mb-5" data-aos="fade-up" data-aos-delay="200">
    <div class="container">

      <div class="section-title">
        <h2 style="color:white">Reservation</h2>
        <p style="color:white">Reserve Your Place Right Now</p>
      </div>

      <div class="row mt-2">

        <?php
        if($type=="voyage"){
          $empty=Traitement::travelEpmtyPlaces($id);
          $curs=Traitement::getTravelByID($id);
          while($row=$curs->fetch()){
            ?>
            <form class="php-email-form mt-4" id="h" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                   <h3 align="center" style="color:#BC1616">Travel Informations</h3>
                   <br>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Depart City</label>
                       <input type="text" value="<?=$row[1]; ?>" readonly id="dep"  class="form-control"  required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Destination City</label>
                       <input type="text" value="<?=$row[2]; ?>" readonly id="des" class="form-control"  required>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Depart Time</label>
                       <input type="text" id="dated" readonly value="<?=$row[3]; ?> at <?=$row[5]; ?>" name="name" class="form-control"  required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Arrival Time</label>
                       <input type="text" id="datea" readonly value="<?=$row[4]; ?> at <?=$row[6]; ?>" class="form-control"    required>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Travel By</label>
                       <input type="text" id="way" readonly value="<?=$row[8]; ?>" name="name" class="form-control"   required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Places Number  (Empty places : <?=$empty; ?>)</label>
                       <input type="number" id="np" class="form-control"  min="1" max="<?=$empty; ?>"  required>
                     </div>       
                   </div>
                   
                   <div id="nextremarque"></div>
                   <br>
                   <div class="text-center"><button id="next" type="button" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616">Next</button></div>
                 </form>
           
                 <form class="php-email-form mt-4" id="h2" hidden="hidden" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                 <h3 align="center" style="color:#BC1616">Payment Informations</h3>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Your Name</label>
                       <input type="text" readonly   class="form-control" value="<?=$user; ?>" required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Card Number</label>
                       <input type="text" id="cardn" class="form-control"  name="email"  required>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Cardholder name</label>
                       <input type="text" id="cardholdername" name="name" class="form-control" required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Crypto</label>
                       <input type="text" id="crypto" class="form-control"  required>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>EXP Yaer</label>
                       <select id="expyear">
                         <?php
                         for($i=2022;$i<2032;$i++){
                           echo("<option value='$i'>$i</option>");
                         }
                         ?>
                       </select>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>EXP Month</label>
                     <select id="expmonth">
                         <?php
                         for($i=1;$i<13;$i++){
                           echo("<option value='$i'>$i</option>");
                         }
                         ?>
                       </select>          </div>
                   </div>
                   <div id="payremarque"></div>
                   <div style="display:flex;justify-content:center">
                   <div class="text-center"><button id="back" type="button" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616">Back</button></div>
                   <div class="text-center"><button id="pay" type="button" style="margin-left:10px;border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616">Get Your Ticket</button></div>
                 
                  </div>
                  </form>
                     <?php
          }
         
        }
        ?>
     

     <?php
        if($type=="Tour"){
          $empty=Traitement::emptyTourPlaces($id);
          $curs=Traitement::getTourById($id);
          while($row=$curs->fetch()){
            $categname=Traitement::getcategorienamebyid($row[1]);
            ?>
            <form class="php-email-form mt-4" id="h" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                   <h3 align="center" style="color:#BC1616">Tour Informations</h3>
                   <br>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Tour Type</label>
                       <input type="text" value="<?=$categname; ?>" readonly id="dep"  class="form-control"  required>
                     </div>
                     <div class="col-md-6 form-group">
                     <label>Tour Name</label>
                       <input type="text" value="<?=$row[2]; ?>" readonly id="dep"  class="form-control"  required>
                     </div>
                     
                   </div>
                   <div class="row">
                   <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Tour City</label>
                       <input type="text" value="<?=$row[3]; ?>" readonly id="des" class="form-control"  required>
                     </div>
                     <div class="col-md-6 form-group">
                     <label>Depart Time</label>
                       <input type="text" id="dated" readonly value="<?=$row[4]; ?>"  name="name" class="form-control"  required>
                     </div>
                    
                   </div>
                   <div class="row">
                   <div class="col-md-6 form-group">
                     <label>Description</label>
                       <input type="text" id="way" readonly value="<?=$row[5]; ?>" name="name" class="form-control"   required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Places Number (Empty places : <?=$empty; ?>)</label>
                       <input type="number" id="np" class="form-control"  min="1" max="<?=$empty; ?>"  required>
                     </div>       
                   </div>
                   
                   <div id="nextremarque"></div>
                   <br>
                   <div class="text-center"><button id="next" type="button" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616">Next</button></div>
                 </form>
           
                 <form class="php-email-form mt-4" id="h2" hidden="hidden" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                 <h3 align="center" style="color:#BC1616">Payment Informations</h3>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Your Name</label>
                       <input type="text" readonly   class="form-control" value="<?=$user; ?>" required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Card Number</label>
                       <input type="text" id="cardn" class="form-control"  name="email"  required>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>Cardholder name</label>
                       <input type="text" id="cardholdername" name="name" class="form-control" required>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>Crypto</label>
                       <input type="text" id="crypto" class="form-control"  required>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6 form-group">
                     <label>EXP Yaer</label>
                       <select id="expyear">
                         <?php
                         for($i=2022;$i<2032;$i++){
                           echo("<option value='$i'>$i</option>");
                         }
                         ?>
                       </select>
                     </div>
                     <div class="col-md-6 form-group mt-3 mt-md-0">
                     <label>EXP Month</label>
                     <select id="expmonth">
                         <?php
                         for($i=1;$i<13;$i++){
                           echo("<option value='$i'>$i</option>");
                         }
                         ?>
                       </select>          </div>
                   </div>
                   <div id="payremarque"></div>
                   <div style="display:flex;justify-content:center">
                   <div class="text-center"><button id="back" type="button" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616">Back</button></div>
                   <div class="text-center"><button id="pay" type="button" style="margin-left:10px;border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616">Get Your Ticket</button></div>
                 
                  </div>
                  </form>
                     <?php
          }
         
        }
        ?>
    </div>
  </section><!-- End Contact Section -->

  <div class="modal fade" id="edit"  >
    <div class="modal-dialog" >
      <div class="modal-content" >
        <div class="modal-body" >
          <form action="reservation.php" method="POST" enctype="multipart/form-data" onsubmit="return verifiermodifier()">
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
            window.location="reservation.php";
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

  <div class="modal fade" id="archive">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Your Reservation's Archive</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          $r=Traitement::getreservationsbyUser($user);
          ?>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    $(function(){
      var empt=<?=$empty; ?>;
      var np=0;
      $('#next').click(function(){
        np=$('#np').val();
        if(np==0){
          $('#nextremarque').html("<h6 style='color:red;font-size:12pt' align='center'>vous devez remplir tous les champs!</h6>");
        }
        if(np>empt){
          $('#nextremarque').html("<h6 style='color:red;font-size:12pt' align='center'>Le nombre de places que vous aves saisir est plus que le possible!</h6>");
        }
        if(np<=empt && np!=0){
          $('#h').attr('hidden','hidden');
          $('#h2').removeAttr('hidden');
        }

      })
      
      $('#back').click(function(){
        $('#h2').attr('hidden','hidden');
          $('#h').removeAttr('hidden');
          $('#np').val(np);
      })
      
      $('#pay').click(function(){
        var cardnumber=$('#cardn').val();
        var cardholder=$('#cardholdername').val();
        var crypto=$('#crypto').val();
        var expyear=$('#expyear').val();
        var expmonth=$('#expmonth').val();
        if(cardnumber=="" || cardholder=="" || crypto=="" || expyear=="" || expmonth==""){
          $('#payremarque').html("<h6 style='color:red;font-size:12pt' align='center'>vous devez remplir tous les champs!</h6>");
        }
        else{
          $.ajax({ 
     type: "POST", 
     url: "payment.php", 
     data: 'user='+'<?=$user?>'+'&type='+'<?=$type?>'+'&id='+'<?=$id?>'+'&nbplace='+np+'&cardnumber='+cardnumber+'&cardholder='+cardholder+'&crypto='+crypto+'&expyear='+expyear+'&expmonth='+expmonth
      }).done(function(res){
            $('#payremarque').html(res);
          })
        }
      })

    })
  </script>
    
</body>
</html>