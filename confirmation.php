<?php 

    session_start();

    require_once "db/db.php";

    require_once "view/header_view.php";

    require_once "_function/funtion.php";
    
   
    $errors=[];
    

   
//   if(!$nom){
//       echo "<script type='text/javascript'>document.location.replace('../index.php');</script>";
//   }else{
//       echo "Traitement en cours...";
//   }

    
    if(isset($_POST['submit'])){
        extract($_POST);
         $code=sanitaze($_POST['code']);
         
        if(empty($code)){
            $errors['code']="Champ obligatoire";
            
        }else if(mb_strlen($code)<6){
            $errors['code']="Doit avoir au moins 6 caractères";
        }else if(mb_strlen($code)>6){
            $errors['code']="Doit avoir au moins 6 caractères";
        }
        $niveau = $_SESSION['niveau'];
        if(empty($errors)){
            $search=$con->query("SELECT * FROM $niveau WHERE otp='$code'");
            $ligne=mysqli_num_rows($search);
            
            if($ligne==TRUE){
                $active=$con->query("UPDATE $niveau SET active='1' WHERE otp='$code' ");
                echo "<script type='text/javascript'>document.location.replace('profil.php');</script>";
            }else{
                $errors['code']="Code invalide";
            }
        }
        
    }
    
    
  
?>

<div class="container a-container form-body">  
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Activation de votre compte</h3>
                        <p>Nous vous avons envoyer un code par mail. Veillez svp renseigner ce code </p>
                        <form method="POST">
                            <input class="form-control" type="number" name="code" placeholder="Code otp">
                            <?= display_errors($errors, 'code')?>
                                <button class="btn btn-success button" name="submit">Confirmer</button> 
                             <a href="deconnexion.php" class="ibtn ">Deconnexion</a>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<?php
    require_once "view/footer_view.php";

    ?>