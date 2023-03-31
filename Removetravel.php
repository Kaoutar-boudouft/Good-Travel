<?php
$idtravel=$_POST['travelid'];
include_once 'trait.php';
$r=Tvg::DeleteTravel($idtravel);
?>
<table width="100%" id="myTable" class="display table-responsive">
        <br>
        <thead>
            <tr style="color:white"> 
                  <th style="width:15%">Depart</th>
                  <th style="width:15%">Destination</th> 
                  <th style="width:15%">Depart date</th> 
                  <th style="width:15%">Arrival date</th> 
                  <th style="width:15%">Depart hour</th>
                  <th style="width:15%">Arrival hour</th>
                  <th style="width:15%">Capacite</th>
                  <th style="width:15%">Way</th>
                  <th style="width:15%">Price</th>
                   <th style="width:15%"></th>
                   <th style="width:15%"></th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
            $curs= Tvg::getAllTravels();     
                    while ($row = $curs->fetch())
                            {
                        echo "<tr style='color:black'>";
                        
                        echo "<td style='color:black;width:15%'>$row[1] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[2] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[3] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[4] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[5] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[6] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[7] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[8] </td>"; 
                        echo "<td style='color:black;width:15%'>$row[9] </td>"; 
                        echo "<td style='width:15%'><input type='button' value='modifier' class='modifier' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]' data-toggle='modal' data-target='#traveledite'></td>";
                        echo "<td style='width:15%'><input type='button' value='supprimer' class='supprimer' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";
                        echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>      
<script>
        $('#myTable').DataTable();
        $('.modifier').click(function(){
    
    var travelid=$(this).attr('id');
    $.ajax({ 
   type: "POST", 
   url: "remplirmodaledittravel.php", 
   data: 'travelid='+travelid
    }).done(function(res){
          $('#editetravel').html(res);
        })
    $('.modifiertravel').attr('id',travelid);
 
})
$('.modifiertravel').click(function(){
    var travelid=$(this).attr('id');
    var vd=$('#vde').val();
    var va=$('#vae').val();
    var dd=$('#dde').val();
    var da=$('#dae').val();
    var hd=$('#hde').val();
    var ha=$('#hae').val();
    var c=$('#ce').val();
    var o=$('#oe').val();
    var p=$('#pe').val();
    $.ajax({ 
     type: "POST", 
     url: "ModifierTravel.php", 
     data: 'travelid='+travelid+'&vd='+vd+'&va='+va+'&dd='+dd+'&da='+da+'&hd='+hd+'&ha='+ha+'&c='+c+'&o='+o+'&p='+p
      }).done(function(res){
            $('#voyages').html(res);
          })
          $('#fermer1').click();

  })
  $('.supprimer').click(function(){
    var idtravel=$(this).attr('id');
    $.ajax({ 
     type: "POST", 
     url: "Removetravel.php", 
     data: 'travelid='+idtravel
      }).done(function(res){
            $('#voyages').html(res);
          })
          $('#fermer1').click();
  })
</script>
<?php
?>