<?php
$nom_cli = $_POST['nom'];
$prenom_cli = $_POST['prenom'];
$adresse_cli = $_POST['adresse'];
$email_cli = $_POST['email'];
$num_tel_cli = $_POST['numtel'];
$ville_cli = $_POST['ville'];
$mot_de_passe = $_POST['pwd'];
$host = 'localhost';
$dbname = 'app';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO client (nom_cli, prenom_cli, adresse_cli, email_cli, num_tel_cli, ville_cli, mot_de_passe) VALUES ('$nom_cli', '$prenom_cli', '$adresse_cli', '$email_cli', '$num_tel_cli', '$ville_cli', '$mot_de_passe')";

    $pdo->query($sql);

    header("Location: acceuil.php?message=Votre compte a été créé avec succès");
    exit();
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion des données : " . $e->getMessage();
}
$pdo = null;
?>