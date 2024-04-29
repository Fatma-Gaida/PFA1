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
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $pos=$result2["ACTIVITE"]." ".$result2["NOM_PR"]." ".$result2["VILLE"]." ".$result2["CODE_POSTAL"];
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
              <div ><img src="" alt="logo"></div>
              <div ><span style="font-weight:bold; font-size:20px; margin-left:18%;">Espace livreur</span></div>
                  <span style="display:flex; text-align:center; position:absolute;right:2%;">Bonjour <?php echo $result1['PRENOM_LIV']?></span>  
              </div>   
        </nav>
        <div class="container">
          <div class="second_nav">
            <ul>
            <li><a href="espace_livreur.php" class="nav-link ">Mon Profil</a></li>
              <li> <a href="nvl.php" class="nav-link active">Nouvelle Commande</a></li>
              <li> <a href="#" class="nav-link ">livraisons effectués</a></li>
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
              <li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li><li>nsayer</li>
              </ul>
              
              </div>
           
          </div>
          <div class="main">
            <div> <div><h1 style="color:#96154a;">Nouvelle Commande</h1> <span>Consultez l'historique de vos livraisons </span></div> 
            <hr>
              <?php 
               $stmt=$pdo->prepare('SELECT ID_COLIS from colis ');
               $stmt->execute();
               $colis=$stmt->fetchALL(PDO::FETCH_ASSOC);
               foreach ($colis  as $coli){
                if (position_actuelle($coli['ID_COLIS'])!=destination($coli['ID_COLIS'])){
                  echo" colis n°:".$coli['ID_COLIS']." position actuelle:".position_actuelle($coli['ID_COLIS'])." destination du colis:".destination($coli['ID_COLIS'])."<br>";
                  
                }
              }
              ?>
            echo"
            <table>
              <tr>
                <th>ID_COLIS</th>
                <th>position_actuelle</th>
                <th>destination</th>
              </tr>
              <tr> 
              <td><label for="">option1</label> </td>
              <td>valeur2</td>
              <td>valeur3</td>
              <td><input type="checkbox"></td>
              </tr>
            </table>
             
            <?php 
            $stmt=$pdo->prepare('SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS==100');
            $stmt = $pdo->prepare('SELECT  p1.NOM_PR AS PR_INITIAL_NAME, p2.NOM_PR AS PR_FINALE_NAME,DATE_LIVRAISON,COUT_LIVRAISON,c.ID_COLIS,p1.VILLE AS src,p2.VILLE AS dest,p1.CODE_POSTAL AS cs, p2.CODE_POSTAL AS cd  FROM livraison AS l JOIN livre AS li ON l.ID_LIVRAISON = li.ID_LIVRAISON JOIN colis AS c ON li.ID_COLIS = c.ID_COLIS JOIN point_relais AS p1 ON c.ID_PR_INITIAL = p1.ID_PR JOIN point_relais AS p2 ON c.ID_PR_FINALE = p2.ID_PR WHERE l.CIN_LIVREUR =:id GROUP BY c.ID_COLIS;');
            $stmt->bindParam(':id', $_SESSION['CIN_LIVREUR']);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>    
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
  


