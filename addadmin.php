<?php
$user=$_POST['user'];
include_once 'trait.php';
$r=Tvg:: addadmin($user);
?>
 <table width="100%"  id="myTable5" class="display table-responsive">
        <thead >
            <tr style="color:white;width:100%;height:40px"> 
                  <th style="width:20%;text-align:center">UserName</th>
                  <th style="width:1%;text-align:center">Email</th> 
                  <th style="width:20%;text-align:center">Password</th> 
                  <th style="width:20%;text-align:center">Birthday</th> 
                  <th style="width:20%;text-align:center">Profile Picture</th>
                  <th style="width:20%;text-align:center">Admin</th>
                  <th>
            </tr> 
           </thead> 
           <tbody> 
            <?php  
                  $curs= Tvg::getUsers();     
                  while ($row = $curs->fetch())
                            {
                        echo "<tr style='color:black'>";
                        
                        echo "<td style='color:black;width:20%'>$row[0] </td>"; 
                        echo "<td style='color:black;width:10%;'>$row[1] </td>"; 
                        echo "<td style='color:black;width:20%'>$row[2] </td>"; 
                        echo "<td style='color:black;width:20%'>$row[3] </td>"; 
                        echo "<td style='color:black;width:20%'><img src='$row[4]' style='border-radius:50%' width='100px' height='100px'> </td>"; 
                        if($row[5]==0){
                          echo "<td style='color:black;width:20%'>False</td>"; 
                          echo "<td style='width:15%'><input type='button' value='Add Admin' class='hire' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";        
                        }
                        else{
                          echo "<td style='color:black;width:20%'>True</td>"; 
                          echo "<td style='width:15%'><input type='button' value='Remove Admin' class='fire' style='background-color:Transparent;border:0;color:#b01d1de3;font-weight:bold' id='$row[0]'></td>";        

                        }


                        echo "</tr>"; 
                        
                        
                            }
            $curs->closeCursor();
            
            
                         ?>
        </tbody> 
    </table>
    <script>
           $('#myTable5').DataTable();
        $('.hire').click(function(){
  var user=$(this).attr('id');
  $.ajax({ 
     type: "POST", 
     url: "addadmin.php", 
     data: 'user='+user
      }).done(function(res){
            $('#users').html(res);
          })
})
$('.fire').click(function(){
  var user=$(this).attr('id');
  $.ajax({ 
     type: "POST", 
     url: "removeadmin.php", 
     data: 'user='+user
      }).done(function(res){
            $('#users').html(res);
          })
})
    </script>