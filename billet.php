<?php
session_start();

$idb=$_GET['idbillet'];
$type=$_GET['type'];
$hascouponornot=$_GET['cou'];
include_once 'generalTraitement.php';
$curs=Traitement::getBilletById($idb);
$user="";
$id="";
$placesnumber="";
$nbrplace="";
$depville="";
$desville="";
$depdate="";
$desdate="";
$depheure="";
$desheure="";
$outile="";
$prix="";
$categid="";
$titre="";
$city="";
$date="";
$prix="";
$categ="";
$da="";
if($type=="voyage"){
    while($row=$curs->fetch()){
        $user=$row[1];
        $id=$row[3];
        $nbrplace=$row[5];
        $placesnumber=$row[6];
        $da=$row[7];
    }
    $curs1=Traitement::getTravelByID($id);
    while($row=$curs1->fetch()){
        $depville=$row[1];
        $desville=$row[2];
        $depdate=$row[3];
        $desdate=$row[4];
        $depheure=$row[5];
        $desheure=$row[6];
        $outile=$row[8];
        $prix=$row[9];
    }
    $curs1->closeCursor();
}
if($type=="Tour"){
    while($row=$curs->fetch()){
        $user=$row[1];
        $id=$row[4];
        $nbrplace=$row[5];
        $placesnumber=$row[6];
        $da=$row[7];
    }
    $curs1=Traitement::getTourByID($id);
    while($row=$curs1->fetch()){
        $categid=$row[1];
        $titre=$row[2];
        $city=$row[3];
        $date=$row[4];
        $prix=$row[8];
    }
    $curs1->closeCursor();
    $categ=Traitement::getcategorienamebyid($categid);

}
$curs->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Travel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />


  <!-- Template Main CSS File -->
</head>
<style>
   body{
  margin: 0;
  padding: 0;
  background: #fff;
}

.box{
  position: absolute;
  top: calc(50% - 125px);
  top: -webkit-calc(50% - 125px);
  left: calc(50% - 300px);
  left: -webkit-calc(50% - 300px);
}

.ticket{
  width: 600px;
  height: 250px;
  background: #BC1616;
  border-radius: 3px;
  box-shadow: 0 0 100px #aaa;
  border-top: 1px solid #BC1616;;
  border-bottom: 1px solid #BC1616;;
}

.left{
  margin: 0;
  padding: 0;
  list-style: none;
  position: absolute;
  top: 0px;
  left: -5px;
}

.left li{
  width: 0px;
  height: 0px;
}

.left li:nth-child(-n+2){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #BC1616;;
}

.left li:nth-child(3),
.left li:nth-child(6){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #EEEEEE;
}

.left li:nth-child(4){
  margin-top: 8px;
  margin-left: 2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #EEEEEE;
}

.left li:nth-child(5){
  margin-top: 8px;
  margin-left: -1px;
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent; 
  border-right: 6px solid #EEEEEE;
}

.left li:nth-child(7),
.left li:nth-child(9),
.left li:nth-child(11),
.left li:nth-child(12){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #E5E5E5;
}

.left li:nth-child(8){
  margin-top: 7px;
  margin-left: 2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #E5E5E5;
}

.left li:nth-child(10){
  margin-top: 7px;
  margin-left: 1px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #E5E5E5;
}

.left li:nth-child(13){
  margin-top: 7px;
  margin-left: 2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #BC1616;;
}

.left li:nth-child(14){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #BC1616;;
}

.right{
  margin: 0;
  padding: 0;
  list-style: none;
  position: absolute;
  top: 0px;
  right: -5px;
}

.right li:nth-child(-n+2){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #BC1616;;
}

.right li:nth-child(3),
.right li:nth-child(4),
.right li:nth-child(6){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #EEEEEE;
}

.right li:nth-child(5){
  margin-top: 8px;
  margin-left: -2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #EEEEEE;
}

.right li:nth-child(8),
.right li:nth-child(9),
.right li:nth-child(11){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #E5E5E5;
}

