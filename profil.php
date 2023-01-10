<?php

    require_once 'db/db.php';
    session_start();
    $email=$_SESSION['email'];
    $niveau=$_SESSION['niveau'];
    if(empty($email)){
        echo "<script type='text/javascript'>document.location.replace('login.php');</script>";
    }else{
        $q=$con->query("SELECT * FROM $niveau WHERE email='$email'");
        
        $info=$q->fetch_assoc();

        if($niveau=="niveau1"){
          $idL1=$info['idL1'];
        }else{
          $idL2=$info['idL2'];
        }
        

       
        /*$filiere=$info['filiere'];
        $parrain=$info['nom_parain'];
        $filleule=$info['filleule'];
        $image=$info['image'];*/
        
        
        
        /*if($parrain==''){
          $verif=$db->query("SELECT * FROM l2 WHERE filleule=''");
            $ligne=mysqli_num_rows($verif);
                 $list=$verif->fetch_assoc();
                $nom_p=$list['nom_p'];
                $id_p=$list['id'];
            if($ligne==TRUE){
                $maj = $db->query("UPDATE l1 SET nom_parain='$nom_p' WHERE email='$email'");
                $updatel2 = $db->query("UPDATE l2 SET filleule='$nom' WHERE id=$id_p");
            }
        }*/ 
    }
  
    if($info['active']==0){
      header("location:confirmation.php");
    }
    if(empty($_SESSION['email'])){
      header("location:login.php");
    }
    
    if(isset($_POST['submit'])){
        $photo= $_FILES['img']['name'];
        $upload="assets/images/".$photo;
        
        move_uploaded_file($_FILES['img']['tmp_name'], $upload);
        $q=$db->query("UPDATE $niveau SET image='$photo' WHERE email='$email'");
        if($q==TRUE){
            echo "<script type='text/javascript'>document.location.replace('profil.php');</script>";
        }
    }

    //Parrainage 
    
    //$parrain = $con->query("SELECT * FROM niveau2 WHERE classe='gl2' or classe='sr2'");
    
    //$filleule = $con->query("SELECT * FROM niveau1 WHERE classe='gl1-a' or classe='gl1-b' or  classe='sr1' ");

    
     
    /*if($parrain==true){
      while($ligne_filleul=$filleule->fetch_assoc()){

        $nom_filleul = $ligne_filleul['nomComplet'];
        $email_filleul = $ligne_filleul['email'];

        while($ligne_parrain=$parrain->fetch_assoc()){

          $nom_parrain = $ligne_parrain['nomComplet'];
          $email_parrain = $ligne_parrain['email'];

          $verif_parrain = $con->query("SELECT * FROM parrainage");
          while($row_verif=$verif_parrain->fetch_assoc()){
              $row_verif['emailFilleul'];
              if(empty($row_verif['emailFilleul'])){

                $parrainage = $con->query("INSERT INTO parrainage VALUES(NULL, '$nom_filleul', '$email_filleul', '$nom_parrain',' $email_parrain') ");
              }
          }
          //$row_filleul = mysqli_num_rows($verif_filleul);
          
          var_dump($_POST);
          
        }
      }
    }*/

    $cont_parrainage = $con->query("SELECT * FROM parrainage WHERE idL1='$idL1'");

    $par = $con->query("SELECT * FROM niveau2");
    $row_p = $par->fetch_assoc();
      $idL2=$row_p['idL2'];
    

    $ligne=$cont_parrainage->fetch_assoc();
    $row_idL1 = $ligne['idL1'];
    $row_ldL2 = $ligne['idL2'];
     
   // $rechercheParrain = $con->query("SELECT * FROM niveau2");
   // $l=mysqli_fetch_all($rechercheParrain);
    //$i=$l['idL2']
    if($niveau=='niveau1'){
      $completeParrainag = $con->query("SELECT COUNT(idL2) as total FROM parrainage WHERE idL1='$idL2'");
      
      $num_row = mysqli_fetch_assoc($completeParrainag);
      $totalParrain = $num_row['total'];
      if($num_row['total']<3){
        if($row_idL1==NULL){
          $attrib_parrain = $con->query("INSERT INTO parrainage VALUES('$idL1', '$idL2')");
        }
        if($row_idL1!=$idL1){
          $attrib_parrain = $con->query("INSERT INTO parrainage VALUES('$idL1', '$idL2')");
        }
       
  
      }
        if(!isset($row_idL1)){
          
          
            $attrib_parrain = $con->query("INSERT INTO parrainage VALUES('$idL1', '$idL2')");
          
        }
      
      $cont_parra= $con->query("SELECT * FROM parrainage WHERE idL1='$idL1'");
      $ligne_cont_parra = $cont_parra->fetch_assoc();
      $ap=$ligne_cont_parra['idL2'];
      $affiche_parrain_req = $con->query("SELECT * FROM niveau2 WHERE idL2='$ap'");
      $final = mysqli_fetch_assoc($affiche_parrain_req);
    
    }
    
    if($niveau=="niveau2"){
      $affiche_filleul= $con->query("SELECT * FROM niveau2 WHERE email='$email'");
      $ligne=$affiche_filleul->fetch_assoc();
      $id2=$ligne['idL2'];
      $af=$con->query("SELECT * FROM parrainage where idL2='$id2'");
      

    }
    
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profil utilisateur</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/style-profil.css" rel="stylesheet">

