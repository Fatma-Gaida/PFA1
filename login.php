<?php
 if (isset($_SESSION['id'])){
    header('Location:espace_client.php');
}
 
// declare(strict_types=1);
// Database connection details
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbName = 'tunirelais';
session_start();
try {
    // Create a PDO instance for database connection
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['pwd'] ?? '';
        $option=$_POST['option'] ?? '';
        if ($option=='client'){
        // Prepare a SQL statement to select the username and password from the database
        $stmt = $pdo->prepare('SELECT * FROM client WHERE EMAIL_CLI = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // foreach($result as  $val=>$key){
        //     echo $val;
        //     echo "<br>";
        // }
        if ($result) {

            // Username exists in the database
            $a = $result['EMAIL_CLI'];
            $b = $result['MOTDEPASSE_CLIENT'];
            $c=$result['NOM_CLI'];
            $d=$result['PRENOM_CLI'];
            $e=$result['ID_CLIENT'];
            $f=$result['NUM_TEL_CLI'];
            $g=$result['ADRESSE_CLI'];
            // Verify the password
            if ($b=$password) {
                // Password matches
                // header("Location: espace_client.php");
                $_SESSION['ID_CLIENT'] = $e;
                // header('Location:espace_client.php');
                exit();
            } else {
                $errorMsg = 'Mot de passe invalide.';
                
            }
        } else {
            // Username does not exist
            echo 'eamil incorrecte';
        }   
        if (!empty($errorMsg)) {
            echo  $errorMsg;
        }
        
    } else if ($option=='livreur'){
        $stmt = $pdo->prepare('SELECT * FROM livreur WHERE  EMAIL_LIV= :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Username exists in the database
            $a = $result['EMAIL_LIV'];
            $b = $result['MOTDEPASSE_LIV'];
            $c=$result['NOM_LIV'];
            $d=$result['PRENOM_LIV'];
            $e=$result['CIN_LIVREUR'];
            $f=$result['NUM_TEL_LIV'];
            // Verify the password
            if ($password==$b) {
                // Password matches
                // header("Location: espace_client.php");
                $_SESSION['CIN_LIVREUR'] = $e;
                // header('Location:espace_client.php');
                exit();
            } else {
                $errorMsg = 'Mot de passe invalide.';
                
            }
        } else  {
            // Username does not exist
            echo 'eamil incorrecte';
        }   
        if (!empty($errorMsg)) {
            echo  $errorMsg;
        }

    }
}
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

?>
