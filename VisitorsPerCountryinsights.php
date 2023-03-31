<?php
include_once 'DataAccess.php';
$req1="select Country,count(ip) from stats_visites group by Country";
$curs1=DataAccess::selection($req1);
$reponse=array();
$Countries=array();
$counter=array();
while($row=$curs1->fetch()){
    array_push($Countries,$row[0]);
    array_push($counter,$row[1]);
}

$curs1->closeCursor();

$colors=['#012970','#BC1616','#362738'];
array_push($reponse,$Countries);
array_push($reponse,$colors);
array_push($reponse,$counter);

echo json_encode($reponse);
?>