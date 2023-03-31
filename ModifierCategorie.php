<?php
include_once 'trait.php';
$categorieid=$_POST['categorieid'];
$cn=$_POST['cn'];
$cd=$_POST['cd'];
$r=Tvg::EditeCategorie($categorieid,$cn,$cd);
?>
<table width="100%" id="myTable2" class="display table-responsive">
        <br>
        <thead>
            <tr style="color:white"> 
                  <th style="width:20%">Tiltle</th>
                  <th style="width:60%">Description</th> 
                   <th style="width:10%"></th>
                   <th style="width:10%"></th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
            $curs= Tvg:: getToursCategories();     
                    while ($row = $curs->fetch())
                            {
                        echo "<tr style='color:black'>";
                        echo "<td style='color:black;width:30%'>$row[1] </td>"; 
                        echo "<td style='color:black;width:70%'>$row[2] </td>"; 
                        echo "<td style='width:10%'><input type='button' value='modifier' class='modifiertc' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]' data-toggle='modal' data-target='#tourcategorieedite'></td>";
                        echo "<td style='width:10%'><input type='button' value='supprimer' class='supprimertc' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";
                         echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>  
    <script>
                $('#myTable2').DataTable();
                $('.supprimertc').click(function(){
  var categorieid=$(this).attr('id');
  $.ajax({ 
     type: "POST", 
     url: "Removecategorie.php", 
     data: 'categorieid='+categorieid
      }).done(function(res){
            $('#tourscategories').html(res);
          })
})

    </script>
    <?php   

?>