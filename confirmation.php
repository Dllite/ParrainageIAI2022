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
            
        }else if(mb_strlen($nom)<6){
            $errors['code']="Doit avoir au moins 6 caractères";
        }else if(mb_strlen($nom)>6){
            $errors['code']="Doit avoir au moins 6 caractères";
        }
        
        $search=$db->query("SELECT * FROM $niveau WHERE user_otp='$code'");
        $ligne=mysqli_num_rows($search);
        
        if($ligne==TRUE){
            $active=$db->query("UPDATE $niveau SET active='1' WHERE user_otp='$code' ");
            echo "<script type='text/javascript'>document.location.replace('../profil.php');</script>";
        }else{
            $errors['code']="Code invalide";
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
                            
                             <button class="form__button button" name="inscription">Inscription</button>    
                          
                    
                             <a href="deconnexion.php" class="ibtn btn-danger">Deconnexion</a>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<?php
    require_once "view/footer_view.php";

    ?>