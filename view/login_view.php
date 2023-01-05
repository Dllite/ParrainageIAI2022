<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main-login.css"><link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="main">
      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="POST" >
          <h2 class="form_title title">Crée un compte !</h2>
          <input class="form__input" type="text"name="nom" value="<?= get_data($_POST, 'nom')?>" placeholder="Nom complet" >
          <?= display_errors($errors, 'name')?>
          <input class="form__input" type="email" name="email" value="<?= get_data($_POST, 'email')?>" placeholder="Email">
          <?= display_errors($errors, 'email')?>
          <input class="form__input" type="email" name="cemail" value="<?= get_data($_POST, 'cemail')?>" placeholder="Conirmer l'email">
          <?= display_errors($errors, 'cemail')?>
          <input class="form__input" type="password" name="motdepasse" value="<?= get_data($_POST, 'motdepasse')?> placeholder="Mot de passe">
          <?= display_errors($errors, 'motdepasse')?>
          <input class="form__input" type="password" name="rmotdepasse" value="<?= get_data($_POST, 'rmotdepasse')?> placeholder="Confirmer le mot de passe">
          <?= display_errors($errors, 'rmotdepasse')?>
            <select name="classe" class="form__input">
                <option value="gl1-a" class="form__input">GL 1 A</option>
                <option value="gl1-b" class="form__input">GL 1 B</option>
                <option value="sr1" class="form__input">SR 1</option>
                <option value="gl2" class="form__input">GL 2</option>
                <option value="sr2" class="form__input">SR 2</option>
            </select>
          <button class="form__button button" name="inscription">Inscription</button>
        </form>
      </div>
      <div class="container b-container" id="b-container">
        <form class="form" id="b-form" method="GET">
          <h2 class="form_title title">Connectez vous</h2>
          <?= display_errors($errors, 'nom')?>
          <input class="form__input" type="email" name="email" value="<?= get_data($_POST, 'email')?>" placeholder="Email">
          <?= display_errors($errors, 'password')?>
        <input class="form__input" type="password" value="<?= get_data($_POST, 'password')?>" placeholder="Mot de passe"><a class="form__link">Mot de passe oublié ?</a>
          <button class="form__button button submit">Connexion</button>
        </form>
      </div>
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Bienvenue !</h2>
          <p class="switch__description description">Pour voir votre parrain/marraine, veuillez vous connecter avec vos informations personnelles</p>
          <button class="switch__button button switch-btn">Se connecter</button>
        </div>
        <div class="switch__container is-hidden" id="switch-c2">
          <h2 class="switch__title title">Salut l'ami(e) !</h2>
          <p class="switch__description description">Entrez vos données personnelles et commencez votre le parrainage avec nous</p>
          <button class="switch__button button switch-btn">Crée un compte</button>
        </div>
      </div>
    </div>
    <script src="js/main-login.js"></script>
  </body>
</html>