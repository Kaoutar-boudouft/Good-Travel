<?php
include_once 'DataAccess.php';
include_once 'generalTraitement.php';
include_once 'UsersManager.php';
$user=$_POST['user'];
$hascouponornot=UsersManager::hasacouponornot($user);
$type=$_POST['type'];
$id=$_POST['id'];
$billetid=Traitement::getBilletid()+1;
$ra9mkorsi=Traitement::ra9mkorsi($type,$id);
$nbrplaces=$_POST['nbplace'];
$cardnumber=$_POST['cardnumber'];
$cardholder=$_POST['cardholder'];
$crypto=$_POST['crypto'];
$expyear=$_POST['expyear'];
$expmonth=$_POST['expmonth'];
$da=new DateTime();
$date=$da->format('Y-m-d H:i:s');
$r=Traitement::checkcardexixtance($cardnumber,$cardholder,$crypto,$expyear,$expmonth);
$ar9amkrasa="";
for($i=1;$i<=$nbrplaces;$i++){
    $ar9amkrasa.="place n:";
    $ar9amkrasa.=$ra9mkorsi+$i;
    $ar9amkrasa.="/";
}
if($r==0){
    echo("<h6 style='color:red;font-size:12pt' align='center'>Check Your Card Informations Please!</h6>");
}
else{
    if($type=="voyage"){
        $prix=Traitement::getpriceoftravel($id);
        $totalapayer=$prix*$nbrplaces;
        if($hascouponornot==true){
            $totalapayer=$totalapayer-($totalapayer*0.1);
            $r=DataAccess::miseajour("update users set coupon=0 where UserName='$user'");
        }
        $r=DataAccess::miseajour("insert into billet(UserName,Type,idvoyage,nbrdeplace,numerodeplaces,boughtin,totalapayes) values('$user','$type','$id','$nbrplaces','$ar9amkrasa','$date','$totalapayer')");

    }
    else{
        $prix=Traitement::getpriceoftour($id);
        $totalapayer=$prix+(($nbrplaces-3)*$prix*0.12);
        if($hascouponornot==true){
            $totalapayer=$totalapayer-($totalapayer*0.1);
            $r=DataAccess::miseajour("update users set coupon=0 where UserName='$user'");
        }
        $r=DataAccess::miseajour("insert into billet(UserName,Type,idtour,nbrdeplace,numerodeplaces,boughtin,totalapayes) values('$user','$type','$id','$nbrplaces','$ar9amkrasa','$date','$totalapayer')");
    }
    echo("<h6 style='color:green;font-size:12pt' align='center'>Your Ticket will be ready in 3s!</h6>");

       
    ?>
    <script>
         setTimeout(function(){
            window.location="billet.php?idbillet=<?=$billetid?>&type=<?=$type?>&cou=<?=$hascouponornot?>";
         },1000);
    </script>
    
         <?php

}
?>