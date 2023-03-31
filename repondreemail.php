<?php
include_once 'UsersManager.php';
$user=$_POST['user'];
$subjectt=$_POST['subject'];
$msgg=$_POST['msg'];
$list1=explode(" ",$msgg);
$msg="";
foreach ($list1 as $x) {
    $msg.=$x;
    $msg.=".";
}
$list2=explode(" ",$subjectt);
$subject="";
foreach ($list2 as $y) {
    $subject.=$y;
    $subject.=".";
}



shell_exec("pythonfiles\sendrepsponse.py $user $subject $msg");
?>
<script>
      $('#repremarque').html("<h6 style='color:green;font-size:12pt' align='center'>Your Msg was sent Succeffly</h6>");
     setTimeout(function(){
        $('#subject').val('');
        $('#msgg').val('');
        $('#fermerm').click();
        $('#repremarque').html('');
        }, 1000);
</script>
<?php

?>