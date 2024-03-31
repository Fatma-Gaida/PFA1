<?php
//  if (isset($_SESSION['id'])){
//     header('Location:espace_client.php');
// }
 
// declare(strict_types=1);
// Database connection details
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbName = 'app';
session_start();
try {
    // Create a PDO instance for database connection
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['pwd'] ?? '';

        // Prepare a SQL statement to select the username and password from the database
        $stmt = $pdo->prepare('SELECT * FROM client WHERE email_cli = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // foreach($result as  $val=>$key){
        //     echo $val;
        //     echo "<br>";
        // }
        

        if ($result) {
            // Username exists in the database
            $a = $result['email_cli'];
            $b = $result['mot_de_passe'];
            $c=$result['nom_cli'];
            $d=$result['prenom_cli'];
            $e=$result['id_client'];
            $f=$result['num_tel_cli'];
            $g=$result['adresse_cli'];
            // Verify the password
            if ($password==$b) {
                // Password matches
                // header("Location: espace_client.php");
                $_SESSION['id_client'] = $e;
                header('Location:espace_client.php');
                exit();
            } else {
                $errorMsg = 'Mot de passk ghalett!!.';
                
            }
        } else {
            // Username does not exist
            echo 'eamil ghalet';
        }
        if (!empty($errorMsg)) {
            echo '<p>' . $errorMsg . '</p>';
        }
    }
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
