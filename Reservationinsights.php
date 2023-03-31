<?php
include_once 'DataAccess.php';
$req1="select count(*) from billet where Type='voyage'";
$req2="select count(*) from billet where Type='Tour'";
$curs1=DataAccess::selection($req1);
$curs2=DataAccess::selection($req2);
$reponse=array();
$counter=array();
while($row=$curs1->fetch()){
    array_push($counter,$row[0]);
}

$curs1->closeCursor();
while($row=$curs2->fetch()){
    array_push($counter,$row[0]);
}
$curs2->closeCursor();

$Type=['Travel','Tour'];
$colors=['#BC1616','#012970','#362738'];
array_push($reponse,$Type);
array_push($reponse,$colors);
array_push($reponse,$counter);

echo json_encode($reponse);
?>