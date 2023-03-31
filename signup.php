<?php
include_once 'UsersManager.php';
include_once 'trait.php';
$UserName=$_POST['username'];
$Email=$_POST['email'];
$birthday=$_POST['birthday'];
$Password=$_POST['password'];
$PasswordConf=$_POST['passwordconf'];
$checked=$_POST['isChecked'];
$r=UsersManager::Inscrire($UserName,$Email,$birthday,$Password,$PasswordConf);
if($r!="account was created with success!"){
    echo("<h6 style='color:red;font-size:12pt' align='center'>$r</h6>");
}
else{
    echo("<h6 style='color:green;font-size:12pt' align='center'>$r</h6>");
    if($checked==true){
        $r=Tvg::addemailspublicitaire($Email,$UserName);
    }
    ?>
    <script>
        setTimeout(function(){
            $('#log').click();
            document.getElementById('use').value="<?=$UserName; ?>";
        }, 1000);
        </script>
    <?php
}
?>