.right li:nth-child(7){
  margin-top: 7px;
  margin-left: -3px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #E5E5E5;
}

.right li:nth-child(10){
  margin-top: 7px;
  margin-left: -2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #E5E5E5;
}

.right li:nth-child(12){
  margin-top: 7px;
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent; 
  border-left: 6px solid #E5E5E5;
}

.right li:nth-child(13),
.right li:nth-child(14){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #BC1616;;
}

.ticket:after{
  content: '';
  position: absolute;
  right: 200px;
  top: 0px;
  width: 2px;
  height: 250px;
  box-shadow: inset 0 0 0 #BC1616,
    inset 0 -10px 0 #BC1616,
    inset 0 -20px 0 #BC1616,
    inset 0 -30px 0 #BC1616,
    inset 0 -40px 0 #BC1616,
    inset 0 -50px 0 #999999,
    inset 0 -60px 0 #BC1616,
    inset 0 -70px 0 #999999,
    inset 0 -80px 0 #BC1616,
    inset 0 -90px 0 #999999,
    inset 0 -100px 0 #BC1616,
    inset 0 -110px 0 #999999,
    inset 0 -120px 0 #BC1616,
    inset 0 -130px 0 #999999,
    inset 0 -140px 0 #BC1616,
    inset 0 -150px 0 #BC1616,
    inset 0 -160px 0 #EEEEEE,
    inset 0 -170px 0 #BC1616,
    inset 0 -180px 0 #EEEEEE,
    inset 0 -190px 0 #BC1616,
    inset 0 -200px 0 #EEEEEE,
    inset 0 -210px 0 #BC1616,
    inset 0 -220px 0 #BC1616,
    inset 0 -230px 0 #BC1616,
    inset 0 -240px 0 #BC1616,
    inset 0 -250px 0 #BC1616;
}

.ticket:before{
  content: '';
  position: absolute;
  z-index: 5;
  right: 199px;
  top: 0px;
  width: 1px;
  height: 250px;
  box-shadow: inset 0 0 0 #BC1616,
    inset 0 -10px 0 #BC1616,
    inset 0 -20px 0 #BC1616,
    inset 0 -30px 0 #BC1616,
    inset 0 -40px 0 #BC1616,
    inset 0 -50px 0 #BC1616,
    inset 0 -60px 0 #BC1616,
    inset 0 -70px 0 #BC1616,
    inset 0 -80px 0 #BC1616,
    inset 0 -90px 0 #FFFFFF,
    inset 0 -100px 0 #BC1616,
    inset 0 -110px 0 #FFFFFF,
    inset 0 -120px 0 #BC1616,
    inset 0 -130px 0 #FFFFFF,
    inset 0 -140px 0 #BC1616,
    inset 0 -150px 0 #FFFFFF,
    inset 0 -160px 0 #EEEEEE,
    inset 0 -170px 0 #FFFFFF,
    inset 0 -180px 0 #EEEEEE,
    inset 0 -190px 0 #FFFFFF,
    inset 0 -200px 0 #EEEEEE,
    inset 0 -210px 0 #FFFFFF,
    inset 0 -220px 0 #BC1616,
    inset 0 -230px 0 #BC1616,
    inset 0 -240px 0 #BC1616,
    inset 0 -250px 0 #BC1616;
}

.content{
  position: absolute;
  top: 40px;
  width: 100%;
  height: 170px;
  background: #eee;
}

.airline{
  position: absolute;
  top: 10px;
  left: 10px;
  font-family: Arial;
  font-size: 20px;
  font-weight: bold;
  color: white;
}

.boarding{
  position: absolute;
  top: 10px;
  right: 220px;
  font-family: Arial;
  font-size: 18px;
  color: rgba(255,255,255,0.6);
}

.jfk{
  position: absolute;
  top: 10px;
  left: 20px;
  font-family: Arial;
  font-size: 38px;
  color: #222;
}

