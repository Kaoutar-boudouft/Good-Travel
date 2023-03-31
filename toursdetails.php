<?php
include_once 'generalTraitement.php';
session_start();
if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
}
else{
    $user=0;
}
$idtour=$_POST['tourid'];
$curs=Traitement::getTourById($idtour);
$r=Traitement::emptyTourPlaces($idtour);
while($row=$curs->fetch()){
    ?>
<h5 align="center" style="color: #BC1616;font-weight:bold"><?php echo("$row[2]");?></h5>
<br>
<div class="pic" style="border-radius: 4px;overflow: hidden;"><img style="transition: all ease-in-out 0.4s;width: 100%;height: 200px;" src="<?=$row[7];?>" class="img-fluid" alt=""></div>
<br>
<p style="text-align:center">"<?php echo("$row[5]");?>"</p>
<br>
<table width="70%" border="1px solid black" style="margin-left:15%;box-shadow:0 0 15px">
    <tr style="height:30px">
        <td style="padding-left:20px;padding-top:10px;font-weight:bold">City :</td>
        <td style="text-align:left;padding-top:10px"><?php echo("$row[3]");?></td>
    </tr>
    <tr style="height:30px">
        <td style="padding-left:20px;font-weight:bold">Depart Time :</td>
        <td style="text-align:left"><?php echo("$row[4]");?></td>
    </tr>
    <tr style="height:30px">
        <td style="padding-left:20px;font-weight:bold">Price :</td>
        <td style="text-align:left"><?php echo("$row[8]");?> Dh</td>
    </tr>
    <tr style="height:30px">
        <td style="padding-left:20px;padding-bottom:10px;font-weight:bold">Empty Places :</td>
        <td style="text-align:left;padding-bottom:10px"><?php echo("$r");?></td>
    </tr>
</table>
<br>
<a id="link"><input id="<?=$row[0];?>t"  class="reservertour" type="button" value="Reserve Now!" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616;margin-left:40%"></a>
<?php
}
?>
<script>
    $('.reservertour').click(function(e){
        var user="<?=$user?>";
        var id=$(this).attr('id');
        if(user==0){
            $('#echarpeModal').modal('hide');
            $('#i').html($(this).attr('id'));
            $('#lo').modal('show');

        }
        else{
            $('#link').attr("href", "reservation.php?id="+id);
        }
    })
</script>
<?php
?>