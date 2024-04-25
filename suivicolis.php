
  <!DOCTYPE html>
<html>
<head>
    <title>Affichage des données</title>
</head>
<body>
    <table>
        <tr>
            <th>Colonne 1</th>
            <th>Colonne 2</th>
            <th>Colonne 3</th>
            <!-- Ajoutez les autres colonnes que vous souhaitez afficher -->
        </tr>
        <tr>
            <td><?php echo $result['colonne1']; ?></td>
            <td><?php echo $result['colonne2']; ?></td>
            <td><?php echo $result['colonne3']; ?></td>
            <!-- Ajoutez les valeurs des autres colonnes -->
        </tr>
    </table>
</body>
</html>

<?php
 }else {
    header('Location:suivi.php');
    exit();
}
?>