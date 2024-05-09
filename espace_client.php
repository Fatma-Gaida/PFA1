<?php
  session_start();
  if (isset($_SESSION['ID_CLIENT'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM client WHERE ID_CLIENT = :id');
    $stmt->bindParam(':id', $_SESSION['ID_CLIENT']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC); //tableau qui contient tous les donnes du client avec les cles sont les champs du table client4
  }
  else {
    header('Location:acceuil.php');
    exit();
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="espace_client.css">
  </head>
  <body>
        <nav> 
              <div class="nav_items">
              <div ><img src="images/logo.png" style="width:30% ;height:30%;margin-left:0%" alt="logo"></div>
              <div ><span style="font-weight:bold; font-size:20px; margin-left:60%;">Espace client</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result['PRENOM_CLI']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            
            <ul>
              <li><a href="" class="nav-link active">Mon Profil</a></li>
              <li> <a href="nouvelle_commande.php" class="nav-link">Nouvelle Commande</a></li>
              <li> <a href="suivi.php" class="nav-link">Suivi Des Commandes </a></li>
              <li> <a href="reclamation.php" class="nav-link">Reclamation</a></li>
             
              <li>

              <form action="?logout=true" method="get" style="background-color:white; padding:0; width:fit-content; margin:0;"><input type="submit" id="logout" name="logout" value="Deconnexion" style="font-weight:bold;font-size:20px;"></form> </li></ul>
              <?php
              // Vérifier si le formulaire de déconnexion a été soumis
              if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['logout'])) {
                  // Détruire toutes les variables de session
                  session_unset();
                  
                  // Détruire la session
                  session_destroy();

                  // Rediriger l'utilisateur vers la page de connexion
                  header("Location: acceuil.php");
                  exit;
              }
              ?>
              <div style="color:white;">
              <ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Mon Profil</h1> <span>Gérez votre profil en toute sécurité</span></div> 
            <hr> 
                  <div style="display:flex;">
                  <form  class="compte1" method="POST"  action="espace_client.php">
                    <div>
                    <div><span style="font-weight:bold;  margin-left:40%;">COMPTE</div>
                    <div style="display:flex">
                    <div class="part11">
                    <br>
                    <label for="" >Prenom:</label>  <br>
                    <input type="text" value=<?php echo $result['PRENOM_CLI'] ;?> name="prenom"><br> <br>
                    <label  for="">Numero de telephone:</label> <br>
                    <input type="Number" name="numtel" value=<?php echo $result['NUM_TEL_CLI'] ;?>> <br> <br>
                    <label  for="">Ville:</label> <br>
                    <input type="text" name="ville" value=<?php echo $result['VILLE_CLI'] ;?>> <br> <br>
                    <label  for="">Email:</label> <br>
                    <input type="text" name="email" value=<?php echo $result['EMAIL_CLI'] ;?>> <br> <br>

                    </div>
                    <div class="part2">
                    <br>
                    <label for="">Nom:</label>  <br>
                    <input type="text" value="<?php echo $result['NOM_CLI'] ;?>" name="nom"><br> <br>
                    <label  for="">Adresse:</label> <br>
                    <input type="text" name="adresse" value="<?php echo $result['ADRESSE_CLI'];?>"> <br> <br>
                    <label  for="">Code Postale:</label> <br>
                    <input type="text" name="code_postal_cli" value="<?php echo $result['code_postale'] ;?>" > <br> <br>
                   <br>
                    <br> <br></div></div>
                    <div>
                    <input type="submit" id="button" name="button" value="Valider"></div>
                    <?php 
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                     echo "<script>console.log(' dkhalt ll loula');</script>";
                     if (isset($_POST['button'])){
                      echo "<script>console.log('  dkhalt ll theniya');</script>";
                     $nom_cli = $_POST['nom'];
                     $prenom_cli = $_POST['prenom'];
                     $adresse_cli = $_POST['adresse'];
                     $email_cli = $_POST['email'];
                     $num_tel_cli = $_POST['numtel'];
                     $ville_cli = $_POST['ville']; 
                     $cp=$_POST['code_postal_cli'];
                     $sql = "UPDATE client SET nom_cli = '$nom_cli', prenom_cli = '$prenom_cli', adresse_cli = '$adresse_cli', email_cli = '$email_cli', num_tel_cli = '$num_tel_cli', ville_cli = '$ville_cli', code_postal_cli = '$cp'";                    
                     $pdo->query($sql);
                     echo" <br> <br>Vos données ont été modifié";
                    } else { echo "<script>console.log('me dkhaltch ll theniya');</script>"; } }
                    
                    ?>
                    </div>
                 
                  </form>
                  <form  class="compte1" action="espace_client.php"  method="POST">
                    <div><span style="font-weight:bold; margin-left:20%;text-align:center;">CHANGER LE MOT DE PASSE</div>
                    <div style="display:flex">
                    <div class="part11" >
                    <br>
                    <label for=""> Mot de passe actuel :</label>  <br>
                    <input type="password" name="actual"><br> <br>
                    </div>
                    <div class="part2">
                      <br>
                      <label  for="" >Nouveau mot de passe:</label> <br>
                      <input type="password"name="new_password" ><br> <br> <br>
                      <?php
                    $a = isset($_POST['actual']) ? $_POST['actual'] : "";
                    $new = isset($_POST['new_password']) ? $_POST['new_password'] : "";
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&(isset($_POST['button2']))) {
                      if ($a == $result['MOTDEPASSE_CLIENT']) {
                        if  ($new =='') {
                          echo "<span style='color:red'>Le nouveau mot de passe ne doit pas être vide.</span>";
                        } else {
                          $b = $result['ID_CLIENT'];
                          $sql = "UPDATE client SET MOTDEPASSE_CLIENT = :new_password WHERE id_client = :id_client";
                          $stmt = $pdo->prepare($sql);
                          $stmt->bindParam(':new_password', $new);
                          $stmt->bindParam(':id_client', $b);
                          $stmt->execute();
                          echo "<br>mot de passe a été bien changé ";
                        }
                      } else {
                        echo "<span style='color:red'>mot de passe actuel incorrecte</span>";
                        
                      }
                    }
                    ?>
                      <input type="submit" id="button2" name="button2" value=" Mettre à jour ">
                    </div></div>
                  
                    
                   </form> </div> 
              
                      
            </div>
          </div>
        </div>
        <footer>
        <img src="images/logo.png"style="width:10% ;height:10%;margin-left:0%" alt="logo">
          <span>Copyright &copy;.All right reserved</span>
          <span>Mail:<a href="#">relaiscolis2024@gmail.com</a></span> 
          <span>Phone:+216 50 100 100</span>
          <div>
              <p>Follow Us</p>
              <ul>
                <li><a href="#"><img src="images/icons8-facebook-48.png" alt=""></a></li>
                <li><a href="#"><img src="images/icons8-instagram-48.png" alt=""></a></li>
                <li> <a href=""><img src="images/icons8-linkedin-48.png" alt="instagram"></a></li>
                <li> <a href="#"><img src="images/icons8-twitter-48.png" alt="twitter"></a></li>
                <li><a href="#"><img src="images/icons8-pinterest-48.png" alt="pinterest"></a></li>
              </ul>
          </div>

      </footer>
  </body>
  </html>
  
