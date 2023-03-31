<?php
include_once 'DataAccess.php';

class Tvg {
   
   

public static function getTravelBillet(){
    $cur= DataAccess::selection("select * from billet where Type='voyage' ");

     return $cur;
}

public static function getAllTravels(){
    $cur= DataAccess::selection("select * from voyage ");

     return $cur;
}

public static function NBRbilletpermonth()
  {
     
     
     $cur= DataAccess::selection("select * from billet where month(CAST(boughtin AS DATE))=month(CURDATE())");

     return $cur->rowCount();
  }
  public static function Totalbilletpermonth()
  {
     
     
     $cur= DataAccess::selection("select sum(totalapayes) from billet where month(boughtin)=month(curdate())");

     return $cur;
  }

  public static function NoterLesVisiteurs($ip,$datev,$country,$city){
    
    $req="insert into stats_visites(ip,date_visite,pages_vues,Country,City) values('$ip', '$datev' ,1,'$country','$city') on duplicate key update pages_vues = pages_vues + 1";

    $nb= DataAccess::miseajour($req);

}
public static function GetVuesNumber(){
    $req="select sum(pages_vues) from stats_visites where month(date_visite)=month(curdate())";
    $curs= DataAccess::selection($req);
    $nbr=0;
    while($row=$curs->fetch()){
        $nbr=$row[0];
    }
    $curs->closeCursor();
    return $nbr;
}
public static function getToursCategories(){
    $req="select * from specialtourscategories";
    $curs= DataAccess::selection($req);
    return $curs;
}
public static function getTours(){
    $req="select * from specialstours";
    $curs= DataAccess::selection($req);
    return $curs;
}
public static function getTourBillet(){
    $cur= DataAccess::selection("select * from billet where Type='Tour' ");

     return $cur;
}
public static function getUsers(){
    $cur= DataAccess::selection("select * from users");

     return $cur;
}
public static function getMessages(){
    $cur= DataAccess::selection("select * from messages");
     return $cur;
}

public static function CheckIfUserIsAdmin($user){
    $cur= DataAccess::selection("select Admin from users where UserName='$user' ");
    $r=0;
    while($row=$cur->fetch()){
        $r=$row[0];
    }
    $cur->closeCursor();
    return $r;
}

public static function AddTravel($vd,$va,$dd,$da,$hd,$ha,$c,$o,$p){
    $req="insert into voyage values(null,'$vd','$va','$dd','$da','$hd','$ha','$c','$o','$p')";
    $r=DataAccess::miseajour($req);
}
public static function getTravelById($id){
    $req="select * from voyage where idvoyage='$id'";
    $cur= DataAccess::selection($req);
    return $cur;
}
public static function EditeTravel($idtravel,$vd,$va,$dd,$da,$hd,$ha,$c,$o,$p){
    $req="update voyage set villedepart='$vd',villearriver='$va',datedepart='$dd',datearriver='$da',heuredepart='$hd',heurearrive='$ha',capacite='$c',outile='$o',prix='$p' where idvoyage='$idtravel'";
    $r=DataAccess::miseajour($req);
}
public static function DeleteTravel($idtravel){
    $req="delete from voyage where idvoyage='$idtravel'";
    $r=DataAccess::miseajour($req);
}
public static function addtourcategorie($cn,$cd){
    $req="insert into specialtourscategories values(null,'$cn','$cd')";
    $r=DataAccess::miseajour($req);
}
public static function getCategorieById($categorieid){
    $req="select * from specialtourscategories where idcate='$categorieid'";
    $cur= DataAccess::selection($req);
    return $cur;
}
public static function EditeCategorie($categorieid,$cn,$cd){
    $req="update specialtourscategories set titre='$cn',description='$cd' where idcate='$categorieid'";
    $r=DataAccess::miseajour($req);
}
public static function DeleteCategorie($categorieid){
    $req="delete from specialtourscategories where idcate='$categorieid'";
    $r=DataAccess::miseajour($req);
}
public static function addtour($idcat,$titre,$city,$dated,$description,$capacite,$image,$prix,$region){
    $req="insert into specialstours values(null,'$idcat','$titre','$city','$dated','$description','$capacite','$image','$prix','$region')";
    $r=DataAccess::miseajour($req);
    return $r;
}
public static function getTourById($tourid){
    $req="select * from specialstours where idtour='$tourid'";
    $cur= DataAccess::selection($req);
    return $cur;
}
public static function editetour($tourid,$categorie,$tt,$ct,$ddt,$dt,$ca,$image,$pr,$re){
    $req="update specialstours set idcateg='$categorie',titretour='$tt',city='$ct',datedepart='$ddt',descriptiontour='$dt',capacite='$ca',image='$image',prix='$pr',Region='$re' where idtour='$tourid'";
    $r=DataAccess::miseajour($req);
}
public static function DeleteTour($tourid){
    $req="delete from specialstours where idtour='$tourid'";
    $r=DataAccess::miseajour($req);
}
public static function gettourspicturebyid($id){
    $req="select image from specialstours where idtour='$id' ";
    $curs= DataAccess::selection($req);
    $image=0;
    while($row=$curs->fetch()){
        $image=$row[0];
    }
    $curs->closeCursor();
    return $image;
}
public static function addadmin($user){
    $req="update users set Admin='1' where UserName='$user'";
    $r=DataAccess::miseajour($req);
}
public static function remooveadmin($user){
    $req="update users set Admin='0' where UserName='$user'";
    $r=DataAccess::miseajour($req);
}
public static function addemailspublicitaire($email,$name){
    $req="insert into emailspublicitaire(email,name) values('$email','$name')";
    $r=DataAccess::miseajour($req);

}
public static function selecteallmailsandnamespub(){
    $req="select * from emailspublicitaire";
    $cur= DataAccess::selection($req);
    return $cur;
}
}
?>