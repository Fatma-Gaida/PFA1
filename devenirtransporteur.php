
<?php
    $cin_livreur =$_POST["cin"];
    $nom_liv =$_POST["nom_l"];
    $prenom_liv =$_POST["prenom"];
    $disponibilite =$_POST["disponibilité"];
    $email_liv=$_POST["email_l"];
    $num_tel_liv=$_POST["numtel_l"];
    $adresse_liv=$_POST["adresse_l"];
    $ville_liv=$_POST["ville_l"];
    $moyen_transport=$_POST["tpye_trans"];
    $zone_act_géo=$_POST["zone"];
    $host = 'localhost';
    $dbname = 'app';
    $username = 'root';
    $password = '';  
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $query = "INSERT INTO livreur (cin_livreur,nom_liv,	prenom_liv,	disponibilite,	email_liv,	num_tel_liv	,adresse_liv,	ville_liv,	moyen_transport	,zone_act_géo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$cin_livreur,$nom_liv,$prenom_liv,$disponibilite,$email_liv,$num_tel_liv,$adresse_liv,$ville_liv,$moyen_transport,$zone_act_géo]);
    
        header("Location: acceuil.php?message=Votre compte a été créé avec succès");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }
    $pdo = null;
    ?>