<?php
  session_start();
  if (isset($_SESSION['id_client'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM client WHERE id_client = :id');
    $stmt->bindParam(':id', $_SESSION['id_client']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "bonjour ".$result['prenom_cli']."<br>";
    foreach($result as  $val=>$key){
        if ($val=='prenom_cli'){continue;}
        echo $val.': '.$key;
        echo "<br>";
    }
  }

  else {
    header('Location:acceuil.php');
    exit();
  }

  

  session_start();
  if (isset($_SESSION['id_client'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM client WHERE id_client = :id');
    $stmt->bindParam(':id', $_SESSION['id_client']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "bonjour ".$result['prenom_cli']."<br>";
    foreach($result as  $val=>$key){
        if ($val=='prenom_cli'){continue;}
        echo $val.': '.$key;
        echo "<br>";
    }
  }

  else {
    header('Location:acceuil.php');
    exit();
  }

  ?>