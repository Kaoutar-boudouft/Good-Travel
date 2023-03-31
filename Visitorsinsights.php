<?php
include_once 'DataAccess.php';
$req1="select City,count(ip) from stats_visites group by City";
$curs1=DataAccess::selection($req1);
$reponse=array();
$Cities=array();
$counter=array();
while($row=$curs1->fetch()){
    array_push($Cities,$row[0]);
    array_push($counter,$row[1]);
}

$curs1->closeCursor();

$colors=['#BC1616','#012970','#362738'];
array_push($reponse,$Cities);
array_push($reponse,$colors);
array_push($reponse,$counter);

echo json_encode($reponse);
?>