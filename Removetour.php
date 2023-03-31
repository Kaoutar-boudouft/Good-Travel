<?php
$tourid=$_POST['tourid'];
include_once 'trait.php';
$image=Tvg::gettourspicturebyid($tourid);
$r=Tvg::DeleteTour($tourid);
unlink($image);
?>
<table width="100%" id="myTable3" class="display table-responsive">
<br>
<thead>
<tr style="color:white"> 
                  <th style="text-align:center">Categorie</th> 
                  <th style="text-align:center">Title</th> 
                  <th style="text-align:center">City</th>
                  <th style="text-align:center">Depart Date</th>
                  <th style="text-align:center">Description</th>
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
      echo "<td style='color:black'>$row[5] </td>"; 
      echo "<td style='color:black'>$row[6] </td>"; 
      echo "<td style='color:black;width:200px;height:200px'><img src='$row[7]' width='100%' height='100%' style='border-radius:10px'> </td>"; 
      echo "<td style='color:black'>$row[8] </td>"; 
        echo "<td ><input type='button' value='modifier' class='modifiert' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]' data-toggle='modal' data-target='#touredite'></td>";
                        echo "<td ><input type='button' value='supprimer' class='supprimert' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";
      echo "</tr>"; 

    }
$curs->closeCursor();


 ?>
<script>
            $('#myTable3').DataTable();
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
})

</script>
</tbody> 
</table>  
