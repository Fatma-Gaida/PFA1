
<?php
    $nom_commerce =$_POST["nom_enseigne"];
    $activité =$_POST["activité"];
    $nom_propriétaire =$_POST["nom_d"];
    $prénom_propriétaire =$_POST["prenom-d"];
    $num_tel_prop =$_POST["numtel_d"];
    $email_prop=$_POST["email_d"];
    $ville_pr=$_POST["ville_d"];
    $adresse_pr=$_POST["adresse_d"];
    $heures_ouverture=$_POST["heure_ouv"];
    $heures_fermeture=$_POST["heure_ferm"];
    $jours_disponible=$_POST["jours_dispo"];
    $capacitif_stockage=$_POST["stockage_d"];

    
    $host = 'localhost';
    $dbname = 'tunirelais';
    $username = 'root';
    $password = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $query = "INSERT INTO point_relais (nom_commerce, activité, nom_propriétaire, prénom_propriétaire, num_tel_prop, email_prop, ville_pr, adresse_pr, heures_ouverture, heures_fermeture, jours_disponible, capacitif_stockage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nom_commerce, $activité, $nom_propriétaire, $prénom_propriétaire, $num_tel_prop, $email_prop, $ville_pr, $adresse_pr, $heures_ouverture, $heures_fermeture, $jours_disponible, $capacitif_stockage]);
    
        header("Location: acceuil.php?message=Votre compte a été créé avec succès");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }
    $pdo = null;
    ?>



   