</head>

<body>
  <header id="header" class="header bg-primary fixed-top d-flex align-items-center">
<div class="logo">
        <h3><a href="index.html"><font color='lime'>IAI</font>  <font color="yellow">CAMEROUN</font></a></h3>
      
           
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
  </header>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Votre profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
          <li class="breadcrumb-item">Utilisateur</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/images/<?=$image?>" alt="Profile" class="rounded-circle">
              <?php 
                echo $row_idL1;
                echo '<br>';
                echo $row_ldL2;
                echo '<br>';
                echo $totalParrain;
              /*
                echo $nom_parrain.'<br>';
                echo $email_parrain.'<br>';
                echo $nom_filleul.'<br>';
                echo $email_filleul.'<br>';
                echo $row_parrain;*/
              ?>
              <h2><?=$info['nomComplet']?></h2>
              <h3>Etudiant</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
              <a href="deconnexion.php" class="btn btn-danger">Deconnexion</a>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#profile-overview">Vos informations</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier votre Profil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"> Change le mot
                    de passe </button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Details du Profil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom complet</div>
                    <div class="col-lg-9 col-md-8"><?=$info['nomComplet']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Niveau</div>
                    <div class="col-lg-9 col-md-8"><?=$niveau?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Filière</div>
                    <div class="col-lg-9 col-md-8"><?=$info['classe']?></div>
                  </div>
                
                <?php 
                
                if($_SESSION['niveau']=='niveau1'){
                echo '
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Parain</div>
                    <div class="col-lg-9 col-md-8">';?><?php echo $final['nomComplet'];  ?><?php echo '</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Classe Parrain/Marraine</div>
                    <div class="col-lg-9 col-md-8">';?><?=$final['classe'];?><?='</div>
                  </div>';
                ;}
                ?>
                <?php 
                
                if($_SESSION['niveau']=='niveau2'){
                echo '
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Filleule</div>
                    <div class="col-lg-9 col-md-8">';?><?php  
                    
                    while($f=$af->fetch_assoc()){
                       $id1=$f['idL1'];
                      $n1 = $con-> query("SELECT * FROM niveau1 WHERE idL1=$id1");
                       $a=$n1->fetch_assoc();
                       echo $a['nomComplet'].'<br>';
                    }
                    
                    ;?><?php echo '</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Classe Filleul</div>
                    <div class="col-lg-9 col-md-8"><?=$email?></div>
                  </div>';}?>
                
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$email?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form enctype="multipart/form-data" method="POST">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo de profil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/images/<?=$image?>" alt="Profile">
                        <div class="pt-2">
                          <input type="FILE" class="btn btn-primary btn-sm" name="img" title="Upload new profile image">
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                              class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom complet </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?=$info['nomComplet']?>">
                      </div>
                    </div>





                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">classe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="<?=$info['classe']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?=$email?>">
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe courant</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmer le mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>- DL LITE CORP</span></strong>. Tous droit reservés.
    </div>
    <div class="credits">
      Designed by <a href="https://wintuto.com/">Dilan Zambou </a>
    </div>
  </footer><!-- End Footer -->


  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>