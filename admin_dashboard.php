<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
   
  </head>
  <body>
  <nav> 
              <div class="nav_items">
              <div ><img src="images/logo.png" style="width:30% ;height:30%;margin-left:0%" alt="logo"></div>
              <div ><span style="font-weight:bold; font-size:20px; margin-left:18%;">Espace admin</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour admin!  
              </div>   
        </nav>
        <div id="gif">
       
        <img id="image" src="images/rec.png"></div>
        <?php
// Connexion à la base de données
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbName = 'tunirelais'; // Remplacez "nom_de_votre_base_de_donnees" par le nom de votre base de données
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Traitement du formulaire de mise à jour du statut de la réclamation
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
         // Ajoutez cette ligne pour récupérer l'ID_REC du formulaire
        $new_status = $_POST['new_status'];
    
        if ($new_status === 'Closed') {
            // Supprimer la réclamation de la base de données
            $delete_sql = "DELETE FROM reclamations WHERE ID_REC = :reclamation_id";
            $stmt = $pdo->prepare($delete_sql);
            $stmt->bindParam(':reclamation_id', $reclamation_id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Mettre à jour le statut de la réclamation dans la base de données
            $update_sql = "UPDATE reclamations SET statut = :new_status WHERE ID_REC = :reclamation_id";
            $stmt = $pdo->prepare($update_sql);
            $stmt->bindParam(':new_status', $new_status, PDO::PARAM_STR);
            $stmt->bindParam(':reclamation_id', $reclamation_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    // Envoyer une notification au client (remplacez cette partie par votre propre logique d'envoi de notification)
    // Exemple de code pour l'envoi de notification par e-mail :
    // mail($client_email, "Votre réclamation a été mise à jour", "Le statut de votre réclamation a été mis à jour à : $new_status");



    // Requête pour récupérer toutes les données de la table reclamation avec le nom du client associé
    $sql = "SELECT  c.NOM_CLI,c.PRENOM_CLI, r.description, r.statut, r.temps_rec
            FROM reclamations r
            INNER JOIN client c ON r.ID_CLIENT = c.ID_CLIENT
            WHERE r.statut != 'Fermé'  -- Exclure les réclamations fermées
            ORDER BY r.temps_rec DESC";  
    $stmt = $pdo->query($sql);
    $reclamations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des données dans un tableau HTML
    if (!empty($reclamations)) {
      
      echo '<table >';
      echo '<tr><th>Nom du client</th><th>Prenom du client</th><th>Description</th><th>Statut</th><th>Temps de réclamation</th></tr>';
      foreach ($reclamations as $reclamation) {
          echo '<tr>';
          echo '<td>' . $reclamation['PRENOM_CLI'] . '</td>';
          echo '<td>' . $reclamation['NOM_CLI'] . '</td>';
          echo '<td>' . $reclamation['description'] . '</td>';
          echo '<td>';
          echo '<form method="post">';
          
          echo '<select name="new_status">';
          echo '<option value="Pending" ' . ($reclamation['statut'] == 'Pending' ? 'selected' : '') . '>En attente</option>';
          echo '<option value="Resolved" ' . ($reclamation['statut'] == 'Resolved' ? 'selected' : '') . '>Résolu</option>';
          echo '<option value="Closed" ' . ($reclamation['statut'] == 'Closed' ? 'selected' : '') . '>Fermé</option>';
          echo '</select>';
          
          echo '<button class="btn" type="submit" name="update_status">Mettre à jour</button>';
          echo '</form>';
          echo '</td>';
          echo '<td>' . $reclamation['temps_rec'] . '</td>';
          echo '</tr>';
      }
      echo '</table>';
       
    } else {
        echo "Aucune réclamation trouvée.";
    }} 
catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
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
  