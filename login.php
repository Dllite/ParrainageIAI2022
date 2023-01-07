<?php

session_start();
require_once "_function/funtion.php";
require_once "db/db.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require "includes/PHPMailer.php";
    require "includes/SMTP.php";
    require "includes/Exception.php";

$errors=[];

if(isset($_POST['inscription'])){

extract($_POST);
//var_dump($_POST);

  if(empty($nom)){
    $errors['name'] = "Champ obligatoire";
  }else if(mb_strlen($nom)<3){
    $errors['name'] = "Doit être compris entre 3 et 200";
  }else if(mb_strlen($nom)>200){
    $errors['name'] = "Doit être compris entre 3 et 200";
  }
  
  if(empty($motdepasse)){
    $errors['motdepasse'] = "Champ obligatoire";
  }else if(mb_strlen($motdepasse)<6){
    $errors['motdepasse'] = "Doit avoir au moins 6 caractères";
  }
  
  
  if($motdepasse!=$rmotdepasse){
    $errors['rmotdepasse']="Les mots de passe ne sont pas identiques";
  }
  
  if(empty($email)){
    $errors['email'] = "Champ obligatoire";
  }else{
    $verif_email=$con->query("SELECT * FROM niveau1 WHERE email='$email'");
    $result_email = $verif_email ->fetch_assoc();
    
    if(!empty($result_email['email'])){
      $errors['email'] = "Cette email a deja un compte";
    }
  }
  
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email invalide";
  }
  if($email!=$cemail){
    $errors['cemail']="Les mots de passe ne sont pas identiques";
  }

  
  if(empty($errors)){

    $_SESSION['email']=$email;

    $_SESSION['nom']= $nom;
  
    $otp = rand(999999,100000);
    
    $req = $con->query("INSERT INTO niveau1 VALUES (NULL, '$nom', '$email', '$motdepasse', '$classe', '0', '$otp')") or die("Erreur");

    $mail = new PHPMailer();
            //Set mailer to use smtp
    $mail->isSMTP();
            //Define smtp host
    $mail->Host = "smtp.gmail.com";
            //Enable smtp authentication
    $mail->SMTPAuth = TRUE;
            //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "ssl";
            //Port to connect smtp
    $mail->Port = "465";
            //Set gmail username
    $mail->Username = "dilanzambou2@gmail.com";
            //Set gmail password
    $mail->Password = "udijxqqoyartsjmu";
           //Email subject
    $mail->Subject = "INSCRIPTION SUR LA PLATEFORME DE PARAINAGE DE L'IAI CENTRE DE DOUALA";
            //Set sender email
    $mail->setFrom('dilanzambou2@gmail.com');
            //Enable HTML
    $mail->isHTML(true);
            //Attachment

                // $mail->addAttachment('../assets/images/iailogo.png');

            //Email body
    $mail->Body = "<h1>Code de confirmation</h1></br>
        <p>Suite a votre inscription sur la plateforme de parainage de l'IAI centre de Douala. Votre code de confirmation est $otp";
        echo "<script type='text/javascript'>document.location.replace('confirmation.php');</script>";
            
    $mail->addAddress($email);
                     //Finally send email
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
            echo "Envoie d'un mail en cour... !";
                        //Section 2: IMAP
                        //Uncomment these to save your message in the 'Sent Mail' folder.
                        #if (save_mail($mail)) {
                        #    echo "Message saved!";
                        #}
          }

  }
}


if(isset($_POST['connexion'])){
  extract($_POST);
    
   
    if(empty($email)){
        $errors['email'] = "Champ obligatoire";
    }
   
    if(empty($password)){
        $errors['password'] = "Champ obligatoire";
    }else if(mb_strlen($password)<6){
        $errors['password'] = "Doit avoir au moins 6 caractères";
    }
    if(empty($errors)){
        $log = $con->query("SELECT * FROM niveau1 WHERE email='$email' && motdepasse='$password'");
        $result = mysqli_num_rows($log);
        if($result==TRUE){
          $_SESSION['email']=$email;
          header("location:profil.php");
        }else{
          $errors['display'] = "Email ou mot de passe invalide";
        }
    }
    
}

  require_once 'view/login_view.php';

?>



