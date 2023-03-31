<?php
include_once 'DataAccess.php';
include_once 'phpmailer/PHPMailerAutoload.php';
include_once 'phpmailer/cred.php';


/*$mail=new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth=True;
$mail->Username=EMAIL;
$mail->Password=PASS;
$mail->SMTPSecure='tls';
$mail->Port=587;
$mail->setFrom(EMAIL,'kaoutar');
$mail->addAddress('kaoutarboudouft2@gmail.com');
$mail->addReplyTo(EMAIL);
$mail->Subject='subject';
$mail->Body='bodyyy';
$mail->AltBody='altbody';

if(!$mail->send()){
    echo('error');
    
}
*/

//hadi 3adi katmxi ri base donnee bax may3marlixi gmail hahaha


$name=$_POST['name'];
$gmail=$_POST['gmail'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$user=$_POST['user'];
if($user!=""){
    $req="insert into messages(name,email,subject,msg,username) values('$name','$gmail','$subject','$message','$user')";

}
else{
    $req="insert into messages(name,email,subject,msg) values('$name','$gmail','$subject','$message')";

}
$r=DataAccess::miseajour($req);
if($r!=0){
    ?>
    <script>
        $('#na').val('');
     $('#g').val('');
     $('#sub').val('');
    $('#mess').val('');
    </script>
    <?php
    echo("<h6 style='font-size:12pt;color:green' align='center'><br>the msg was sent succefly</h6>");

}


?>