<?php
  session_start();
  if (isset($_SESSION['ID_CLIENT'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'tunirelais';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM client WHERE ID_CLIENT = :id');
    $stmt->bindParam(':id', $_SESSION['ID_CLIENT']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC); //tableau qui contient tous les donnes du client avec les cles sont les champs du table client
  }
  else {
    header('Location:acceuil.php');
    exit();
  }
  ?>
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



$id_colis = $_SESSION['id_colis'] ?? null;
$id_client_expediteur = $_SESSION['id_client_expediteur'] ?? null;
$id_client_destinataire = $_SESSION['id_client_destinataire'] ?? null;

if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['page1'])){
  // Traitement de vérification du contenu de la page 
  // Si c'est vrai alors incrémenter la variable page et refresh
  // Si c'est faux rester dans la même page et afficher les erreurs
  $nom_cli = $_POST['nom_ex'];
  $prenom_cli = $_POST['prenom_ex'];
  $adresse_cli = $_POST['adresse_ex'];
  $email_cli = $_POST['email_ex'];
  $num_tel_cli = $_POST['numtel_ex'];
  $ville_cli = $_POST['ville_ex'];
  $code_postal_cli_ex = $_POST['code_postal_cli_ex'];
  $type_cli = 'expediteur';
  $_SESSION['pr_ex'] = $_POST['pr_ex'];
 

  // Informations de connexion à la base de données
  $host = 'localhost';
  $dbname = 'tunirelais';
  $username = 'root';
  $password = '';

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "ouverture de la base de données  ";
    $sql = "INSERT INTO client (nom_cli,prenom_cli,type_cli,adresse_cli,email_cli,num_tel_cli,ville_cli,code_postal_cli) VALUES ('$nom_cli', '$prenom_cli', '$type_cli' ,'$adresse_cli', '$email_cli', '$num_tel_cli', '$ville_cli', '$code_postal_cli_ex')";

    $pdo->query($sql);

    $id_client_expediteur = $pdo->lastInsertId();
    $_SESSION['id_client_expediteur'] = $id_client_expediteur;
    $page = 2 ;
  } catch (PDOException $e) {
      echo "Erreur lors de l'insertion des données : " . $e->getMessage();
  }

}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['page2']) && $_POST['page2'] == "Continuer") {
  $nom_cli = $_POST['nom_d'];
  $prenom_cli = $_POST['prenom_d'];
  $adresse_cli = $_POST['adresse_d'];
  $email_cli = $_POST['email_d'];
  $num_tel_cli = $_POST['numtel_d'];
  $ville_cli = $_POST['ville_d'];
  $code_postal_cli_d = $_POST['code_postal_cli_d'];
  $type_cli = 'destinataire';
  $_SESSION['pr_d'] = $_POST['pr_d'];
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
    $sql = "INSERT INTO client (nom_cli,prenom_cli,type_cli,adresse_cli,email_cli,num_tel_cli,ville_cli,code_postal_cli) VALUES ('$nom_cli', '$prenom_cli', '$type_cli' ,'$adresse_cli', '$email_cli', '$num_tel_cli', '$ville_cli', '$code_postal_cli_d')";

    $pdo->query($sql);

    $id_client_destinataire = $pdo->lastInsertId();
    $_SESSION['id_client_destinataire'] = $id_client_destinataire;
    $page = 3 ; // Mettre à jour pour passer à la page suivante
  } catch (PDOException $e) {
      echo "Erreur lors de l'insertion des données : " . $e->getMessage();
  }

}



