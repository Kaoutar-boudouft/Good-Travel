<?php
include_once 'DataAccess.php';
class Traitement{

    //Voyage Traitements:

    public static function travelEpmtyPlaces($id){
        $nbtotal=0;
        $nbnotempty=0;
        $req1="select capacite from voyage where idvoyage='$id'";
        $curs=DataAccess::selection($req1);
        while($row=$curs->fetch()){
            $nbtotal=$row[0];
        }
        $curs->closeCursor();
        $req1="select sum(nbrdeplace) from billet where idvoyage='$id' and Type='voyage' ";
        $curs=DataAccess::selection($req1);
        while($row=$curs->fetch()){
            $nbnotempty=$row[0];
        }
        $curs->closeCursor();
        return $nbtotal-$nbnotempty;

    }

    public static function searchtravel($curlocation,$destination,$date,$way){
        $req="select * from voyage where villedepart='$curlocation' and villearriver='$destination' and datedepart='$date' and outile='$way' ";
        $curs=DataAccess::selection($req);
        if($curs->rowCount()!=0){
           /* ?>
             <table id="myTable" class="display" width="90%">
        <thead>
            <tr> 
                  <th style="width:15%">Path</th>
                  <th style="width:15%">Depart Date</th> 
                  <th style="width:15%">Arrival Date</th> 
                  <th style="width:15%">Travel By</th> 
                  <th style="width:15%">Empty Places</th>
                  <th style="width:15%">Price</th>
            
            </tr> 
           </thead> 
           <tbody> 
            <?php
            while($row=$curs->fetch()){
                $empt=self::travelEpmtyPlaces($row[0]);
                $req1="select sum(nbrdeplace) from billet where Type='voyage' and idvoyage='$row[0]' ";
                $curs1=DataAccess::selection($req1);
                $x=0;
                if($curs1->rowCount()!=0){
                    while($r=$curs1->fetch()){
                        $x=$r[0];
                    }
                    $curs1->closeCursor();
                }
                echo "<tr>";
                        
                echo "<td style='width:15%'>$row[1] to  $row[2]</td>"; 
                echo "<td>$row[3] at $row[5] </td>"; 
                echo "<td>$row[2] </td>"; 
                echo "<td>$row[3] </td>"; 
                echo "<td>$row[4] </td>"; 
              echo "<td>$row[5] </td>"; 
              
                echo "</tr>"; 
                ?>
</tbody> 
    </table>
                <?php
            }
            $curs->closeCursor();*/
            ?>
            <table   style="color:black" width="100%">
                <tr style="text-align:center;height:50px;color:gray">
                    <th style="text-align:center">Path</th>
                    <th style="text-align:center">Depart Date</th>
                    <th style="text-align:center">Arrival Date</th>
                    <th style="text-align:center">Travel By</th>
                    <th style="text-align:center">Empty Places</th>
                    <th style="text-align:center">Price</th>
                    <th style="border:0"></th>
                </tr>
            <?php
            while($row=$curs->fetch()){
                $empt=self::travelEpmtyPlaces($row[0]);
                $req1="select sum(nbrdeplace) from billet where Type='voyage' and idvoyage='$row[0]' ";
                $curs1=DataAccess::selection($req1);
                $x=0;
                if($curs1->rowCount()!=0){
                    while($r=$curs1->fetch()){
                        $x=$r[0];
                    }
                    $curs1->closeCursor();
                }
                
                ?>
                <tr style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;text-align:center;height:70px">
                    <td style="text-align:center"><?=$row[1]; ?> to <?=$row[2]; ?></td>
                    <td style="text-align:center;"><?=$row[3]; ?><br> at <?=$row[5]; ?></td>
                    <td style="text-align:center"><?=$row[4]; ?><br> at <?=$row[6]; ?></td>
                    <td style="text-align:center"><?=$row[8]; ?></td>
                    <td style="text-align:center"><?=$row[7]-$x; ?></td>
                    <td style="text-align:center"><?=$row[9]; ?></td>
                    <?php
                    if($empt>0){
                        ?>
                                            <td style="border:0"><a id="link"><input id="<?=$row[0];?>v" class="reservertour" type="button" value="Reserve!" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616"></a></td>
                        <?php
                    }
                    else{
                        ?>
                                            <td style="border:0"><span style="color:red;font-weight:bold">Sold Out!</span></td>
                        <?php
                    }
                    ?>
                </tr>
            </table>
                <?php
                
                
            }
            $curs->closeCursor();
        }
        else{
            echo("<h6 style='color:red;font-size:12pt' align='center'>There is No travel At the Moment Stay Tuned!</h6>");

        }
    }


