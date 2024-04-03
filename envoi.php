<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$page =  1 ;
if( isset($_POST['page1'])){
  // traitmenet de verification du contenu de la page 
  // si c'est vrai alors incrémenter variable page et refresh
  // si c'est faux rester dans la méme page et afficher les erreurs
  
  $page = 2 ;
}
if (isset($_POST['page2']) && $_POST['page2'] == "Continuer") {
  // Traitement de vérification du contenu de la page
  // Si c'est vrai alors incrémenter la variable page et refresh
  // Si c'est faux rester dans la même page et afficher les erreurs
  $page = 3; // Mettre à jour pour passer à la page suivante
}

if( isset($_POST['page2']) && $_POST['page2'] == "Retourner"){
  // traitmenet de verification du contenu de la page 
  // si c'est vrai alors incrémenter variable page et refresh
  // si c'est faux rester dans la méme page et afficher les erreurs
  $page = 1 ;
}
if( isset($_POST['page3']) && $_POST['page3'] == "Retourner"){
  // traitmenet de verification du contenu de la page 
  // si c'est vrai alors incrémenter variable page et refresh
  // si c'est faux rester dans la méme page et afficher les erreurs
  $page = 2 ;
}
if( isset($_POST['page3']) && $_POST['page3'] == "Continuer"){
  $page = 4 ;
}

if( isset($_POST['page4']) && $_POST['page4'] == "Retourner"){
  $page =  3;
}
if( isset($_POST['page5']) && $_POST['page5'] == "Retourner"){
  $page =  4;
}
if (isset($_POST['payment-method'])) {
  if ($_POST['payment-method'] == "par-carte" && $_POST['page4'] == "Continuer") {
      // Si la méthode de paiement est "par carte", afficher la page 5
      $page = 5;
      
  } elseif ($_POST['payment-method'] == "cash"&& $_POST['page4'] == "Continuer") {
      // Si la méthode de paiement est "espèces", afficher la page 6
      $page = 6;
  }
 
}
if( isset($_POST['page5']) && $_POST['page5'] == "Terminer"){
  $page = 6 ;
}

$nom_cli = $_POST['nom_ex'] ?? '';
$prenom_cli = $_POST['prenom_ex'] ?? '';
$adresse_cli = $_POST['adresse_ex'] ?? '';
$email_cli = $_POST['email_ex'] ?? '';
$num_tel_cli = $_POST['numtel_ex'] ?? '';
$ville_cli = $_POST['ville_ex'] ?? '';
$code_postal = $_POST['code_postal'] ?? '';
$type_cli = 'expediteur';

// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'mysql';
$username = 'root';
$password = '';

