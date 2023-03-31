<?php
include_once 'generalTraitement.php';
session_start();
if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
}
else{
    $user=0;
}
$curlocation=$_POST['curlocation'];
$destination=$_POST['destination'];
$date=$_POST['date'];
$way=$_POST['way'];
Traitement::searchtravel($curlocation,$destination,$date,$way);
?>
<script>
    $('.reservertour').click(function(e){
        var user="<?=$user?>";
        var id=$(this).attr('id');
        if(user==0){
            $('#travelsearch').modal('hide');
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