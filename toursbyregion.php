<?php
$region=$_POST['region'];
include_once 'generalTraitement.php';
$r=Traitement::getToursByRegion($region);
?>
<script>
    $(function(){
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

        
    })
  
</script>
<?php
?>