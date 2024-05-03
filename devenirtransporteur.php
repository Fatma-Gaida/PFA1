<?php
$cin_livreur = $_POST["cin"];
$nom_liv = $_POST["nom_l"];
$prenom_liv = $_POST["prenom_l"];
$disponibilite = $_POST["disponibilite"];
$email_liv = $_POST["email_l"];
$num_tel_liv = $_POST["numtel_l"];
$moyen_transport = $_POST["tpye_trans"];
$mot_de_passe = $_POST["mdp_liv"];
$confirm_mdp = $_POST['Confirmation'];

if ($mot_de_passe != $confirm_mdp) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

$host = 'localhost';
$dbname = 'tunirelais';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "INSERT INTO livreur (
        CIN_LIVREUR,
        NOM_LIV,
        PRENOM_LIV,
        JOURS_DISPONIBILITE,
        EMAIL_LIV,
        NUM_TEL_LIV,
        TYPE_TRANSPORT,
        MOTDEPASSE_LIV) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$cin_livreur, $nom_liv, $prenom_liv, $disponibilite, $email_liv, $num_tel_liv, $moyen_transport, $mot_de_passe]);

   
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion des données : " . $e->getMessage();
}
$pdo = null;
?>
