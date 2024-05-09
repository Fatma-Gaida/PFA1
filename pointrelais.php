<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relais Colis</title>
  
  <link rel="stylesheet" href="pointrelais.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

</head>
<body> 
    <nav>
      <ul style="justify-content:left;">
      <li><img src="images/logo.png"  style="width:30% ;height:30%;margin-left:0%"  alt="logo"></li>
        <li><a href="#">acceuil</a></li>
        <li><a href="suivi.html">suivi de colis </a></li>
        <li><a href="envoi.php">envoi de colis</a></li>
        <li><a href="#">Nos points de relais </a></li>
        <li>
        <div id="loginContainer" style="padding-top: 2.5px;">
          <div id="loginButton" style="display: flex; align-items: center; justify-content: center; width: fit-content;">
            <span>Connexion</span>
          </div>
          <div style="clear:both"></div>
          <div id="loginBox">
          <form id="loginForm" action="acceuil.php" method="POST">
    <fieldset id="body">
            <fieldset >
            <label for="" >Se conecter en tant que:</label>
            <label>
              <input type="radio" name="option" style="width:fit-content;" value="option1"  required>
              livreur
            </label>

            <label>
              <input type="radio" name="option" style="width:fit-content;" value="option2" required >
              client
            </label>
        </fieldset> 
        <fieldset>
            <label id="emailLabel" for="email">Adresse email</label>
            <input type="text" name="email" id="email" />
        </fieldset>
        <fieldset>
            <label id="passwordLabel" for="pwd">Mot de passe</label>
            <input type="password" name="pwd" id="password" />
            <span id="error-msg" style="color:red;"></span>
        </fieldset>
        <input type="submit" id="login" value="Je me connecte" />
        <span style="text-align:right; text-decoration: underline;"><a href="#">Mot de passe oublié?</a></span>
        <input type="button" id="signup" value="Créer un compte" />
    </fieldset>
    </form>

<script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission

        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Prepare the request
        xhr.open("POST", "login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Set up the callback function
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    console.log(response);
                    if (response === "") {
                      console.log("before ");
                        window.location.href = "espace_client.php";
                        console.log("after");
                    } else { 
                        document.getElementById("error-msg").textContent = response;
                    }
                } else {
                    console.log("Error: " + xhr.status);
                }
            }
        };

        // Send the request
        xhr.send("email=" + encodeURIComponent(email) + "&pwd=" + encodeURIComponent(password));
    });
   </script>
             
       
       </div>
      </div>
        </div>
      </div></li>
      </ul>
      
    </nav> 
    <script src="nav.js"></script>
      <div id="gif">
       
        <img id="image" src="images/gps.png"></div>
        
        <div>
            <h1 id='titre'><span style="color: #96154a;">Trouver votre Point Relais</span></h1>
            
        </div>
        <form class="form" action="pointrelais.php" method="get">
        <div class="input-box">
            <input type="text" name="code_postal" placeholder="code postal"required >
            <select name="ville" id="villes" required >
                <option value="Tunis">Tunis</option>
                <option value="Sfax">Sfax</option>
                <option value="Sousse">Sousse</option>
                <option value="Kairouan">Kairouan</option>
                <option value="Gabès">Gabès</option>
                <option value="Bizerte">Bizerte</option>
                <option value="Gafsa">Gafsa</option>
                <option value="Monastir">Monastir</option>
                <option value="La Marsa">La Marsa</option>
                <option value="Nabeul">Nabeul</option>
                <option value="Hammamet">Hammamet</option>
                <option value="Mahdia">Mahdia</option>
                <option value="Tozeur">Tozeur</option>
                <option value="Djerba">Djerba</option>
                <option value="Tataouine">Tataouine</option>
            </select>
            <button type="submit" class="btn">Trouver</button></div></form>
            <?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'mysql';

    // Create a PDO connection
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);

    if (isset($_GET['code_postal']) && isset($_GET['ville'])) {
        // Récupération des coordonnées du point de relais depuis le formulaire
        $codePostal = $_GET['code_postal'];
        $ville = $_GET['ville'];
        // Requête pour sélectionner les détails du point de relais à partir de la base de données
        $query = "SELECT * FROM point_relais WHERE code_postal = :code_postal AND ville = :ville";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':code_postal', $codePostal);
        $stmt->bindParam(':ville', $ville);
        $stmt->execute();

        // Récupération des résultats de la requête
        $pointRelais = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pointRelais) {
          
          echo '<link rel="stylesheet" type="text/css" href="pointrelais.css">';
            echo '<h1 style=" text-align: center;
            font-size: xx-large;" >Détails du point de relais :</h1>';
            echo '<table style="border-collapse: collapse;
            width: 80%;
            margin: 0 auto; /* Center the table */
            border-radius: 10px;
            overflow: hidden; /* Hide overflow from rounded corners */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add a soft shadow */" >';
            echo '<tr>';
            echo '<th>Nom du Point Relais</th>';
            echo '<th>Heure d\'ouverture</th>';
            echo '<th>Heure de fermeture</th>';
            echo '<th>Jours de disponibilité</th>';
            echo '<th>Capacité de stockage</th>';
            echo '<th>Activité</th>';
            // Add more columns if needed
            echo '</tr>';
            echo '<tr>';
            
            echo '<td>' . $pointRelais['NOM_PR'] . '</td>';
            echo '<td>' . $pointRelais['HEURE_OUVERTURE'] . '</td>';
            echo '<td>' . $pointRelais['HEURE_FERMETURE'] . '</td>';
            echo '<td>' . $pointRelais['JOURS_DISPONIBILITE'] . '</td>';
            echo '<td>' . $pointRelais['CAPACITE_STOCKAGE'] . '</td>';
            echo '<td>' . $pointRelais['ACTIVITE'] . '</td>';
            // Add more cells if needed
            echo '</tr>';
            echo '</table>';
        } else {
            echo 'Aucun point de relais correspondant trouvé.';
        }
    }
?>

  
        
        <footer>
          
            <img src="images/logo.png"  style="width:15% ;height:20%;margin-left:0%" alt="logo">
            <span>Copyright &copy;.All right reserved</span>
            <span>Mail:<a href="#">relaiscolis2024@gmail.com</a></span> 
            <span>Phone:+216 50 100 100</span>
            <div>
                <p>Follow Us</p>
                <ul>
                <li><a href="#"><img src="images/icons8-facebook-48.png" alt="facebook"></a></li>
                  <li><a href="#"><img src="images/icons8-instagram-48.png" alt="instagram"></a></li>
                  <li> <a href=""><img src="images/icons8-linkedin-48.png" alt="linkedin"></a></li>
                  <li> <a href="#"><img src="images/icons8-twitter-48.png" alt="twitter"></a></li>
                  <li><a href="#"><img src="images/icons8-pinterest-48.png" alt="pinterest"></a></li>
                </ul>
            </div>
        
        </footer> 
    </body>

    </html>
        