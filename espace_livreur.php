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
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour<?php// echo $result['prenom_cli']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            
            <ul>
              <li> <a href="#" class="nav-link">Nouvelle Commande</a></li>
              <li> <a href="#" class="nav-link">livraisons effectués</a></li>
              <li> <a href="#" class="nav-link">Reclamation</a></li>
              <li><a href="#" class="nav-link active">Mon Profil</a></li>
              <li>
              <form style="background-color:white; padding:0; width:fit-content; margin:0;" action="logout.php"><input type="submit" id="logout" name="logout" value="Deconnexion"></form> </li></ul>
              <div style="color:white;">
              <ul>
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li></ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Mon Profil</h1> <span>Gérez votre profil en toute sécurité</span></div> 
            <hr> 
                  <div style="display:flex;">
                  <form  class="compte" method="POST"  action="espace_client.php">
                    <div><span style="font-weight:bold; margin-left:10%;">COMPTE</div>
                    <div style="display:flex">
                    <div class="part1">
                    <br>
                    <label for="" >Prenom:</label>  <br>
                    <input type="text" value=<?php// echo $result['prenom_cli'] ;?> name="prenom"><br> <br>
                    <label  for="">Numero de telephone:</label> <br>
                    <input type="Number" name="numtel" value=<?php //echo $result['num_tel_cli'] ;?>> <br> <br>
                    <label  for="">Ville:</label> <br>
                    <input type="text" name="ville" value=<?php //echo $result['ville_cli'] ;?>> <br> <br>
                    <label  for="">Email:</label> <br>
                    <input type="text" name="email" value=<?php //echo $result['email_cli'] ;?>> <br> <br>

                    </div>
                    <div class="part2">
                    <br>
                    <label for="">Nom:</label>  <br>
                    <input type="text" value="<?php //echo $result['nom_cli'] ;?>" name="nom"><br> <br>
                    <label  for="">Adresse:</label> <br>
                    <input type="text" name="adresse" value="<?php //echo $result['adresse_cli'];?>"> <br> <br>
                    <label  for="">Code Postale:</label> <br>
                    <input type="text"value=<?php //echo $result['code_postale'] ;?> name="code_postale"> <br> <br>
                   <br>
                    <br> <br>
                    <input type="submit" id="button" name="button" value="Valider">
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
                     $cp=$_POST['code_postale'];
                     $sql = "UPDATE client SET nom_cli = '$nom_cli', prenom_cli = '$prenom_cli', adresse_cli = '$adresse_cli', email_cli = '$email_cli', num_tel_cli = '$num_tel_cli', ville_cli = '$ville_cli', code_postale = '$cp'";                    
                     $pdo->query($sql);
                     echo" <br> <br>Vos données ont été modifié";
                    } else { echo "<script>console.log('me dkhaltch ll theniya');</script>"; } }
                    
                    ?>
                    </div></div>
                 
                  </form>
                  <form  class="compte" action="espace_client.php"  method="POST">
                    <div><span style="font-weight:bold; margin-left:10%;">CHANGER LE MOT DE PASSE</div>
                    <div style="display:flex">
                    <div class="part1">
                    <br>
                    <label for=""> Mot de passe actuel</label>  <br>
                    <input type="password" name="actual"><br> <br>
                    </div>
                    <div class="part2">
                      <br>
                      <label  for="" >Nouveau mot de passe:</label> <br>
                      <input type="password"name="new_password" ><br> <br> <br>
                      <?php
                    // $a = isset($_POST['actual']) ? $_POST['actual'] : "";
                    // $new = isset($_POST['new_password']) ? $_POST['new_password'] : "";
                    // if ($_SERVER['REQUEST_METHOD'] === 'POST' &&(isset($_POST['button2']))) {
                    //   if ($a == $result['mot_de_passe']) {
                    //     if  ($new =='') {
                    //       echo "<span style='color:red'>Le nouveau mot de passe ne doit pas être vide.</span>";
                    //     } else {
                    //       $b = $result['id_client'];
                    //       $sql = "UPDATE client SET mot_de_passe = :new_password WHERE id_client = :id_client";
                    //       $stmt = $pdo->prepare($sql);
                    //       $stmt->bindParam(':new_password', $new);
                    //       $stmt->bindParam(':id_client', $b);
                    //       $stmt->execute();
                    //       echo "<br>mot de passe a été bien changé ";
                    //     }
                    //   } else {
                    //     echo "<span style='color:red'>mot de passe actuel incorrecte</span>";
                        
                    //   }
                    // }
                    // ?>
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
  
