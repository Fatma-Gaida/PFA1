<?php
  session_start();
  if (isset($_SESSION['CIN_LIVREUR'])){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    $stmt1 = $pdo->prepare('SELECT * FROM livreur WHERE CIN_LIVREUR = :id');
    $stmt1->bindParam(':id', $_SESSION['CIN_LIVREUR']);
    $stmt1->execute();
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
  }
  else {
    header('Location:acceuil.php');
    exit();
  }
  ?>
  <?php
$villes=[
    1=>"tunis",
    2=>"bizerte",
    3=>"nabeul",
    4=>"sousse",
    5=>"monastir",
    6=>"mahdia",
    7=>"sfax",
    8=>"beja",
    9=>"jandouba",
];
function verifier($d,$a,$aux){
  $handle = fopen('road.txt', 'r');
  $listeEntiers = [];
  if ($handle) {
      while (($line = fgets($handle)) !== false) {
          $int= explode(' ', $line);
          if (($int[0]==$d && $int[1]==$a)||($int[0]==$a && $int[1]==$d)){
              $ls=[];
              for ( $i=2;$i<11;$i++){
                  array_push($ls,$int[$i]);
                  if (in_array($aux, $ls)){
                      return 1;
                  }
              }
              }
          }
          return 0;
          fclose($handle);
      }
   else {
      echo 'Impossible d\'ouvrir le fichier.';
  }
}
function get_ville($ch,$villes){
  for ($i=1;$i<10;$i++){
      if (strpos($ch, $villes[$i])){
          return $i;
      }
  }

}
?>
  <?php
  
