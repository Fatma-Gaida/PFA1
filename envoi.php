<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$page =  1 ; 
// Fonction pour calculer le prix en fonction du poids du colis
function calculerPrixColis($poids) {
  // Tableau des tranches de poids et des prix correspondants
  $tranches_prix = array(
    "0.5" => 5.00,
    "1" => 5.25,
    "2" => 5.50,
    "3" => 5.75,
    "4" => 6.00,
    "5" => 6.50,
    "6" => 7.00,
    "7" => 7.50,
    "10" => 8.50,
    "15" => 9.00,
    "20" => 9.50
  );

  // Parcours des tranches de poids
  foreach ($tranches_prix as $tranche => $prix) {
      // Vérifie si le poids du colis est inférieur ou égal à la tranche actuelle
      if ($poids <= $tranche) {
          // Sortie du prix correspondant
          return $prix;
      }
  }
  // Si aucun prix n'est trouvé, retourner un message d'erreur ou une valeur par défaut
  return "Poids non pris en charge";
}
session_start();

$id_colis = $_SESSION['id_colis'] ?? null;
$id_client_expediteur = $_SESSION['id_client_expediteur'] ?? null;
$id_client_destinataire = $_SESSION['id_client_destinataire'] ?? null;
$pr_ex = $_SESSION['id_pr_ex'] ?? null;
$pr_d = $_SESSION['id_pr_d'] ?? null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['page1'])) {
    // Traitement de vérification du contenu de la page 
    // Si c'est vrai alors incrémenter la variable page et refresh
    // Si c'est faux rester dans la même page et afficher les erreurs
    $nom_cli = $_POST['nom_ex'];
    $prenom_cli = $_POST['prenom_ex'];
    $adresse_cli = $_POST['adresse_ex'];
    $email_cli = $_POST['email_ex'];
    $num_tel_cli = $_POST['numtel_ex'];
    $ville_cli = $_POST['ville_ex'];
    $pr_ex = $_POST['pr_ex'];
    $code_postal_cli_ex = $_POST['code_postal_cli_ex'];
    $type_cli = 'expediteur';

  // Informations de connexion à la base de données
  $host = 'localhost';
  $dbname = 'tunirelais';
  $username = 'root';
  $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insérer le client dans la base de données
        $sql = "INSERT INTO client (NOM_CLI, PRENOM_CLI, TYPE_CLI, ADRESSE_CLI, EMAIL_CLI, NUM_TEL_CLI, VILLE_CLI, code_postal_cli) 
                VALUES ('$nom_cli', '$prenom_cli', '$type_cli' ,'$adresse_cli', '$email_cli', '$num_tel_cli', '$ville_cli', '$code_postal_cli_ex')";
        $pdo->query($sql);

        // Récupérer l'ID du client expéditeur
        $id_client_expediteur = $pdo->lastInsertId();
        $_SESSION['id_client_expediteur'] = $id_client_expediteur;
        $_SESSION['id_pr_ex'] = $pr_ex;
        $page = 2; // Si tout va bien, passez à la page suivante
    }catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }
}
echo"$pr_ex;";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['page2']) && $_POST['page2'] == "Continuer") {
    $nom_cli = $_POST['nom_d'];
    $prenom_cli = $_POST['prenom_d'];
    $adresse_cli = $_POST['adresse_d'];
    $email_cli = $_POST['email_d'];
    $num_tel_cli = $_POST['numtel_d'];
    $ville_cli = $_POST['ville_d'];
    $code_postal_cli_d = $_POST['code_postal_cli_d'];
    $type_cli = 'destinataire';
     $pr_d = $_POST['pr_d'];
    echo "Récupération terminée  ";

  // Informations de connexion à la base de données
  $host = 'localhost';
  $dbname = 'tunirelais';
  $username = 'root';
  $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "ouverture de la base de données  ";
        $sql = "INSERT INTO client (NOM_CLI, PRENOM_CLI, TYPE_CLI, ADRESSE_CLI, EMAIL_CLI, NUM_TEL_CLI, VILLE_CLI, code_postal_cli) 
                VALUES ('$nom_cli', '$prenom_cli', '$type_cli' ,'$adresse_cli', '$email_cli', '$num_tel_cli', '$ville_cli', '$code_postal_cli_d')";

        $pdo->query($sql);

        $id_client_destinataire = $pdo->lastInsertId();
        $_SESSION['id_client_destinataire'] = $id_client_destinataire;

        $_SESSION['id_pr_d'] = $pr_d;


        

        $page = 3; // Mettre à jour pour passer à la page suivante
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }
}

echo "$id_client_destinataire;$pr_d ";

if (isset($_POST['page2']) && $_POST['page2'] == "Retourner") {
    $page = 1;
}

