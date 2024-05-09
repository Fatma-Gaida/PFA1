<div class="progression">
    <ul id="progressbar">
      <li class="active">Détails de l'expéditeur</li>
      <li>Détails du destinataire</li>
      <li>Détails de colis</li>
      <li>Option de paiment</li>
    </ul>
  </div>
    <h4>Veuillez remplir les coordonnées de l'expéditeur</h4>

    <form class="form1" action="envoi.php" method="POST" onsubmit="return validateForm()">
    <div class="section1">
    <div class="part1">
      <div class="user-box">
        <input type="text" name="nom_ex" required="">
        <label>Nom</label>
      </div>
      <div class="user-box">
        <input type="text" id="numero" name="numtel_ex" required onblur="onBlurNumero()">
        <div id="numero-error" class="error-message"></div> 
        <label>Numero de Téléphone</label>
      </div>
      <div class="user-box">
        <input type="text" name="ville_ex" required="">
        <label>Ville</label>
      </div>
      <div class="user-box">
        <input type="text" name="adresse_ex" required="">
        <label>Adresse</label>
      </div>
      
    </div>
    <div class="part2">
      <div class="user-box">
        <input type="text" name="prenom_ex" required="">
        <label>Prénom</label>
      </div>
      <div class="user-box">
        <input type="text" name="email_ex" id="email" required onblur="validateEmail()">
        <div id="email-error" class="error-message"></div>
        <label>Adresse Email</label>
      </div>
      
      <div class="user-box">
      <input type="text" name="code_postal_cli_ex" required="">
      <label>Code postal</label>
    </div>
      <label>Point de Relais</label><br>
      <div class="select">
      <?php
$host = 'localhost';
$dbname = 'mysql';
$username = 'root';
$password = '';

try {
    // Création d'une connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Pour activer la gestion des exceptions

    // Préparation et exécution de la requête SQL
    $st = $pdo->prepare('SELECT * FROM point_relais');
    $st->execute();
    $pr = $st->fetchAll(PDO::FETCH_ASSOC);

    echo '<select name="pr_ex" id="pr_ex">'; // Ajout de l'ID pr_ex

    foreach ($pr as $p) {
        echo '<option value="' . $p['ID_PR'] . '">' . $p['ACTIVITE'] . " " . $p['NOM_PR'] . " " . $p['VILLE'] . " " . $p['CODE_POSTAL'] . '</option>';
    }
    echo '</select>';
} catch (PDOException $e) {
    // Gestion des exceptions
    echo "Erreur lors de la sélection : " . $e->getMessage();
}
?>


      </div>
      </div></div>

      <div  class="boutons">
      
    <input class="button2" type="submit" name="page1" style="margin-top: 45px ;margin-left:33%;" value="Continuer"/>
    </div>
   
    </form>