try {
    // Connexion à la base de données MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $sql = "INSERT INTO client (nom_cli, prenom_cli, adresse_cli, email_cli, num_tel_cli, ville_cli, code_postal_cli, type_cli) 
            VALUES (:nom_cli, :prenom_cli, :adresse_cli, :email_cli, :num_tel_cli, :ville_cli, :code_postal, :type_cli)";
    $stmt = $pdo->prepare($sql);

    // Liaison des valeurs aux paramètres de la requête
    $stmt->bindParam(':nom_cli', $nom_cli);
    $stmt->bindParam(':prenom_cli', $prenom_cli);
    $stmt->bindParam(':adresse_cli', $adresse_cli);
    $stmt->bindParam(':email_cli', $email_cli);
    $stmt->bindParam(':num_tel_cli', $num_tel_cli);
    $stmt->bindParam(':ville_cli', $ville_cli);
    $stmt->bindParam(':code_postal', $code_postal);
    $stmt->bindParam(':type_cli', $type_cli);

    // Exécution de la requête d'insertion
    $stmt->execute();

    // Redirection vers une page de confirmation
    header("Location: envoi.php?message=Votre compte a été créé avec succès");
    exit();
} catch (PDOException $e) {
    // En cas d'erreur, affichage du message d'erreur
    echo "Erreur lors de l'insertion des données : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relais Colis</title>
  <link rel="stylesheet" href="envoi.css">
  <link rel="stylesheet" href="nav.css">
  <script src="envoi.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>

</head>
<body>
<nav>
      <ul>
        <li><a href="acceuil.php">acceuil</a></li>
        <li><a href="#">suivi de colis </a></li>
        <li><a href="index.php">envoi de colis</a></li>
        <li><a href="#">Nos points de relais </a></li>
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
                          <input type="text" name="email" id="email-log" />
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
  <!--detail de expédireur-->
      <div class="login-box">
       
        <?php 
          if($page == 1)
          echo '
          <div class="progression">
          <ul id="progressbar">
            <li class="active">Détails de l\'expéditeur</li>
            <li>Détails du destinataire</li>
            <li>Détails de colis</li>
            <li>Option de paiment</li>
          </ul>
        </div>
          <h4>Veuillez remplir les coordonnées de l\'expéditeur</h4>

          <form class="form1" action="envoi.php" method="POST" onsubmit="return validateForm()">
          <div class="section1">
          <div class="part1">
            <div class="user-box">
              <input type="text" name="nom_ex" required="">
              <label>Nom</label>
            </div>
            <div class="user-box">
              <input type="text" id="numero" name="numtel_ex" required onblur="onBlurNumero()">
              <div id="numero-error" class="error-message"></div> 
              <label>Numero de Téléphone</label>
            </div>
            <div class="user-box">
              <input type="text" name="ville_ex" required="">
              <label>Ville</label>
            </div>
            <div class="user-box">
              <input type="text" name="adresse_ex" required="">
              <label>Adresse</label>
            </div>
            
          </div>
          <div class="part2">
            <div class="user-box">
              <input type="text" name="prenom_ex" required="">
              <label>Prénom</label>
            </div>
            <div class="user-box">
              <input type="text" name="email_ex" id="email" required onblur="validateEmail()">
              <div id="email-error" class="error-message"></div>
              <label>Adresse Email</label>
            </div>
            
            <div class="user-box">
            <input type="text" name="code_postal_cli" required="">
            <label>Code postal</label>
          </div>
            <label>Point de Relais</label><br>
            <div class="select">
            <select>
              <option>First select</option>
              <option>Option</option>
              <option>Option</option>
              <option>Option</option>
              <option>Option</option>
              <option>Option</option>
            </select>
            </div>
            </div></div>
  
            <div  class="boutons">
            <input class="button1" type="submit" name="page1" value="Retourner"/>
          <input class="button2" type="submit" name="page1" style="margin-top: 45px ;" value="Continuer"/>
          </div>
         
          </form>
          ';
          else if ($page == 2)
          echo '
          <div class="progression">
          <ul id="progressbar">
            <li class="active">Détails de l\'expéditeur</li>
            <li class="active">Détails du destinataire</li>
            <li>Détails de colis</li>
            <li>Option de paiment</li>
          </ul>
        </div>
        <h4>Veuillez remplir les coordonnées de le destinataire</h4>
        
          <form class="form1" action="envoi.php" method="POST" onsubmit="return validateForm()">
          <div class="section1">
            <div class="part1">
            <div class="user-box">
              <input type="text" name="nom_d" required="">
              <label>Nom</label>
            </div>
            <div class="user-box">
              <input type="text" id="numero" name="numtel_d" required onblur="onBlurNumero()">
              <div id="numero-error" class="error-message"></div>
              <label>Numero de Téléphone</label>
            </div>
            <div class="user-box">
              <input type="text" name="ville_d" required="">
              <label>Ville</label>
            </div>
            <div class="user-box">
              <input type="text" name="adresse_d" required="">
              <label>Adresse</label>
            </div>
            
          </div>
          <div class="part2">
            <div class="user-box">
              <input type="text" name="prenom-d" required="">
              <label>Prénom</label>
            </div>
            <div class="user-box">
              <input type="text" name="email_d" id="email" required onblur="validateEmail()">
              <div id="email-error" class="error-message"></div>
              <label>Adresse Email</label>
            </div>
        
            <div class="user-box">
            <input type="text" name="code_postal_cli" required="">
            <label>Code postal</label>
          </div>
            <label>Point de Relais</label><br>
            <div class="select">
            <select>
              <option>First select</option>
              <option>Option</option>
              <option>Option</option>
              <option>Option</option>
              <option>Option</option>
              <option>Option</option>
            </select>
            </div>
          </div>
          </div>
            <div  class="boutons">
            <input class="button1" type="submit" name="page2" value="Retourner"/>
          <input class="button2" type="submit" name="page2" style="margin-top: 45px ;" value="Continuer"/>
          </div>
          
  
          </form>
          ';
          else if ($page == 3)
          echo '<div class="progression">
          <ul id="progressbar">
            <li class="active">Détails de l\'expéditeur</li>
            <li class="active">Détails du destinataire</li>
            <li class="active">Détails de colis</li>
            <li>Option de paiment</li>
          </ul>
        </div>
        <p>le prix de la livraison varie en fonction de caracteristiques de colis.</p>
        <form class="form1" action="envoi.php" method="POST" onsubmit="return validateForm3()">
        <div class="section1">
          <div class="part1">
          <div class="user-box">
            <input type="text" name="contenance" required="">
            <label>Contenance de colis</label>
          </div>
          <div class="user-box">
            <input type="text" name="poids"  id="poids" required onblur="validatePoids()">
            <div id="poids-error" class="error-message"></div>
            <label>Poids de colis</label>
          </div>
          <div class="user-box">
            <input type="text" name="longueur" required="">
            <label>Longueur de colis </label>
          </div>
          <div class="user-box">
          <input type="text" name="largeur" required="">
          <label>Largeur de colis</label>
        </div>
          </div>
        <div class="part2">
          
          <label id="fragilité">Fragilité</label><br>
          <div class="checkbox">
  
          <input type="checkbox" id="choix1" name="choix" value="choix1">
          <label for="choix1">fragile &nbsp &nbsp &nbsp</label>
      
          <input type="checkbox" id="choix2" name="choix" value="choix2">
          <label for="choix2">non fragile</label><br>
      
          <input type="checkbox" id="choix3" name="choix" value="choix3">
          <label for="choix3">perimable</label>
  
          <input type="checkbox" id="choix4" name="choix" value="choix4">
          <label for="choix4">non perimable</label><br>
            </div>

            <label>Date de depot de colis </label></br>
            <input type="Date" name="date_depot" id="date" required=""></br>

            <label>Description</label><br>
            <textarea id="description" name="description" ></textarea>
            </div>
            </div>
            <div  class="boutons">
            <input class="button1" type="submit" name="page3" value="Retourner"/>
          <input class="button2" type="submit" name="page3" style="margin-top: 45px ;" value="Continuer"/>
          </div>
       
       
        </form>';
        else if ($page == 4)
        echo '  <div class="progression">
        <ul id="progressbar">
          <li class="active">Détails de l\'expéditeur</li>
          <li class="active">Détails du destinataire</li>
          <li class="active">Détails de colis</li>
          <li class="active">Option de paiment</li>
        </ul>
      </div>
     
      <form class="form" action="envoi.php" method="POST">
  <h4 style="text-align: center ; margin-left: 0px; ">Montant total à payer</h4>
  <div class="prix">1366</div>
  <p>C\'est le prix effectif de colis cette prix peut diminuer en fonction de delai de livraison et de nombre d\'itération</p>
  <h4 style="margin-left: 25%;">Sélectionnez votre méthode de paiement</h4>
  <div class="radio-inputs">
      <label>
          <input class="radio-input" type="radio" name="payment-method" value="par-carte">
          <span class="radio-tile">
              <span class="radio-icon"></span>
              <span class="radio-label">Par carte</span>
          </span>
      </label>
      <label>
          <input checked class="radio-input" type="radio" name="payment-method" value="cash">
          <span class="radio-tile">
              <span class="radio-icon"></span>
              <span class="radio-label">Espèces</span>
          </span>
      </label>
  </div>
  <div class="div2">
  <input class="button1" type="submit" name="page4" value="Retourner"/>
  <input class="button2" type="submit" name="page4" value="Continuer"/></div>
      </form>';
      else if ($page==5)
      echo'   <form class="form" action="envoi.php" method="POST" onsubmit="return validateForm5()">
       
      <div class="user-box">
              <input type="text" name="titulaire" required>
              <label>Titulaire de la Carte</label>
          </div>
          <div class="user-box">
              <input type="text" name="numero_carte" required>
              <label>Numero de la carte</label>
          </div>
        
          <div class="user-box">
              <input type="password"  id="code" name="code_securite" required onblur="onBlurCode()">
              <div id="code-error" class="error-message"></div>
              <label>Code de sécurité</label>
          </div>
          <label>Date d\'expiration</label></br>
          <input type="Date" name="date_expiration" id="date" required=""></br>
          
      
  <div class="div2">
  <input class="button1" type="submit" name="page5" value="Retourner"/>
  <input class="button2" type="submit" name="page5" value="Terminer"/></div>
  </form>';
  
  

else if ($page==6)
    echo'
      <div  class="final_page">
      <img class="img2" src="header-article-delivengo.png" alt="images">
     <h4>Toutes les étapes de l\'envoi sont désormais terminées</h4>
     <p>
     Nous vous enverrons un e-mail pour vous informer que votre colis est arrivé au point de relais de destination.<br><br>
     Vous pourrez suivre son cheminement de livraison d\'un point de relais à un autre jusqu\'à sa destination en utilisant la fonctionnalité "Suivi de colis".
     Il vous suffira d\'entrer l\'identifiant de votre colis</p>
     <h4>Merci pour votre confiance</h4>
      </div>
      </div>';
      ?>
      
</div>
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