if( isset($_POST['page2']) && $_POST['page2'] == "Retourner"){
  
  $page = 1 ;
}
if( isset($_POST['page3']) && $_POST['page3'] == "Retourner"){
 
  $page = 2 ;
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['page3']) && $_POST['page3'] == "Continuer"){
  $contenance = $_POST['contenance'];
  $poids= $_POST['poids'];
  $largeur = $_POST['largeur'];
  $longueur = $_POST['longueur'];
  $description = $_POST['description'];
  $date_depot = $_POST['date_depot'];
  $pr_d= $_SESSION['pr_d'];
  $pr_ex= $_SESSION['pr_ex'];
  $_SESSION['prix']=calculerPrixColis($poids);
 

  // Informations de connexion à la base de données
  $host = 'localhost';
  $dbname = 'tunirelais';
  $username = 'root';
  $password = '';

 
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "ouverture de la base de données  ";
    $sql = "INSERT INTO colis (poids_colis,type_colis,date_depot_colis,position_actuelle,point_relais_initiale,point_relais_finale,longeur_colis,largeur_colis,description) VALUES ('$poids', '$contenance', '$date_depot' ,'$pr_ex','$pr_ex','$pr_d', '$longueur', '$largeur', '$description')";
    $pdo->query($sql);

    $id_colis = $pdo->lastInsertId();
    $_SESSION['id_colis'] = $id_colis;
    $page = 4 ; // Mettre à jour pour passer à la page suivante
  } catch (PDOException $e) {
      echo "Erreur lors de l'insertion des données : " . $e->getMessage();
  }

}



if( isset($_POST['page4'])){
  $host = 'localhost';
  $dbname = 'tunirelais';
  $username = 'root';
  $password = '';

 

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
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="espace_client.css">
    <link rel="stylesheet" href="nouvelle_commande.css">

  </head>
  <body>
        <nav> 
              <div style="margin-left: 0%;" class="nav_items">
              <div > <img src="images/logo.png"  style="margin-right:100%;width: 30%;height:30%;"  alt="logo"><span style="font-weight:bold; font-size:20px; margin-left:60%;">Espace client</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result['PRENOM_CLI'] ?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            
            <ul>
            <li><a href="espace_client.php">Mon Profil</a></li>
            <li> <a href=""class="nav-link active">Nouvelle Commande</a></li>
              <li> <a href="suivi.php">Suivi Des Commandes </a></li>
              <li> <a href="reclamation.php">Reclamation</a></li>
              
              <li>
              <form action="?logout=true" method="get" style="background-color:white; padding:0; width:fit-content; margin:0; "><input type="submit" id="logout" name="logout" value="Deconnexion" style="font-weight:bold;font-size:20px;"></form> </li></ul>
              <div style="color:white;">
              <ul>
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li></ul>
              
              </div>
           
          </div>
          <div class="main">
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
 
           <form class="form1" action="nouvelle_commande.php" method="POST" onsubmit="return validateForm()">
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
             <input type="text" name="code_postal_cli_ex" required="">
             <label>Code postal</label>
           </div>
             <label>Point de Relais</label><br>
             <div class="select">
             <select name="pr_ex">
               <option value="option1">First select</option>
               <option value="option2">Option</option>
               <option value="option3">Option</option>
               <option value="option4">Option</option>
               <option value="option5">Option</option>
               <option value="option6">Option</option>
             </select>
             </div>
             </div></div>
   
             <div  class="boutons">
             
           <input class="button2" type="submit" name="page1" style="margin-top: 0px ;margin-left:30%;" value="Continuer"/>
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
         
           <form class="form1" action="nouvelle_commande.php" method="POST" onsubmit="return validateForm()">
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
               <input type="text" name="prenom_d" required="">
               <label>Prénom</label>
             </div>
             <div class="user-box">
               <input type="text" name="email_d" id="email" required onblur="validateEmail()">
               <div id="email-error" class="error-message"></div>
               <label>Adresse Email</label>
             </div>
         
             <div class="user-box">
             <input type="text" name="code_postal_cli_d" required="">
             <label>Code postal</label>
           </div>
             <label>Point de Relais</label><br>
             <div class="select">
             <select name="pr_d">
               <option value="option1">First select</option>
               <option value="option2">Option</option>
               <option value="option3">Option</option>
               <option value="option4">Option</option>
               <option value="option5">Option</option>
               <option value="option6">Option</option>
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
         <form class="form1" action="nouvelle_commande.php" method="POST" onsubmit="return validateForm3()">
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
   <div class="prix">'.$_SESSION['prix'].' DT</div>
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
      Il vous suffira d\'entrer l\'identifiant de votre colis : ' . $id_colis . '</p>
      <h4>Merci pour votre confiance</h4>
       </div>
       </div>';
       ?>
       
 </div></div></div></div>
 <footer>
 <img src="images/logo.png"style="width:10% ;height:10%;margin-left:0%" alt="logo">
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
 