function position_actuelle($id){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    $stmt1 = $pdo->prepare('SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id');
    $stmt1->bindParam(':id', $id);
    $stmt1->execute();
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    if (empty($result1)){
        $stmt2 = $pdo->prepare('SELECT * FROM point_relais WHERE ID_PR in( select
         ID_PR_INITIAL from colis where ID_COLIS= :id);');
        $stmt2->bindParam(':id', $id);
        $stmt2->execute();
        $res = $stmt2->fetch(PDO::FETCH_ASSOC);
        $pos=$res["ACTIVITE"]." ".$res["NOM_PR"]." ".$res["VILLE"]." ".$res["CODE_POSTAL"];
        return $pos;
    }
    else {
        $stmt3 = $pdo->prepare('SELECT * FROM point_relais
        WHERE ID_PR IN 
        (SELECT ID_PR_FIN FROM livraison WHERE ID_LIVRAISON IN (SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id) 
        ORDER BY DATE_LIVRAISON );
        ');
        $stmt3->bindParam(':id', $id);
        $stmt3->execute();
        $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        $pos=$result3[count($result3)-1]["ACTIVITE"]." ".$result3[count($result3)-1]["NOM_PR"]." ".$result3[count($result3)-1]["VILLE"]." ".$result3[count($result3)-1]["CODE_POSTAL"];
        return $pos;
    }
}

?>
<?php 
 function destination($id){
  $hostname="localhost";
  $username='root';
  $password='';
  $dbname='app';
  $pdo=new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $stmt=$pdo->prepare(' SELECT * from point_relais where ID_PR in (SELECT ID_PR_FINALE from colis where ID_COLIS=:id)');
  $stmt->bindParam(':id',$id);
  $stmt->execute();
  $res=$stmt->fetch(PDO::FETCH_ASSOC);
  $pos=$res["ACTIVITE"]." ".$res["NOM_PR"]." ".$res["VILLE"]." ".$res["CODE_POSTAL"];
  return $pos;
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
              <div ><span style="font-weight:bold; font-size:20px; margin-left:18%;">Espace livreur</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result1['PRENOM_LIV']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            <ul>
            <li><a href="espace_livreur.php" class="nav-link ">Mon Profil</a></li>
              <li> <a href="nvl.php" class="nav-link active">Nouvelle Commande</a></li>
              <li> <a href="livraison_effectués.php" class="nav-link ">livraisons effectués</a></li>
              <!-- <li> <a href="#" class="nav-link">Reclamation</a></li> -->
             
              <li>
              <form  style="background-color:white; padding:0; width:fit-content; margin:0; " action="?logout=true" method="get"><input type="submit" id="logout" name="logout" value="Deconnexion" style="font-weight:bold;font-size:20px;" ;></form> </li></ul>
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
              </ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Nouvelle Commande</h1> <span>Consultez l'historique de vos livraisons </span></div> 
            <hr>
            <?php
              $stmt = $pdo->prepare('SELECT ID_COLIS FROM colis');
              $stmt->execute();
              $colis = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $st = $pdo->prepare('SELECT * FROM point_relais');
                $st->execute();
                $pr= $st->fetchAll(PDO::FETCH_ASSOC);
                
              ?>
            <form action="nvl.php" method="POST" class="nsayer">
            <table>
            <thead>
              <tr>
                <th>Colis n°</th>
                <th>Position actuelle</th>
                <th>Destination</th>
                <th>Sélectionner</th>
                <th>Point relais a remettre</th>
              </tr>
            </thead>
            <tbody>
              

            <?php foreach ($colis as $coli) : ?>
              <?php
              $positionActuelle = position_actuelle($coli['ID_COLIS']);
              $destinationColis = destination($coli['ID_COLIS']);
              ?>
              <?php if ($positionActuelle != $destinationColis) : ?>
                <tr>
                  <td><?php echo $coli['ID_COLIS']; ?></td>
                  <td><?php echo $positionActuelle; ?></td>
                  <td><?php echo $destinationColis; ?></td>
                  <td>
                  <input type="checkbox" name="choix[]" value="<?php echo $coli['ID_COLIS']; ?>">
                  </td>
                  <td>
                    <?php 
                      echo'<select name="point_relais[' .$coli['ID_COLIS'].']">';
                      // echo'<option>selectionner un point de relais</option>';
                      foreach ($pr as $p){
                        echo'<option>'.$p['ACTIVITE']." ".$p['NOM_PR']." ".$p['VILLE']." ".$p['CODE_POSTAL'].'</option>';
                      }
                      echo'</select>';
      
                     ?>
                      
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
        <input type="submit" class="raies"  value="envoyer une demande" name="submit">
        </form>
        <?php

if(isset($_POST['submit'])) {
// Vérifiez si des colis ont été sélectionnés
if(isset($_POST['choix'])) {
    $colisSelectionnes = $_POST['choix']; // Tableau contenant les ID des colis sélectionnés
    // echo$colisSelectionnes[1];
    // Parcourez les colis sélectionnés
    foreach($colisSelectionnes as $colisID) {
      
        echo "<br>";
        // Vérifiez si un point relais a été choisi pour ce colis
        if(isset($_POST['point_relais'][$colisID])) {
            // echo count($_POST['point_relais']);
            $pointRelais = $_POST['point_relais'][$colisID];
            $d =get_ville($destinationColis,$villes);
            $a=get_ville($positionActuelle,$villes);
            $aux=get_ville($pointRelais,$villes);
            if (verifier($d,$a,$aux)){
            echo "<span  style='color: green; margin-left: 5%;'>livraison pour le colis numero:".$colisID." accepté</span>";
            echo "<br>";}
            else{
              echo "<span  style='color: red; margin-left: 5%; padding-bottom:5%'>livraison pour le colis numero:".$colisID." refusée</span>";
              
            }
            echo "<br>";echo "<br>";
        }
    }
}}

?>
          </div>
          </div>
        </div>
        <footer>
          <img src="images/logo.png" style="width:10% ;height:10%;margin-left:0%" alt="logo">
          <span>Copyright &copy;.All right reserved</span>
          <span>Mail:<a href="#">relaiscolis2024@gmail.com</a></span> 
          <span>Phone:+216 50 100 100</span>
          <div>
              <p>Follow Us</p>
              <ul>
                <li><a href="#"><img src="images/icons8-facebook-48.png" alt="facebook"></a></li>
                <li><a href="#"><img src="images/icons8-instagram-48.png" alt="instagram"></a></li>
                <li> <a href=""><img src="images/icons8-linkedin-48.png" alt="instagram"></a></li>
                <li> <a href="#"><img src="images/icons8-twitter-48.png" alt="twitter"></a></li>
                <li><a href="#"><img src="images/icons8-pinterest-48.png" alt="pinterest"></a></li>
              </ul>
          </div>

      </footer>
  </body>
  </html>
  


