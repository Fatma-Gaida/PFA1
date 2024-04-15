<?php
 
 echo'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="envoi.css">
    <link rel="stylesheet" href="nav.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>


    <title>Document</title>
</head>
<body>
  <nav>
    <ul>
      <li><a href="acceuil.php">acceuil</a></li>
      <li><a href="#">suivi de colis </a></li>
      <li><a href="#">envoi de colis</a></li>
      <li><a href="#">Nos points de relais </a></li>
      <li><a href="#">Aide</a></li>
      <li>
      <div id="loginContainer" style="padding-top: 2.5px;">
        <div id="loginButton" style="display: flex; align-items: center; justify-content: center; width: fit-content;">
          <span>Connexion</span>
        </div>
        <div style="clear:both"></div>
        <div id="loginBox">                
            <form id="loginForm">
                <fieldset id="body">
                    <fieldset>
                        <label for="email">Adresse email</label>
                        <input type="text" name="email" id="email" />
                    </fieldset>
                    <fieldset>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" />
                    </fieldset>
                    <input type="submit" id="login" value="Je me connecte" />
                    <span style="text-align:right; text-decoration: underline;"><a href="#">Mot de passe oublié?</a></span>
                    <input type="button" id="signup" value="Créer un compte" />

                    <!-- <a href="signup.html" style="border: 1px solid black; width: 100%; display: block; height: 30px; text-align: center; vertical-align: center;">Créer un compte</a> -->
            </form>
        </div>
    </div>
      </div>
    </div></li>
    </ul>
  </nav> 
  <script src="nav.js"></script>
    
      <div class="login-box"> 
        <h4 style="text-align: center ; margin-left: 0px;font-size: 30px; ">Bienvenue </h4>    
       <p style="text-align: center ; margin-left: 1Opxpx;font-size: 15px; ">Envoyer votre expédition en toute tranquillité en suivant ces étapes :</p>
       <p style="text-align: center ; margin-left: 1Opxpx;font-size: 15px; ">Préférez-vous envoyer votre colis en utilisant un compte ou en tant qu\'un visiteur ?</p>
        <form class="form1" action="envoi.php" method="POST">
    <div class="radio-inputs"  style="margin-top:15%; margin-bottom:10%;">
        <label>
            <input class="radio-input" type="radio" name="visiteur" value="visiteur">
            <span class="radio-tile" style="height: 150px;width: 200px;">
                <span class="radio-icon"></span>
                <span class="radio-label">Visiteur</span>
            </span>
        </label>
        <label>
            <input  class="radio-input" type="radio" name="compte" value="compte">
            <span class="radio-tile" style="height: 150px;width: 200px;">
                <span class="radio-icon"></span>
                <span class="radio-label">Compte</span>
            </span>
        </label>
    </div>
    <div class="div2">
    <input style="margin-left:33%;" class="button2" type="submit" name="page0" value="Continuer"/>
    </div>
        </form>
      </div>';
      ?>
        <footer>
          <img src="" alt="logo">
          <span>Copyright &copy;.All right reserved</span>
          <span>Mail:<a href="#">relaiscolis2024@gmail.com</a></span> 
          <span>Phone:+216 50 100 100</span>
          <div>
              <p>Follow Us</p>
              <ul>
                <li><a href="#"><img src="../images/icons8-facebook-48.png" alt=""></a></li>
                <li><a href="#"><img src="../images/icons8-instagram-48.png" alt=""></a></li>
                <li> <a href=""><img src="../images/icons8-linkedin-48.png" alt="instagram"></a></li>
                <li> <a href="#"><img src="../images/icons8-twitter-48.png" alt="twitter"></a></li>
                <li><a href="#"><img src="../images/icons8-pinterest-48.png" alt="pinterest"></a></li>
              </ul>
          </div>
  </footer>

</body>
</html>

