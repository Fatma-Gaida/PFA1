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
              <li> <a href="nouvelle_commande.php">Nouvelle Commande</a></li>
              <li> <a href="#" class="nav-link active">Suivi Des Commandes </a></li>
              <li> <a href="reclamation.php" class="nav-link">Reclamation</a></li>
              <li><a href="espace_client.php">Mon Profil</a></li>
              <li>
              <form style="background-color:white; padding:0; width:fit-content; margin:0;" action="logout.php"><input type="submit" id="logout" name="logout" value="Deconnexion"></form> </li></ul>
              <div style="color:white;">
              <ul>
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li></ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Suivi une Commande</h1></div> 
            <hr> 
                  <div style="display:flex;">
                  <form  class="compte" action="">
                    <div style="display:flex">
                    <div class="part1">
                    <br>
                    <label for="" type="number" required >Référence de colis*(6 chiffres):</label>  <br>
                    <input type="text" value="000 000"><br> <br> <br>
                    
                                  
                    </div>
                    </div>
                    <div id="buttont">
                    <input type="submit" id="buttonj" style="background-color:#96145a " value="suivi">
                    <img src="images/paperlane (3).png" alt="">
                    </div>

                    
                 </div> 
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
  
