<?php
include_once 'generalTraitement.php';
$categid=$_POST['cate'];
Traitement::ShowToursByCateg($categid);
?>
    <script>
       $('.details').click(function(e){
         var tourid=$(this).attr('id');
         $.ajax({ 
     type: "POST", 
     url: "toursdetails.php", 
     data: 'tourid='+tourid
      }).done(function(res){
            $('#r').html(res);
          })
        })
    </script>
    <?php
?>