<?php
  session_start();
  if (isset($_SESSION['ID_CLIENT'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'tunirelais';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM client WHERE ID_CLIENT = :id');
    $stmt->bindParam(':id', $_SESSION['ID_CLIENT']);
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
              <div style="margin-left: 0%;" class="nav_items">
              <div ><img src="images/logo.png"  style="margin-right:100%;width: 30%;height:30%;"  alt="logo"><span style="font-weight:bold; font-size:20px; margin-left:60%;">Espace client</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result['PRENOM_CLI']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            
            <ul> <li><a href="espace_client.php">Mon Profil</a></li>
              <li> <a href="nouvelle_commande.php">Nouvelle Commande</a></li>
              <li> <a href="suivi.php" class="nav-link">Suivi Des Commandes </a></li>
              <li> <a href="#" class="nav-link active">Reclamation</a></li>
             
              <li>
              <form action="?logout=true" method="get" style="background-color:white; padding:0; width:fit-content; margin:0;"><input type="submit" id="logout" name="logout" value="Deconnexion" style="font-weight:bold;font-size:20px;"></form> </li></ul>
              <div style="color:white;">
              <ul>
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li></ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Ajouter une reclamation</h1></div> 
            <hr> 
                  <div style="display:flex;">
                  <form  class="compte" style="margin-left=40%;"action="">
                    <div style="display:flex">
                    <div class="part1">
                    <br>
                    <label for="" type="number" required >Référence de colis*(6 chiffres):</label>  <br>
                    <input type="text" value="000 000"><br> <br> <br>
                    <label  for="" required>Motif de reclamation*:</label> <br>
                    <select name="" id="">
                    <option value="" required>Choisir le type de reclamation</option>
                       <option value="">Colis en retard</option>
                       <option value="">Colis perdu</option>
                    </select> <br><br>   
                    <label for="" >Message:</label>
                    <textarea name="" style="background-color:white;" id="" cols="30" rows="10"></textarea>                   
                    </div>
                    </div>
                    <div id="buttont">
                    <input type="submit" id="buttonj" style="background-color:transparent"; value="envoyer">
                    <img src="images/paperlane (3).png" alt="">
                    </div>

                    
                 </div> 
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
  
