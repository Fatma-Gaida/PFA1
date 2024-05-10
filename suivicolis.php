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
        <li><a href="suivicolis.php">suivi de colis </a></li>
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
    function posinit($id) {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'tunirelais';
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt = $pdo->prepare('SELECT * FROM point_relais WHERE ID_PR in( select
        ID_PR_INITIAL from colis where ID_COLIS= :id);');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $pos = $result["ACTIVITE"]." ".$result["NOM_PR"]." ".$result["VILLE"]." ".$result["CODE_POSTAL"];
        return $pos;
        
    }
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'tunirelais';
    $port = 3306;

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$dbName", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        

            
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
    function historique($id){
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbName = "tunirelais";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt1 = $pdo->prepare('SELECT ID_LIVRAISON, DATE_LIVRAISON FROM livraison WHERE ID_LIVRAISON IN (SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id) ORDER BY DATE_LIVRAISON ASC');
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    
        echo '<table>';
        echo '<tr>';
        echo '<th>livré aux point de relais</th>';
        echo '<th>date de livraison</th>';
        echo '</tr>';
    
        foreach ($result1 as $row){
            $idl = $row['ID_LIVRAISON'];
            $date = $row['DATE_LIVRAISON'];
            $stmt = $pdo->prepare('SELECT pr.NOM_PR, pr.ACTIVITE, pr.VILLE, pr.NOM_PRIORITAIRE, pr.CODE_POSTAL
                                  FROM point_relais pr
                                  JOIN livraison l ON pr.ID_PR = l.ID_PR_FIN
                                  WHERE l.ID_LIVRAISON = :idl');
            $stmt->bindParam(':idl', $idl);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo '<tr>';
            echo '<td>' . $res['ACTIVITE'] . ' ' . $res["NOM_PRIORITAIRE"] . ' ' . $res["VILLE"] . ' ' . $res["CODE_POSTAL"] . '</td>';
            echo '<td>' . $date . '</td>';
            echo '</tr>';
        }
    
        echo '</table>';
    }
    function destination($id){
        $hostname="localhost";
        $username='root';
        $password='';
        $dbname='tunirelais';
        $pdo=new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt=$pdo->prepare(' SELECT * from point_relais where ID_PR in (SELECT ID_PR_FINALE from colis where ID_COLIS=:id)');
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        $pos=$res["ACTIVITE"]." ".$res["NOM_PR"]." ".$res["VILLE"]." ".$res["CODE_POSTAL"];
        return $pos;
       }
       
}catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer les détails du colis
        $sql = "SELECT 
        c1.NOM_CLI AS NOM_EXPEDITEUR, c1.PRENOM_CLI AS PRENOM_EXPEDITEUR,
        c2.NOM_CLI AS NOM_DESTINATAIRE, c2.PRENOM_CLI AS PRENOM_DESTINATAIRE,
        NULL AS NOM_PR_INITIAL, NULL AS NOM_PR_FINALE,
        colis.ID_COLIS, colis.POIDS_COLIS, colis.TYPE_COLIS,
        colis.DATE_DEPART_COLIS, colis.COUT_COLIS_ESTIME, colis.COUT_EFFECTIF,
        colis.LARGEUR_COLIS, colis.LONGUEUR_COLIS
    FROM 
        colis
    JOIN 
        client c1 ON colis.ID_CLIENT_EXPEDITEUR = c1.ID_CLIENT
    JOIN 
        client c2 ON colis.ID_CLIENT_DESTINATAIRE = c2.ID_CLIENT
    WHERE 
        colis.ID_COLIS = :idColis
    
    UNION ALL
    
    SELECT 
        NULL AS NOM_EXPEDITEUR, NULL AS PRENOM_EXPEDITEUR,
        NULL AS NOM_DESTINATAIRE, NULL AS PRENOM_DESTINATAIRE,
        pr1.NOM_PR AS NOM_PR_INITIAL, NULL AS NOM_PR_FINALE,
        NULL AS ID_COLIS, NULL AS POIDS_COLIS, NULL AS TYPE_COLIS,
        NULL AS DATE_DEPART_COLIS, NULL AS COUT_COLIS_ESTIME, NULL AS COUT_EFFECTIF,
        NULL AS LARGEUR_COLIS, NULL AS LONGUEUR_COLIS
    FROM 
        colis
    JOIN 
        point_relais pr1 ON colis.ID_PR_INITIAL = pr1.ID_PR
    WHERE 
        colis.ID_COLIS = :idColis
    
    UNION ALL
    
    SELECT 
        NULL AS NOM_EXPEDITEUR, NULL AS PRENOM_EXPEDITEUR,
        NULL AS NOM_DESTINATAIRE, NULL AS PRENOM_DESTINATAIRE,
        NULL AS NOM_PR_INITIAL, pr2.NOM_PR AS NOM_PR_FINALE,
        NULL AS ID_COLIS, NULL AS POIDS_COLIS, NULL AS TYPE_COLIS,
        NULL AS DATE_DEPART_COLIS, NULL AS COUT_COLIS_ESTIME, NULL AS COUT_EFFECTIF,
        NULL AS LARGEUR_COLIS, NULL AS LONGUEUR_COLIS
    FROM 
        colis
    JOIN 
        point_relais pr2 ON colis.ID_PR_FINALE = pr2.ID_PR
    WHERE 
        colis.ID_COLIS = :idColis
 ";     

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
            
            echo '<th>client expéditeur</th>';
            echo '<th>client destinataire</th>';
            echo '<th> point relais initial</th>';
            echo '<th> point relais final</th>';
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
            echo '<td>' . $colis['NOM_EXPEDITEUR'] . ' ' . $colis['PRENOM_EXPEDITEUR'] . '</td>';
            echo '<td>' . $colis['NOM_DESTINATAIRE'] . ' ' . $colis['PRENOM_DESTINATAIRE'] . '</td>';
            echo '<td>' .posinit($idColis). '</td>';
            echo '<td>' . destination($idColis) . '</td>';
            echo '<td>' . $colis['POIDS_COLIS'] . '</td>';
            echo '<td>' . $colis['LARGEUR_COLIS'] . '</td>';
            echo '<td>' . $colis['LONGUEUR_COLIS'] . '</td>';
            echo '<td>' . $colis['DATE_DEPART_COLIS'] . '</td>';
            echo '<td>' . $colis['TYPE_COLIS'] . '</td>';
            echo '<td>' . $colis['COUT_COLIS_ESTIME'] .'dt'. '</td>';
            echo '<td>' . $colis['COUT_EFFECTIF'] .'dt'. '</td>';
            // Add more cells if needed
            echo '</tr>';
            echo '</table>';

                // Position actuelle du colis
               
                
               echo '<link rel="stylesheet" type="text/css" href="suivicolis.css">';
               
               echo '<table style="border-collapse: collapse; width: 80%; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">';
               echo '<tr>';
               echo '<td colspan="12">';
               echo "<h1 ><span style='color:#96145a;'>Position actuelle de votre colis :</span></h1>" . position_actuelle($idColis);
                echo '</tr>';
                echo '</table>';
                echo "<h1  style='color:#96145a; text-align:center;' ><span style='color:#96145a; text-align:center;'>Trajet de votre colis :</span></h1>";
                historique($idColis);
            }  else{
                
                echo position_actuelle($idColis);
            }
        }

    } catch (PDOException $e) {
        echo position_actuelle($idColi);
        echo "Erreur de connexion : " . $e->getMessage();
    }
    
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
        WHEN l.date_livraison > DATE_ADD(c.DATE_DEPART_COLIS, INTERVAL 7 DAY) THEN 'Diminution de prix'
        ELSE 'Pas de diminution de prix'
    END AS reduction_prix
 FROM livraison l
 JOIN livre lv ON l.id_livraison = lv.id_livraison
 JOIN colis c ON lv.id_colis = c.id_colis
 WHERE l.id_livraison = (SELECT id_livraison FROM livre WHERE id_colis = :idColis LIMIT 1)";

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
        $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        // Exécution de la deuxième requête
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':idColis', $idColis, PDO::PARAM_INT);
        $stmt2->execute();
        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        // Exécution de la troisième requête
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idColis', $idColis, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !$rows1 || !$rows2) {
            echo "Aucune information trouvée pour ce colis.";
        } else {
            $prixEstime = $row['COUT_COLIS_ESTIME'];

            foreach ($rows1 as $row1) {
                $nombreItineraires = $row1['nombre_itineraires'];
            }

            foreach ($rows2 as $row2) {
                $dateLivraison = $row2['date_livraison'];
                $reductionPrix = $row2['reduction_prix'];
            }

            // Calcul des réductions/augmentations en fonction des délais et des points relais
            $reductionPointRelaisInitial = 0.500;
            $reductionPointRelaisIntermediaire = 0.500;

            $delai = date_diff(date_create($dateLivraison), date_create())->days;

            $prixEffectif = $prixEstime;
            if ($delai > 7) { 
                $prixEffectif -= $reductionPointRelaisInitial;
            }
            // Supposons que $pointRelaisIntermediaire est récupéré de la base de données
            $prixEffectif -= ($nombreItineraires - 1) * $reductionPointRelaisIntermediaire;

            // Affichage des informations
           
            
            echo '<link rel="stylesheet" type="text/css" href="suivicolis.css">';
            echo "<h1  style='color:#96145a; text-align:center;' ><span style='color:#96145a; text-align:center;'>Prix :</span></h1>";

            echo '<table style="border-collapse: collapse; width: 80%; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">';
            echo '<tr>';
            echo '<td colspan="12">'; // Spanning across all columns
            echo "<br>Nombre d'itinéraires pour le colis : $nombreItineraires<br>";
            echo "Date de livraison : $dateLivraison<br>";
            echo "Réduction de prix a cause de retard : $reductionPrix<br>";
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
} catch (PDOException $e) {
   
    echo "Erreur de connexion : " . $e->getMessage();
}

//Fermeture de la connexion
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