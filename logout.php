<?php
// Check if the logout button was clicked
if (isset($_POST['logout'])) {
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page or any other desired page
    header('Location:acceuil.php');
    exit();
}
?>
              <form   action="?logout=true" method="get"><input type="submit" id="logout" name="logout" value="Deconnexion"></form> </li></ul>
