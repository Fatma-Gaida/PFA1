<?php echo'
<div class="progression">
    <ul id="progressbar">
      <li class="active">Détails de l\'expéditeur</li>
      <li class="active">Détails du destinataire</li>
      <li class="active">Détails de colis</li>
      <li class="active">Option de paiment</li>
    </ul>
  </div>
 
  <form class="form" action="envoi.php" method="POST">
<h4 style="text-align: center ; margin-left: 0px; ">Montant total à payer</h4>
<div class="prix">'.$_SESSION['prix'].' DT</div>
<p>C\'est le prix effectif de colis cette prix peut diminuer en fonction de delai de livraison et de nombre d\'itération</p>
<h4 style="margin-left: 25%;">Sélectionnez votre méthode de paiement</h4>
<div class="radio-inputs">
  <label>
      <input class="radio-input" type="radio" name="payment-method" value="par-carte">
      <span class="radio-tile">
          <span class="radio-icon"></span>
          <span class="radio-label">Par carte</span>
      </span>
  </label>
  <label>
      <input checked class="radio-input" type="radio" name="payment-method" value="cash">
      <span class="radio-tile">
          <span class="radio-icon"></span>
          <span class="radio-label">Espèces</span>
      </span>
  </label>
</div>
<div class="div2">
<input class="button1" type="submit" name="page4" value="Retourner"/>
<input class="button2" type="submit" name="page4" value="Continuer"/></div>
  </form>'?>