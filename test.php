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
         $result = $stmt->fetch(PDO::FETCH_ASSOC); //tableau qui contient tous les donnes du client avec les cles sont les champs du table client
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
              <div ><span style="font-weight:bold; font-size:20px; margin-left:18%;">Espace client</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result['prenom_cli']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            <ul>
              <li> <a href="test.php">Nouvelle Commande</a></li>
              <li> <a href="">Suivi Des Commandes </a></li>
              <li> <a href="">Reclamation</a></li>
              <li><a href="espace_client.php">Mon Profil</a></li>
              <li> <form action="logout.php"><input type="submit" name="logout" value="Deconnexion"></form></li>
              <div style="color:white;">
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li>
              
              </div>
            </ul>
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Mon Profil</h1> <span>Gérez votre profil en toute sécurité</span></div> 
            <hr> 
                  <div style="display:flex;">
                  <form  class="compte" action="">
                    <div><span style="    font-weight:bold; margin-left:10%;">COMPTE</div>
                    <div style="display:flex">
                    <div class="part1">
                    <br>
                    <label for="" >Prenom:</label>  <br>
                    <input type="text" value=<?php echo $result['prenom_cli'] ;?> ><br> <br>
                    <label  for="">Numero de telephone:</label> <br>
                    <input type="Number" value=<?php echo $result['num_tel_cli'] ;?>> <br> <br>
                    <label  for="">Ville:</label> <br>
                    <input type="text" value=<?php echo $result['ville_cli'] ;?>> <br> <br>
                    </div>
                    <div class="part2">
                      <br>
                    <label for="">Nom:</label>  <br>
                    <input type="text" value="<?php echo $result['nom_cli'] ;?>"><br> <br>
                    <label  for="">Adresse:</label> <br>
                    <input type="text" value="<?php echo $result['adresse_cli'];?>"> <br> <br>
                    <label  for="">Code Postale:</label> <br>
                    <input type="text"value=<?php echo "bonjour" ;?>> <br> <br>
                    <input type="submit" id="button" value="Valider">

                    </div></div>
                    
                  </form>
                  <form  class="compte" action="">
                    <div><span style="    font-weight:bold; margin-left:10%;">SÉCURITÉ</div>
                    <div style="display:flex">
                    <div class="part1">
                    <br>
                    <label for=""> Mot de passe actuel</label>  <br>
                    <input type="password"><br> <br>
                    </div>
                    <div class="part2">
                      <br>
                      <label  for="">Nouveau mot de passe:</label> <br>
                      <input type="password"><br> <br> <br>
                      <input type="submit" id="button" value=" Mettre à jour ">

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
  