    public static function getTravelByID($id){
        $req="select * from voyage where idvoyage='$id' ";
        $curs=DataAccess::selection($req);
        return $curs;
        
    }

   

    public static function getpriceoftravel($id){
        $req="select prix from voyage where idvoyage='$id' ";
        $curs=DataAccess::selection($req);
        $prix=0;
        while($row=$curs->fetch()){
            $prix=$row[0];
        }
        $curs->closeCursor();
        return $prix;
    }

    //Tours Traitements:

    public static function emptyTourPlaces($tourid){
        $req="select capacite from specialstours where idtour='$tourid' ";
        $curs=DataAccess::selection($req);
        $r1=0;
        while($row=$curs->fetch()){
            $r1=$row[0];
        }
        $curs->closeCursor();
        $req="select sum(nbrdeplace) from billet where Type='tour' and idtour='$tourid' ";
        $curs=DataAccess::selection($req);
        $r2=0;
        if($curs->rowCount()!=0)
        {
            while($row=$curs->fetch()){
                $r2=$row[0];
            }
            $curs->closeCursor();
        }
        
        $r=$r1-$r2;
        return $r;
    }

    public static function ShowToursByCateg($idcateg)
    {
        $req="select * from specialstours where idcateg='$idcateg' ";
        $curs=DataAccess::selection($req);
        if($curs->rowCount()!=0){
            $i=0;
            while($row=$curs->fetch()){
                $empt=self::emptyTourPlaces($row[0]);
                if($i==0){
                    echo("<br>");
                    echo("<div class='row' data-aos='fade-left'>");
                }
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="hist" style="text-align: center;margin-bottom: 80px;position: relative;" data-aos="zoom-in" data-aos-delay="100">
                          <div class="pic" style="border-radius: 4px;overflow: hidden;"><img style="transition: all ease-in-out 0.4s;width: 100%;height: 200px;" src="<?=$row[7];?>" class="img-fluid" alt=""></div>
                          <div class="info" style="position: absolute;bottom: -80px;left: 0px;right: 0px;background: rgba(255, 255, 255, 0.9);padding: 15px 0;border-radius: 0 0 4px 4px;box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);">
                           <h4 style="font-weight: 700;margin-bottom: 10px;font-size: 16px;color: #0a0a0a;position: relative;padding-bottom: 10px;"><?php echo("$row[2]");?></h4>
                                <?php
                                if($empt>0){
                                    ?>
                                                                                            <span> <input data-toggle="modal" data-target="#echarpeModal" class="details" id="<?=$row[0];?>" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616" type="button" value="More Details !"></span>
                                    <?php
                                }
                                else{
                                    ?>
                                                                                <span style="color:red;font-weight:bold">Sold Out!</span>
                                    <?php
                                }
                                ?>
                          </div>
                    </div>
                </div>
                <?php
                 $i++;
                 if($i==4){
                     echo("</div>");
                     $i=0;
                            }
                
            }
            $curs->closeCursor();
        }
        else{
            echo("there is no tours at the moment stay tuned!");
        }
    }

    public static function getTourById($tourid){
        $req="select * from specialstours where idtour='$tourid' ";
        $curs=DataAccess::selection($req);
        return $curs;
    }

    
    
    public static function getpriceoftour($id){
        $req="select prix from specialstours where idtour='$id' ";
        $curs=DataAccess::selection($req);
        $prix=0;
        while($row=$curs->fetch()){
            $prix=$row[0];
        }
        $curs->closeCursor();
        return $prix;
    }

