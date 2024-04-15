<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relais Colis</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <!-- <script src="nav.js"></script> -->
</head>
<body> 
    <nav>
      <ul>
        <li><a href="#">acceuil</a></li>
        <li><a href="#">suivi de colis </a></li>
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
    <div class="container1">    
      <div class="div1">

     <?php echo"Relais Colis.tn"; 
     ?>   
        <h1 class="ml14">
          <span class="text-wrapper">
            <span class="letters">Profitez d'une livraison dans un point de relais pres de chez vous
            </span>
            <span class="line"></span>
          </span>
        </h1>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
      </div> 
      <div class="div2">
        <img src="images/429629069_784760153576710_8493998208963735973_n-removebg-preview.png" alt="images">
      </div>
      </div>
      <div class="container0">
        <h1 style="text-align: left; font-size: 4em; font-weight: 200;">Le spécialiste de la livraison de colis aux points de relais!</h1>  
        <span style="font-family: bold; font-size:20px; text-decoration:dashed;">Relais Colis.tn propose une offre complète de solutions de distribution de colis, en Tunisie, de toute dimension et de tout poids en des  Points de  Relais.</span>     
      </div>
      <h1 class="ml9">
      <span class="text-wrapper">
        <span class="letters">Nous serons dans le parcours 2024</span>
      </span>
    </h1>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
      <script src="acceuil.js"></script>
      <h1 style="text-align: center; color:#96154a;font-size:30px;">Pourqoui choisir Relais Colis.tn?</h1>
      <div class="container2">  
        <div class="div3"><img src="images/guy.png" alt="photo"></div>
        <div class="div4">
          <h1>Pratique</h1><span>Plus de ?? points de relais pour envoyer et tirez vos colis dans toute la Tunisie.Dès qu'il est disponible, le client est prévenu par SMS et/ou par mail.</span>
          <h1>Economique</h2><span>Fini le monopole de l'envoi de colis ! <br>
            Avec Relais Colis.tn, les consommateurs paient moins cher,et tout est possible : livraison dans des  Point Relais® dans toute la Tunisie.</span>
          <h1>Sur</h1><span>Relais Colis.tn  chouchoute les colis. Avec un tracing rigoureux, le client peut suivre son colis à la trace.
            Il suffit de se connecter sur le site web de Relais Colis.tn pour <a href="">suivre son colis.</a>En un clic, il sait où il se situe.</span>
        </div>
      </div>
      <h1 style="text-align: center; color:#96154a; font-size:30px; ">Rejoindre l’équipe Realis Colis.tn !</h1>
      <div class="container3">
        <div class="div5">
          <img src="images/2_trouver_relais@2x-300x180.png" alt="maison">
          <h1>devenez un point de relais</h1><span style="color: black;">Proposez l'envoi et le retrait de colis dans votre boutique en donnant le sourire autour de vous, rejoignez-nous !</span>
          <br><a href="rejoigner_nous.html">Rejoindre notre reseau</a>
        </div>
        <div class="div6">
              <img src="images/tronspoter.png" style="width: 50%;height:140px; margin-left: 35%;" alt="">
              <h1>devenez un tronsporteur</h1><span>Avec votre personnalité, tout roule en toutes circonstances ? Pour transporter le smile, rejoignez-nous !</span><br><a href="devenir_tronsport.html">Devenir transporteur</a>
        </div>
      </div>
      <!-- <div style="background-color:#ffb9cd;"> -->
      <!-- <div style="background-color:#d7b8bd;"> -->
      <div style="background-color:#FFCDD2; margin-bottom:50px;">
      <h1 style="text-align: center; color:#96144a; font-size:30px; ">Pourqoui devenir partenaire de Relais colis.tn</h1>
      <div class="container">
            <div class="info">
            <div class="circle"><span style="color:white;">1</span></div>
            <span> <b>Gagner</b><br>en visibilité</span><br><br>
            <span class="black">Vous appuyez votre présence sur le site des clients Relais Colis.tn.</span>
            </div>
            <div class="info">
                <div class="circle"><span style="color:white;">2</span></div>
                <span><b>Developper</b><br>votre chiffre d'affaire</span><br><br>
                <span class="black">Les clients achéte lors du retrait de leur Colis.</span>
            </div>
            
            <div class="info">
            <div class="circle"><span style="color:white;">3</span></div>
            <span> <b>Générer</b><br>un revenu supplémentaire</span><br> <br>
            <span class="black">vous êtes rémunéré pour chaque colis déposé dans votre boutique.    </span>
            </div>
            
    </div></div>
      <div class="help">
      <h1>Comment pouvons-nous vous aider?</h1>
        <p>
        <h2>Comment suivre l’acheminement de mon colis ?</h2>
            "Où est mon colis ?" : Vous pouvez suivre votre colis avec le numero de suivi sur notre page de <a href="#">suivi de colis.</a>
             .Vous trouverez votre numéro de suivi dans votre mail de confirmation de commande.
        </p>
        <p>
        <h2>Comment emballer mon colis ? </h2>
          Utilisez un emballage fermé, résistant et suffisamment grand pour protéger le contenu de votre colis. Idéalement, une boite en carton adaptée à la taille et au poids de l’article.
           Le carton doit être en bon état pour protéger l'article de la saleté et de l'humidité pendant le transport (il est préférable d’éviter les sacs en papier). Si l’article est assez lourd, nous recommandons d'utiliser deux ou trois couches de carton.
        </p>
        <p>
          <h2>Quel est le délai de garde d'un colis en point relais ?</h2>
          Si un colis n'a pas été retiré dans un délai de garde de 8 jours, il sera réexpédié au Point dd Relais où vous l'aviez déposé.
        Nous prenons en charge le coût de cette réexpédition. Attention : le calcul des 8 jours se fait sur les jours calendaires et non sur les jours d'ouvertures.
        </p>
          

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