.sfo{
  position: absolute;
  top: 10px;
  left: 200px;
  font-family: Arial;
  font-size: 38px;
  color: #222;
}

.plane{
  position: absolute;
  left: 160px;
  top: 0px;
}

.sub-content{
  background: #e5e5e5;
  width: 100%;
  height: 100px;
  position: absolute;
  top: 70px;
}

.watermark{
  position: absolute;
  left: 5px;
  top: -10px;
  font-family: Arial;
  font-size: 110px;
  font-weight: bold;
  color: rgba(209, 31, 31, 0.05);
}

.name{
  position: absolute;
  top: 10px;
  left: 10px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.name span{
  color: #555;
  font-size: 17px;
}

.flight{
  position: absolute;
  top: 10px;
  left: 180px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.flight span{
  color: #555;
  font-size: 17px;
}

.gate{
  position: absolute;
  top: 10px;
  left: 280px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.gate span{
  color: #555;
  font-size: 17px;
}


.seat{
  position: absolute;
  top: 10px;
  left: 350px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.seat span{
  color: #555;
  font-size: 17px;
}

.boardingtime{
  position: absolute;
  top: 60px;
  left: 10px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.boardingtime span{
  color: #555;
  font-size: 17px;
}

.barcode{
  position: absolute;
  left: 8px;
  bottom: 6px;
  height: 30px;
  width: 90px;
  background: #222;
  box-shadow: inset 0 1px 0 #FFB300, inset -2px 0 0 #FFB300,
    inset -4px 0 0 #222,
    inset -5px 0 0 #FFB300,
    inset -6px 0 0 #222,
    inset -9px 0 0 #FFB300,
    inset -12px 0 0 #222,
    inset -13px 0 0 #FFB300,
    inset -14px 0 0 #222,
    inset -15px 0 0 #FFB300,
    inset -16px 0 0 #222,
    inset -17px 0 0 #FFB300,
    inset -19px 0 0 #222,
    inset -20px 0 0 #FFB300,
    inset -23px 0 0 #222,
    inset -25px 0 0 #FFB300,
    inset -26px 0 0 #222,
    inset -26px 0 0 #FFB300,
    inset -27px 0 0 #222,
    inset -30px 0 0 #FFB300,
    inset -31px 0 0 #222,
    inset -33px 0 0 #FFB300,
    inset -35px 0 0 #222,
    inset -37px 0 0 #FFB300,
    inset -40px 0 0 #222,
    inset -43px 0 0 #FFB300,
    inset -44px 0 0 #222,
    inset -45px 0 0 #FFB300,
    inset -46px 0 0 #222,
    inset -48px 0 0 #FFB300,
    inset -49px 0 0 #222,
    inset -50px 0 0 #FFB300,
    inset -52px 0 0 #222,
    inset -54px 0 0 #FFB300,
    inset -55px 0 0 #222,
    inset -57px 0 0 #FFB300,
    inset -59px 0 0 #222,
    inset -61px 0 0 #FFB300,
    inset -64px 0 0 #222,
    inset -66px 0 0 #FFB300,
    inset -67px 0 0 #222,
    inset -68px 0 0 #FFB300,
    inset -69px 0 0 #222,
    inset -71px 0 0 #FFB300,
    inset -72px 0 0 #222,
    inset -73px 0 0 #FFB300,
    inset -75px 0 0 #222,
    inset -77px 0 0 #FFB300,
    inset -80px 0 0 #222,
    inset -82px 0 0 #FFB300,
    inset -83px 0 0 #222,
    inset -84px 0 0 #FFB300,
    inset -86px 0 0 #222,
    inset -88px 0 0 #FFB300,
    inset -89px 0 0 #222,
    inset -90px 0 0 #FFB300;
}

.slip{
  left: 455px;
}

.nameslip{
  top: 60px;
  left: 410px;
}

.flightslip{
  left: 410px;
}

.seatslip{
  left: 540px;
}

.jfkslip{
  font-size: 30px;
  top: 20px;
  left: 410px;
}

.sfoslip{
  font-size: 30px;
  top: 20px;
  left: 530px;
}

.planeslip{
  top: 10px;
  left: 475px;
}

.airlineslip{
  left: 455px;
}
</style>
<body>
<a href="index.php" style="text-decoration:none;color:#BC1616;fon-weight:bold;font-size:18pt"><img src="im\left-arrow.png" width="50px" height="50px"> Return Back</a>
<div id="canvas_div_pdf" style="border:1px solid black;height:100vh">
	<div class="box">
		<ul class="left">
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		</ul>
		
		<ul class="right">
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		  <li></li>
		</ul>
		<div class="ticket">
		  <span class="airline">GoodTravel</span>
		  <span class="airline airlineslip"><?=$da?></span>

          <?php
    if($type=="voyage"){
        ?>
		  <span class="boarding">Travel Ticket</span>
		  <div class="content">
			<table width="65%" >
                <tr>
                    <th style="text-align:center;font-size:18pt;padding-top:15px"><?=$depville?></th>
                    <?php
                    if($outile=="flight"){
                        ?>
                                            <th style="text-align:center;padding-top:15px"><img src="im/plane.png" width="60px" height="45px"></th>
                        <?php
                    }
                    if($outile=="train"){
                        ?>
                                                                    <th style="text-align:center;padding-top:15px"><img src="im/train.png" width="60px" height="45px"></th>
                        <?php
                    }
                    if($outile=="bus"){
                        ?>
                                                                                            <th style="text-align:center;padding-top:15px"><img src="im/bus.png" width="60px" height="45px"></th>
                        <?php
                    }
                    ?>
                    <th style="text-align:center;font-size:18pt;padding-top:15px"><?=$desville?></th>
    </tr>
            </table>
			
			<div class="sub-content">
			  <span class="watermark">CTRL+Z</span>
              <table width="67%" style="border-bottom:1px solid black">
              <tr>
                    <th width="22%" style="font-size:10pt;color:gray;text-align:center">PASSENGER NAME<br><span style="color:black"><?=$user?></span><th>
                    <th width="22%" style="font-size:10pt;color:gray;text-align:center">Depart Date<br><span style="color:black"><?=$depdate?><br>At <?=$depheure?></span><th>
                    <th width="22%" style="font-size:10pt;color:gray;text-align:center">Arrival Date<br><span style="color:black"><?=$desdate?><br>At <?=$desheure?></span><th>
                    <th width="24%" style="font-size:10pt;color:gray;text-align:center">Places Number<br><br><span style="color:black"><?=$nbrplace?></span><th>
                </tr>
                </table>
                <div style="width:60%;text-align:center">
                <span style="font-size:10pt;color:gray;text-align:center;font-weight:bold">&nbsp;&nbsp;SEATS: <span style="color:black"><?=$placesnumber?></span>
            </div>

			  <!--<span class="name">PASSENGER NAME<br><span><?=$user?></span></span>
			  <span class="flight">Arrival Date<br><span><?=$desdate?><br>At <?=$desheure?></span></span>
			  <span class="gate">Places N&deg;<br><span><?=$nbrplace?></span></span>
			  <span class="seat">SEATS<br><span><?=$placesnumber?></span></span>
			  <span class="boardingtime">BOARDING TIME<br><span>8:25PM ON AUGUST 2013</span></span>-->
				  
			   <span class="flight flightslip">Type<br><span><?=$type?></span></span>
         <?php
         if($hascouponornot==true){
           ?>
           				<span class="seat seatslip">Total Price<br><span><?=($prix*$nbrplace)-(($prix*$nbrplace)*0.1)?>DH</span></span>
           <?php
         }
         else{
             ?>
                  <span class="seat seatslip">Total Price<br><span><?=$prix*$nbrplace?>DH</span></span>
             <?php
        }
         ?>
			   <span class="name nameslip">PASSENGER NAME<br><span><?=$user?></span></span>
			</div>
		  </div>
          <?php
    }
    if($type=="Tour"){
        ?>
         <span class="boarding">Tour Ticket</span>
		  <div class="content">
			<table width="65%" >
                <tr>
                    <th style="text-align:center;font-size:12pt;padding-top:15px"><?=$titre?></th>                 
    </tr>
            </table>
			<span class="jfk jfkslip" style="font-size:13pt;text-align:center;font-weight:bold"><?=$categ?><br></span>
			<div class="sub-content">
			  <span class="watermark">CTRL+Z</span>
              <table width="67%" style="border-bottom:1px solid black">
              <tr>
                    <th width="22%" style="font-size:10pt;color:gray;text-align:center">PASSENGER NAME<br><span style="color:black"><?=$user?></span><th>
                    <th width="22%" style="font-size:10pt;color:gray;text-align:center">City<br><span style="color:black"><?=$city?></span><th>
                    <th width="22%" style="font-size:10pt;color:gray;text-align:center">Date<br><span style="color:black"><?=$date?></span><th>
                    <th width="24%" style="font-size:10pt;color:gray;text-align:center">Places Number<br><br><span style="color:black"><?=$nbrplace?></span><th>
                </tr>
                </table>
                <div style="width:60%;text-align:center">
                <span style="font-size:10pt;color:gray;text-align:center;font-weight:bold">&nbsp;&nbsp;SEATS: <span style="color:black"><?=$placesnumber?></span>
            </div>
            
			  <!--<span class="name">PASSENGER NAME<br><span><?=$user?></span></span>
			  <span class="flight">Arrival Date<br><span><?=$desdate?><br>At <?=$desheure?></span></span>
			  <span class="gate">Places N&deg;<br><span><?=$nbrplace?></span></span>
			  <span class="seat">SEATS<br><span><?=$placesnumber?></span></span>
			  <span class="boardingtime">BOARDING TIME<br><span>8:25PM ON AUGUST 2013</span></span>-->
				  
			   <span class="flight flightslip">Type<br><span><?=$type?></span></span>
				<span class="seat seatslip">Total Price<br><span><?=$prix+(($nbrplace-3)*$prix*0.12)?>DH</span></span>
			   <span class="name nameslip">PASSENGER NAME<br><span><?=$user?></span></span>
			</div>
		  </div>
          <div style="position:absolute;bottom:0;left:0"><img src="im/bus.png" width="60px" height="45px"></div>
        <?php
    }
          ?>
		 
		</div>
	  </div>
	</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
<script>

var element = document.getElementById('canvas_div_pdf');
html2pdf(element);
</script>




  <!-- 
<div id="canvas_div_pdf">
    
    <center>
    <br>
    <br>
    <br>
   <table width="80%" border="1px solid" style="position:relative" class="text-center">
       <tr>
           <th style="width:5%;background-color:white;border:0">     <img  src="im\Good_Travel-removebg-preview.png" height="75px" width="180px" style="padding-bottom: 12px;"> </th>
           <th style="width:70;background-color:white;border:0;text-align:left"><?=$user?></th>
           <th style="width:10%;background-color:white;border:0;text-align:right;padding-right:10px"><?=$da?></th>
       </tr>
       <?php
    if($type=="voyage"){
        ?>
         <tr >
           <td style="width:5%;background-color:white"><img src="im\—Pngtree—barcode_6020209.png" style="transform: rotate(90deg);" height="170px" width="200px"></td>
           <td style="width:75%;border-right:0;border-left:0;position:relative">
           <table width="100%" border="1px solid">
           <tr>
               <th>Type : <span style="font-weight:500"><?=$type?></span></th>
               <th>Travel By : <span style="font-weight:500"><?=$outile?></span></th>
            </tr>
           <tr>
               <th>From : <span style="font-weight:500"><?=$depville?></span><br>On: <span style="font-weight:500"><?=$depdate?></span><br>At: <span style="font-weight:500"><?=$depheure?></span></th>
               <th>To : <span style="font-weight:500"><?=$desville?></span><br>On: <span style="font-weight:500"><?=$depdate?></span><br>At: <span style="font-weight:500"><?=$desheure?></span></th>
            </tr>
            
            <tr>
               <th>Number Of Places : <span style="font-weight:500"><?=$nbrplace?></span></th>
               <th>The Price For One Place : <span style="font-weight:500"><?=$prix?>DH</span></th>
            </tr>
            <tr>
                <th colspan="2">Total Price : <span style="font-weight:500"><?=$nbrplace*$prix?>DH</span></th>
</tr>
<tr>
                <th colspan="2">Places Id : <span style="font-weight:500"><?=$placesnumber?></span></th>
</tr>
</table>
            </td>
           <td style="width:20%;border-right:0;;border-left:0;padding-top:0"><b>You Should Respect Your Date!</b><br><br><b>We Wish You A good Travel!</td>
      </tr>
      
        <?php
    }
    else{
        ?>
          <tr >
           <td style="width:5%;background-color:white"><img src="im\—Pngtree—barcode_6020209.png" style="transform: rotate(90deg);" height="170px" width="200px"></td>
           <td style="width:75%;border-right:0;border-left:0;position:relative">
           <table width="100%" border="1px solid">
           <tr>
               <th>Type : <span style="font-weight:500"><?=$type?></span></th>
               <th>Category : <span style="font-weight:500"><?=$categ?></span></th>
            </tr>
           <tr>
               <th>Tour Name : <span style="font-weight:500"><?=$titre?></th>
               <th>City : <span style="font-weight:500"><?=$city?></th>
            </tr>
            
            <tr>
               <th>Number Of Places : <span style="font-weight:500"><?=$nbrplace?></span></th>
               <th>The Price For 3 Places : <span style="font-weight:500"><?=$prix?>DH</span></th>
            </tr>
            <tr>
               <th>Date : <span style="font-weight:500"><?=$date?></span></th>
            </tr>
            <tr>
                <th colspan="2">Total Price : <span style="font-weight:500"><?=$prix+(($nbrplace-3)*$prix*0.12)?>DH</span></th>
</tr>
<tr>
                <th colspan="2">Places Id : <span style="font-weight:500"><?=$placesnumber?></span></th>
</tr>
</table>
            </td>
           <td style="width:20%;border-right:0;;border-left:0;padding-top:0"><b>You Should Respect Your Date!</b><br><br><b>We Wish You A good Travel!</td>
      </tr>
        <?php
    }
   
    ?>
      
   </table> 
</center>
</div>
<div class="html2pdf__page-break"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
<script>

var element = document.getElementById('canvas_div_pdf');
html2pdf(element);
</script>-->
</body>
</html>
<!--<table border="1px solid" width="100%" style="position:absolute;top:0;border-left:0">
               <tr>
                   <th></th>
                   <th></th>
               </tr>
               <tr>
                   <th>From : <span style="font-weight:500"><?=$depville?></span></th>
                   <th>To : <span style="font-weight:500"><?=$desville?></span></th>
               </tr>
               <tr>
                   <th>From : <span style="font-weight:500"><?=$depville?></span></th>
                   <th>To : <span style="font-weight:500"><?=$desville?></span></th>
               </tr>
               <tr>
                   <th>From : <span style="font-weight:500"><?=$depville?></span></th>
                   <th>To : <span style="font-weight:500"><?=$desville?></span></th>
               </tr>
               <tr>
                   <th>From : <span style="font-weight:500"><?=$depville?></span></th>
                   <th>To : <span style="font-weight:500"><?=$desville?></span></th>
               </tr>
               <tr>
                   <th>From : <span style="font-weight:500"><?=$depville?></span></th>
                   <th>To : <span style="font-weight:500"><?=$desville?></span></th>
               </tr
               ><tr>
                   <th>From : <span style="font-weight:500"><?=$depville?></span></th>
                   <th>To : <span style="font-weight:500"><?=$desville?></span></th>
               </tr>
               </table>-->