    public static function getToursByRegion($reg){
        $req="select * from specialstours where Region='$reg' ";
        $curs=DataAccess::selection($req);
        if($curs->rowCount()!=0){
           
            while($row=$curs->fetch()){
               ?>
                <div style="width:70%;margin-left:15%">
                    <div class="hist" style="text-align: center;margin-bottom: 80px;position: relative;">
                          <div class="pic" style="border-radius: 4px;overflow: hidden;"><img style="transition: all ease-in-out 0.4s;width: 100%;height: 200px;" src="<?=$row[7];?>" class="img-fluid" alt=""></div>
                          <div class="info" style="position: absolute;bottom: -80px;left: 0px;right: 0px;background: rgba(255, 255, 255, 0.9);padding: 15px 0;border-radius: 0 0 4px 4px;box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);">
                           <h4 style="font-weight: 700;margin-bottom: 10px;font-size: 16px;color: #0a0a0a;position: relative;padding-bottom: 10px;"><?php echo("$row[2]");?></h4>
                            <span>
                             <input data-toggle="modal" data-target="#echarpeModal" class="details" id="<?=$row[0];?>" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616" type="button" value="More Details !"></span>
                          </div>
                    </div>
                </div>
                <br>
               <?php

            }
            $curs->closeCursor();
          
        }
    }

    //Billet Traitements:

    public static function getBilletid(){
        $req="select max(idbillet) from billet";
        $curs=DataAccess::selection($req);
        $a5irbillet=0;
        while($row=$curs->fetch()){
           $a5irbillet=$row[0];
        }
        $curs->closeCursor();
        return $a5irbillet;
    }

   public static function getBilletById($idbillet){
    $req1="select * from billet where idbillet='$idbillet' ";
    $curs=DataAccess::selection($req1);
    return $curs;
   }

    //reservation/creditcard/numerodeplace..

    public static function checkcardexixtance($number,$name,$crypto,$expyear,$expmonth){
        $req1="select * from cartebancaire where numcarte='$number' and detenteur='$name' and anneeexp='$expyear' and moisexp='$expmonth' and crypto='$crypto'";
        $curs=DataAccess::selection($req1);
        return $curs->rowCount();
    }

    
   public static function ra9mkorsi($type,$id){
       $req="select sum(nbrdeplace) from billet where Type='$type' and id$type='$id'  ";
       $curs=DataAccess::selection($req);
       $ra9mkorsi=0;
       while($row=$curs->fetch()){
          $ra9mkorsi=$row[0];
       }
       $curs->closeCursor();
       return $ra9mkorsi;
   }

   public static function getcategorienamebyid($id){
    $req="select titre from specialtourscategories where idcate='$id' ";
    $curs=DataAccess::selection($req);
    $catename="";
    while($row=$curs->fetch()){
       $catename=$row[0];
    }
    $curs->closeCursor();
    return $catename;
   }

   
   public static function getreservationsbyUser($user){
    $req="select * from billet where UserName='$user' ";
    $curs=DataAccess::selection($req);
    if($curs->rowCount()==0){
        echo("you don't have any reservations Yet!");
    }
    else{
        ?>
        <table style="color:black" width="100%">
            <tr style="text-align:center;height:50px;color:gray">
                <th style="text-align:center;width:20%">Type</th>
                <th style="text-align:center;width:20%">Places Number</th>
                <th style="text-align:center;width:20%">Bought In</th>
                <th style="text-align:centerwidth:20%">Payed Price</th>
                <th style="text-align:centerwidth:20%"></th>
            </tr>
        <?php
        while($row=$curs->fetch()){
           ?>
           <tr style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;text-align:center;height:70px">
               <td style="text-align:center"><?=$row[2]; ?></td>
               <td style="text-align:center"><?=$row[5]; ?></td>
               <td style="text-align:center"><?=$row[7]; ?></td>
               <td style="text-align:center"><?=$row[8]; ?></td>
               <td style="text-align:center"><a href="billet.php?idbillet=<?=$row[0]?>&type=<?=$row[2]?>"><input type="button" value="Show Ticket" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616"></a></td>
           </tr>
           <?php
        }
        $curs->closeCursor();
        ?>
        </table>
        <?php
    }
   }

  

  
    
}
?>