<?php
  session_start();
  if (isset($_SESSION['CIN_LIVREUR'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM livreur WHERE CIN_LIVREUR = :id');
    $stmt->bindParam(':id', $_SESSION['CIN_LIVREUR']);
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
              <div ><img src="" alt="logo"></div>
              <div ><span style="font-weight:bold; font-size:20px; margin-left:18%;">Espace livreur</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result['PRENOM_LIV']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            <ul>
            <li><a href="#" class="nav-link active">Mon Profil</a></li>
              <li> <a href="nvl.php" class="nav-link">Nouvelle Commande</a></li>
              <li> <a href="livraison_effectués.php" class="nav-link">livraisons effectués</a></li>
              <!-- <li> <a href="#" class="nav-link">Reclamation</a></li> -->
              <li>
              <form  style="background-color:white; padding:0; width:fit-content; margin:0;" action="?logout=true" method="get"><input type="submit" id="logout" name="logout" value="Deconnexion"></form> </li></ul>
              <div style="color:white;">
              <ul>
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
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li></ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Mon Profil</h1> <span>Gérez votre profil en toute sécurité</span></div> 
            <hr> 
                  <div style="display:flex;">
                  <form  class="compte1" method="POST"  action="espace_livreur.php">
                    <div><span style="font-weight:bold; margin-left:10%;">COMPTE</div>
                    <div style="display:flex">
                    <div class="part11">
                    <br>
                    <label for="" >Prenom:</label>  <br>
                    <input type="text" value=<?php echo $result['PRENOM_LIV'];?> name="prenom"><br> <br>
                    <label  for="">Numero de telephone:</label> <br>
                    <input type="Number" name="numtel" value=<?php echo $result['NUM_TEL_LIV'] ;?>> <br> <br>
                    <label  for="">Ville:</label> <br>
                    <input type="text" name="ville" value=<?php echo $result['ville'] ;?>> <br> <br>
                    <label  for="">Email:</label> <br>
                    <input type="text" name="email" value=<?php echo $result['EMAIL_LIV'] ;?>> <br> <br>
                    </div>
                    <div class="part2">
                    <br>
                    <label for="">Nom:</label>  <br>
                    <input type="text" value="<?php echo $result['NOM_LIV'] ;?>" name="nom"><br> <br>
                    <label  for="">Adresse:</label> <br>
                    <input type="text" name="adresse" value="<?php echo $result['adresse_liv'];?>"> <br> <br>
                    <label  for="">Numéro CIN:</label> <br>
                    <input type="text"value=<?php echo $result['CIN_LIVREUR'] ;?> name="cin_liv"> <br> <br>
                    <label  for="">Marque de voiture:</label> <br>
                    <input type="text"value=<?php echo $result['TYPE_TRANSPORT'] ;?> name="type_transport"> <br> <br>
                   <br>
                    <br> <br>
                    <input type="submit" id="button" name="button_liv" value="Valider">
                    <?php 
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                     echo "<script>console.log(' dkhalt ll loula');</script>";
                     if (isset($_POST['button_liv'])){
                      echo "<script>console.log('  dkhalt ll theniya');</script>";
                     $nom_cli = $_POST['nom'];
                     $prenom_cli = $_POST['prenom'];
                     $adresse_cli = $_POST['adresse'];
                     $email_cli = $_POST['email'];
                     $num_tel_cli = $_POST['numtel'];
                     $ville_cli = $_POST['ville']; 
                     $cin=$_POST['cin_liv'];
                     $cp=$_POST['type_transport'];
                     $sql = "UPDATE livreur SET NOM_LIV = '$nom_cli', PRENOM_LIV = '$prenom_cli', ADRESSE_LIV = '$adresse_cli', EMAIL_LIV = '$email_cli', NUM_TEL_LIV = '$num_tel_cli', ville = '$ville_cli', TYPE_TRANSPORT = '$cp'";                    
                     $pdo->query($sql);
                     echo" <br> <br>Vos données ont été modifié";
                    } else { echo "<script>console.log('me dkhaltch ll theniya');</script>"; } }
                    
                    ?>
                    </div></div>
                 
                  </form>
                  <form  class="compte1" action="espace_livreur.php" method="POST">
                    <div><span style="font-weight:bold; margin-left:10%;">CHANGER LE MOT DE PASSE</div>
                    <div style="display:flex">
                    <div class="part11">
                    <br>
                    <label for=""> Mot de passe actuel</label>  <br>
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
                      if ($a == $result['MOTDEPASSE_LIV']) {
                        if  ($new =='') {
                          echo "<span style='color:red'>Le nouveau mot de passe ne doit pas être vide.</span>";
                        } else {
                          $b = $result['CIN_LIVREUR'];
                          $sql = "UPDATE livreur SET MOTDEPASSE_LIV = :new_password WHERE CIN_LIVREUR = :cin_livreur";
                          $stmt = $pdo->prepare($sql);
                          $stmt->bindParam(':new_password', $new);
                          $stmt->bindParam(':cin_livreur', $b);
                          $stmt->execute();
                          echo "<br>mot de passe a bien été  changé ";
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
          <img src="" alt="logo">
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
  





  