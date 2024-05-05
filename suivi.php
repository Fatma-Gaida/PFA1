<?php
  session_start();
  if (isset($_SESSION['ID_CLIENT'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
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
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="espace_client.css">    <link rel="stylesheet" href="suivicolis.css">


  </head>
  <body>
        <nav> 
              <div class="nav_items">
              <div ><img src="" alt="logo"></div>
              <div ><span style="font-weight:bold; font-size:20px; margin-left:18%;">Espace client</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result['PRENOM_CLI']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            <ul>
              <li> <a href="nouvelle_commande.php">Nouvelle Commande</a></li>
              <li> <a href="#" class="nav-link active">Suivi Des Commandes </a></li>
              <li> <a href="reclamation.php" class="nav-link">Reclamation</a></li>
              <li><a href="espace_client.php">Mon Profil</a></li>
              <li>
              <form style="background-color:white; padding:0; width:fit-content; margin:0;" action="logout.php"><input type="submit" id="logout" name="logout" value="Deconnexion"></form> </li></ul>
              <div style="color:white;">
              <ul>
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li></ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Suivi une Commande</h1></div> 
            <hr> 
            <div id="gif" style="widht:60%;margin-left:10%;">
       
       <img id="image" src="images/location.png" style="width:15%;"></div>
       
       <div>
           <h1 id='titre'><span style="color: #96154a; ">SUIVRE UN COLIS</span></h1>
           <p id="parag">Votre colis a de la valeur pour nous. Tout comme nous, vous pouvez le suivre à la trace. En un clic, vous savez où il se situe.</p>
          
       </div>
       <form class="form" action="suivi.php" method="get" style="width:80%;margin-left:10%; color:black;">
       <div class="input-box">
       <input type="text" name="idColis" placeholder="Numéro de colis" required>
       <button type="submit" class="btn">Trouver</button>
   </div>
            <?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer les détails du colis
        $sql = "SELECT c1.NOM_CLI AS NOM_EXPEDITEUR, c1.PRENOM_CLI AS PRENOM_EXPEDITEUR,
        c2.NOM_CLI AS NOM_DESTINATAIRE, c2.PRENOM_CLI AS PRENOM_DESTINATAIRE,
        pr1.NOM_PR AS NOM_PR_INITIAL, pr2.NOM_PR AS NOM_PR_FINALE,
        colis.ID_COLIS, colis.POIDS_COLIS, colis.TYPE_COLIS,
        colis.DATE_DEPART_COLIS, colis.COUT_COLIS_ESTIME, colis.COUT_EFFECTIF,
        colis.LARGEUR_COLIS, colis.LONGUEUR_COLIS
        FROM colis
        JOIN client c1 ON colis.ID_CLIENT_EXPEDITEUR = c1.ID_CLIENT
        JOIN client c2 ON colis.ID_CLIENT_DESTINATAIRE = c2.ID_CLIENT
        JOIN point_relais pr1 ON colis.ID_PR_INITIAL = pr1.ID_PR
        JOIN point_relais pr2 ON colis.ID_PR_FINALE = pr2.ID_PR
        WHERE colis.ID_COLIS = :idColis;
 ";
        
        
        // Récupération de l'identifiant de colis depuis le formulaire
        if(isset($_GET['idColis'])) {
            
            $idColis = $_GET['idColis'];

            // Exécution de la requête
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idColis', $idColis, PDO::PARAM_INT);
            $stmt->execute();
            $colis = $stmt->fetchALL(PDO::FETCH_ASSOC);

            if ($colis) {

               echo '<link rel="stylesheet" type="text/css" href="suivicolis.css">';
            echo '<h1 style="text-align: center; font-size: xx-large; color: #96154a ;">Détails de votre colis :</h1>';
            echo '<table style="border-collapse: collapse; width: 80%; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">';
            echo '<tr>';
            
            echo '<th>ID client expéditeur</th>';
            echo '<th>ID client destinataire</th>';
            echo '<th>ID point relais initial</th>';
            echo '<th>ID point relais final</th>';
            echo '<th>Poids </th>';
            echo '<th>Largeur</th>';
            echo '<th>Longeur</th>';
            echo '<th>Date de départ</th>';
            echo '<th>Description</th>';
            echo '<th>Cout éstimé</th>';
            echo '<th>Cout effectif</th>';
            // Add more columns if needed
            echo '</tr>';
            echo '<tr>';

           
            echo '<td>' . $colis['NOM_EXPEDITEUR'] . '</td>';
            echo '<td>' . $colis['ID_CLIENT_DESTINATAIRE'] . '</td>';
            echo '<td>' . $colis['ID_PR_INITIAL'] . '</td>';
            echo '<td>' . $colis['ID_PR_FINALE'] . '</td>';
            echo '<td>' . $colis['POIDS_COLIS'] . '</td>';
            echo '<td>' . $colis['LARGEUR_COLIS'] . '</td>';
            echo '<td>' . $colis['LONGUEUR_COLIS'] . '</td>';
            echo '<td>' . $colis['DATE_DEPART_COLIS'] . '</td>';
            echo '<td>' . $colis['TYPE_COLIS'] . '</td>';
            echo '<td>' . $colis['COUT_COLIS_ESTIME'] . '</td>';
            echo '<td>' . $colis['COUT_EFFECTIF'] . '</td>';

            // Add more cells if needed
            echo '</tr>';
            echo '</table>';

                // Position actuelle du colis
                function position_actuelle($id){
                    $hostname = 'localhost';
                    $username = 'root';
                    $password = '';
                    $dbName = 'app';
                    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

                    $stmt = $pdo->prepare('SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id');
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($result)){
                        $stmt = $pdo->prepare('SELECT * FROM point_relais WHERE ID_PR in( select
                            ID_PR_INITIAL from colis where ID_COLIS= :id);');
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $pos = $result["ACTIVITE"]." ".$result["NOM_PR"]." ".$result["VILLE"]." ".$result["CODE_POSTAL"];
                        return $pos;
                    }
                    else {
                        $stmt = $pdo->prepare('SELECT * FROM point_relais
                            WHERE ID_PR IN 
                            (SELECT ID_PR_FIN FROM livraison WHERE ID_LIVRAISON IN (SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id) 
                            ORDER BY DATE_LIVRAISON );
                            ');
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $pos = $result[count($result)-1]["ACTIVITE"]." ".$result[count($result)-1]["NOM_PR"]." ".$result[count($result)-1]["VILLE"]." ".$result[count($result)-1]["CODE_POSTAL"];
                        return $pos;

                    }
                }
                
               echo '<link rel="stylesheet" type="text/css" href="suivicolis.css">';
               
               echo '<table style="border-collapse: collapse; width: 80%; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">';
               echo '<tr>';
               echo '<td colspan="12">';
               echo "<h3 ><span >Position actuelle de votre colis :</span></h3>" . position_actuelle($idColis);
                echo '</tr>';
                echo '</table>';
            } else {
                echo"aucun colis trouvé";
            }
        }

    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    // Fermeture de la connexion
    $pdo = null;
    ?>
    
    <?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbName = 'app';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer le nombre d'itinéraires pour un colis donné
    $sql1 = "SELECT COUNT(id_livraison) AS nombre_itineraires
             FROM livre
             WHERE id_colis = :idColis";

    // Requête pour récupérer la date de livraison et vérifier si une diminution de prix s'applique
    $sql2 = "SELECT l.date_livraison,
    CASE
        WHEN l.date_livraison > DATE_ADD(c.DATE_DEPART_COLIS, INTERVAL 4 DAY) THEN 'Diminution de prix'
        ELSE 'Pas de diminution de prix'
    END AS reduction_prix
FROM livraison l
JOIN livre lv ON l.id_livraison = lv.id_livraison
JOIN colis c ON lv.id_colis = c.id_colis
WHERE l.id_livraison = (SELECT id_livraison FROM livre WHERE id_colis = :idColis)";

    // Requête pour récupérer le prix estimé du colis
    $sql = "SELECT COUT_COLIS_ESTIME
            FROM colis
            WHERE id_colis = :idColis";

    // Récupération de l'identifiant de colis depuis le formulaire
    if(isset($_GET['idColis'])) {
        $idColis = $_GET['idColis'];

        // Exécution de la première requête
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(':idColis', $idColis, PDO::PARAM_INT);
        $stmt1->execute();
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        // Exécution de la deuxième requête
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':idColis', $idColis, PDO::PARAM_INT);
        $stmt2->execute();
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

        // Exécution de la troisième requête
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idColis', $idColis, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !$row1 || !$row2) {
            echo "";
        } else {
            $nombreItineraires = $row1['nombre_itineraires'];
            $dateLivraison = $row2['date_livraison'];
            $reductionPrix = $row2['reduction_prix'];
            $prixEstime = $row['COUT_COLIS_ESTIME'];

            // Calcul des réductions/augmentations en fonction des délais et des points relais
            $reductionPointRelaisInitial = 0.500;
            $reductionPointRelaisIntermediaire = 0.500;

            $delai = date_diff(date_create($dateLivraison), date_create())->days;

            $prixEffectif = $prixEstime;
            if ($delai > 4) {
                $prixEffectif -= $reductionPointRelaisInitial;
            }
            // Supposons que $pointRelaisIntermediaire est récupéré de la base de données
            $pointRelaisIntermediaire = false;
            if ($pointRelaisIntermediaire) {
                $prixEffectif -= $reductionPointRelaisIntermediaire;
            }

            // Affichage des informations
            
            echo '<link rel="stylesheet" type="text/css" href="suivicolis.css">';
          
            echo '<table style="border-collapse: collapse; width: 80%; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">';
            echo '<tr>';
            echo '<td colspan="12">'; // Spanning across all columns
            echo "<br>Nombre d'itinéraires pour le colis : $nombreItineraires<br>";
            echo "Date de livraison : $dateLivraison<br>";
            echo "Réduction de prix : $reductionPrix<br>";
            echo "Prix estimé du colis : $prixEstime DT<br>";
            echo "Prix effectif du colis : $prixEffectif DT";
            echo '</td>';
            echo '</tr>';
            
            echo '</table>';

            // Mise à jour du champ COUT_COLIS_EFFECTIF dans la base de données
            $sqlUpdate = "UPDATE colis SET COUT_EFFECTIF = :prixEffectif WHERE id_colis = :idColis";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':prixEffectif', $prixEffectif, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':idColis', $idColis, PDO::PARAM_INT);
            $stmtUpdate->execute();
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Fermeture de la connexion
$pdo = null;
?>

            </div>
          </div>
        </div>
        <footer>
          <img src="" alt="logo">
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
  
