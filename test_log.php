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
    $result = $stmt->fetch(PDO::FETCH_ASSOC); //tableau qui contient tous les donnes du client avec les cles sont les champs du table client4
    
  }
  else {
    header('Location:acceuil.php');
    exit();
  }
                          $a = isset($_POST['actual']) ? $_POST['actual'] : "";
                          $new = isset($_POST['new_password']) ? $_POST['new_password'] : "";

                          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if ($new != '') {
                              if ($a != $result['mot_de_passe']) {
                                echo "<span style='color:red'><br><br>mot de passe actuel incorrecte</span>";
                              } else {
                                $b = $result['id_client'];
                                $sql = "UPDATE client SET mot_de_passe = :new_password WHERE id_client = :id_client";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':new_password', $new);
                                $stmt->bindParam(':id_client', $b);
                                $stmt->execute();
                                echo "<br>mot de passe a été bien changé ";
                              }
                            } else {
                              echo "<span style='color:red'> <br>Le nouveau mot de passe ne doit pas être vide.</span>";
                            }
                          }
                          ?>