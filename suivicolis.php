<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relais Colis</title>
  <link rel="stylesheet" href="suivicolis.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <!-- <script src="nav.js"></script> -->
</head>
<body> 
    <nav>
      <ul>
      <li><img src="images/logo.png"  style="width:30% ;height:30%;margin-left:0%"  alt="logo"></li>
        <li><a href="acceuil.php">acceuil</a></li>
        <li><a href="#">suivi de colis </a></li>
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
      <div id="gif">
       
        <img id="image" src="images/location.png"></div>
        
        <div>
            <h1 id='titre'><span style="color: #96154a;">SUIVRE UN COLIS</span></h1>
            <p id="parag">Votre colis a de la valeur pour nous. Tout comme nous, vous pouvez le suivre à la trace. En un clic, vous savez où il se situe.</p>
           
        </div>
        <form class="form" action="suivicolis.php" method="get">
    <div class="input-box">
        <input type="text" name="idColis" placeholder="Numéro de colis" required>
        <button type="submit" class="btn">Trouver</button>
    </div>
</form>

<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'tunirelais';

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer les détails du colis
        $sql = "SELECT ID_COLIS, ID_CLIENT_EXPEDITEUR, ID_CLIENT_DESTINATAIRE, ID_PR_INITIAL, ID_PR_FINALE,
                        POIDS_COLIS, TYPE_COLIS, DATE_DEPART_COLIS, COUT_COLIS_ESTIME, COUT_EFFECTIF,
                        LARGEUR_COLIS, LONGUEUR_COLIS
                FROM colis
                WHERE ID_COLIS = :idColis";

        // Récupération de l'identifiant de colis depuis le formulaire
        if(isset($_GET['idColis'])) {
            
            $idColis = $_GET['idColis'];

            // Exécution de la requête
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idColis', $idColis, PDO::PARAM_INT);
            $stmt->execute();
            $colis = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($colis) {

               echo '<link rel="stylesheet" type="text/css" href="suivicolis.css">';
            echo '<h1 style="text-align: center; font-size: xx-large; color: #96154a ;">Détails de votre colis :</h1>';
            echo '<table style="border-collapse: collapse; width: 80%; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">';
            echo '<tr>';
            echo '<th>ID colis</th>';
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

            echo '<td>' . $colis['ID_COLIS'] . '</td>';
            echo '<td>' . $colis['ID_CLIENT_EXPEDITEUR'] . '</td>';
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
                    $dbName = 'tunirelais';
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
                echo "Aucune information trouvée pour ce colis.";
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
$dbName = 'tunirelais';

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
            echo "Aucune information trouvée pour ce colis.";
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




        <footer>
            <img src="images/logo.png"  style="width:10% ;height:20%;margin-left:0%" alt="logo">
            <span>Copyright &copy;.All right reserved</span>
            <span>Mail:<a href="#">relaiscolis2024@gmail.com</a></span> 
            <span>Phone:+216 50 100 100</span>
            <div>
                <p>Follow Us</p>
                <ul>
                  <li><a href="#"><img src="images/icons8-facebook-48.png" alt="facebook"></a></li>
                  <li><a href="#"><img src="images/icons8-instagram-48.png" alt="instagram"></a></li>
                  <li> <a href=""><img src="images/icons8-linkedin-48.png" alt="linkedin"></a></li>
                  <li> <a href="#"><img src="images/icons8-twitter-48.png" alt="twitter"></a></li>
                  <li><a href="#"><img src="images/icons8-pinterest-48.png" alt="pinterest"></a></li>
                </ul>
            </div>
        
        </footer> 

       
</body>

</html>