if (isset($_POST['page3']) && $_POST['page3'] == "Retourner") {
    $page = 2;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['page3']) && $_POST['page3'] == "Continuer") {
    $contenance = $_POST['contenance'];
    $poids = $_POST['poids'];
    $largeur = $_POST['largeur'];
    $longueur = $_POST['longueur'];
    $description = $_POST['description'];
    $date_depot = $_POST['date_depot'];
    $_SESSION['prix'] = calculerPrixColis($poids);
    echo "Récupération terminée  ";

    // Informations de connexion à la base de données
    $host = 'localhost';
    $dbname = 'tunirelais';
    $username = 'root';
    $password = '';
    echo "$contenance ; $poids ; $largeur ; $longueur ; $description ; $date_depot ;$pr_ex,$pr_d";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "ouverture de la base de données  ";

        $sql = "INSERT INTO colis (ID_CLIENT_EXPEDITEUR,ID_CLIENT_DESTINATAIRE,POIDS_COLIS,TYPE_COLIS,DATE_DEPART_COLIS,ID_PR_INITIAL,ID_PR_FINALE,LONGUEUR_COLIS,LARGEUR_COLIS,COUT_COLIS_ESTIME,COUT_EFFECTIF,DESCRIPTION) 
                VALUES ('$id_client_expediteur','$id_client_destinataire','$poids', '$contenance', '$date_depot' ,'$pr_ex','$pr_d', '$longueur', '$largeur','{$_SESSION['prix']}','{$_SESSION['prix']}', '$description')";
        $pdo->query($sql);

        $id_colis = $pdo->lastInsertId();
        $_SESSION['id_colis'] = $id_colis;
        $page = 4; // Mettre à jour pour passer à la page suivante
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }
}

echo "$id_colis";
if( isset($_POST['page4'])){
  $host = 'localhost';
  $dbname = 'tunirelais';
  $username = 'root';
  $password = '';

  echo "$id_colis, $id_client_expediteur";

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "ouverture de la base de données  ";

    $sql_insert_deposer_recuperer = "INSERT INTO deposer_recuperer (id_colis, id_client) VALUES ('$id_colis','$id_client_expediteur')";
    $pdo->query($sql_insert_deposer_recuperer);

    $sql = "INSERT INTO deposer_recuperer (id_colis, id_client) VALUES ('$id_colis','$id_client_destinataire')";
    $pdo->query($sql);

  } catch (PDOException $e) {
      echo "Erreur lors de l'insertion des données dans la table deposer_recuperer : " . $e->getMessage();
  }
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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tuni Relais </title>
  <link rel="stylesheet" href="envoi.css">
  <link rel="stylesheet" href="nav.css">
  <script src="envoi.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>

</head>
<body>
<nav>
      <ul>
      <li><img src="images/logo.png"  style="width:100% ;height:100%;margin-left:0%"  alt="logo"></li>
        <li><a href="acceuil.php">acceuil</a></li>
        <li><a href="suivi.php">suivi de colis </a></li>
        <li><a href="envoi.php">envoi de colis</a></li>
        <li><a href="pointrelais.php">Nos points de relais </a></li>
        <li>
        <div id="loginContainer" style="padding-top: 2.5px;">
          <div id="loginButton" style="display: flex; align-items: center; justify-content: center; width: fit-content;">
            <span>Connexion</span>
          </div>
          <div style="clear:both"></div>
          <div id="loginBox">
          <form id="loginForm" action="acceuil.php" method="POST">
    <fieldset id="body">
            <fieldset >
            <label for="" >Se conecter en tant que:</label>
            <label>
              <input type="radio" name="option" style="width:fit-content;" value="option1"  required>
              livreur
            </label>

            <label>
              <input type="radio" name="option" style="width:fit-content;" value="option2" required >
              client
            </label>
        </fieldset> 
        <fieldset>
            <label id="emailLabel" for="email">Adresse email</label>
            <input type="text" name="email" id="email" />
        </fieldset>
        <fieldset>
            <label id="passwordLabel" for="pwd">Mot de passe</label>
            <input type="password" name="pwd" id="password" />
            <span id="error-msg" style="color:red;"></span>
        </fieldset>
        <input type="submit" id="login" value="Je me connecte" />
        <span style="text-align:right; text-decoration: underline;"><a href="#">Mot de passe oublié?</a></span>
        <input type="button" id="signup" value="Créer un compte" />
    </fieldset>
    </form>

<script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission

        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Prepare the request
        xhr.open("POST", "login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Set up the callback function
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    console.log(response);
                    if (response === "") {
                      console.log("before ");
                        window.location.href = "espace_client.php";
                        console.log("after");
                    } else { 
                        document.getElementById("error-msg").textContent = response;
                    }
                } else {
                    console.log("Error: " + xhr.status);
                }
            }
        };

        // Send the request
        xhr.send("email=" + encodeURIComponent(email) + "&pwd=" + encodeURIComponent(password));
    });
   </script>
             
       
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
            include 'page1.php';
          else if ($page == 2)
            include 'page2.php';
          else if ($page == 3)
            include 'page3.html';
          else if ($page == 4)
            include 'page4.php';
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
     Il vous suffira d\'entrer l\'identifiant de votre colis :<span style="color: #96154a;"> ' . $id_colis . '</span></p>
     <h4>Merci pour votre confiance</h4>
      </div>
      </div>';
      ?>
      
</div>
<footer>
        <img src="images/logo.png"  style="margin-right:100%;width: 20%;height:20%;"  alt="logo">
          <span>Copyright &copy;.All right reserved</span>
          <span>Mail:<a href="#">relaiscolis2024@gmail.com</a></span> 
          <span>Phone:+216 50 100 100</span>
          <div>
              <p>Follow Us</p>
              <ul>
                <li><a href="#"><img src="images/icons8-facebook-48.png" alt=""></a></li>
                <li><a href="#"><img src="images/icons8-instagram-48.png" alt=""></a></li>
                <li> <a href=""><img src="images/icons8-linkedin-48.png" alt="instagram"></a></li>
                <li> <a href="#"><img src="images/icons8-twitter-48.png" alt="twitter"></a></li>
                <li><a href="#"><img src="images/icons8-pinterest-48.png" alt="pinterest"></a></li>
              </ul>
          </div>

      </footer>
   
</body>
       
</html>
