<?php
include_once 'UsersManager.php';
$user=$_POST['username'];
$password=$_POST['password'];
$remember=$_POST['remember'];
$id=$_POST['id'];
$r=UsersManager::Login($user,$password);
if($r==0){
    session_start();
          $_SESSION['user']=$user;
          $_SESSION['pass']=$password;  
          if($remember==1){
            setcookie("user",$user,time()+120);
            setcookie("password",$password,time()+120);

           

            if(!empty($id)){
                $_SESSION['id']=$id;
                ?>
                <script>window.location="reservation.php";</script>    
                   <?php
            }
            else{
                    ?>
                    <script>window.location="index.php";</script>    
                       <?php            
            }
           
          }
          else{
            if(!empty($id)){
                $_SESSION['id']=$id;
                ?>
                <script>window.location="reservation.php";</script>    
                   <?php
            }
            else{
                
                    ?>
                    <script>window.location="index.php";</script>    
                       <?php
               
            }
          }
}
if($r==1){
    echo("<h6 style='color:red;font-size:12pt' align='center'>verifier votre nom</h6>");

}
if($r==2){
    echo("<h6 style='color:red;font-size:12pt' align='center'>verifier votre mot de passe</h6>");
    echo("<h6 style='color:blue;font-size:12pt;cursor:pointer' align='center' id='recuperer'>Recuperer le mot de passe!</h6>");
}
if($r==3){
    echo("<h6 style='color:red;font-size:12pt' align='center'>ce compte nexiste pas</h6>");
}

?>
<script>
    $('#recuperer').click(function(){
        $(this).html("<h6 style='font-size:12pt' align='center'>Wait a moment</h6>");
        $.ajax({ 
     type: "POST", 
     url: "recuperer.php", 
     data: 'username='+'<?=$user?>'
      }).done(function(res){
            $('#recuperer').html(res);
          })
    })
</script>