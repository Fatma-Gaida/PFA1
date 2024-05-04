<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    9=>"jendouba",
];
function genererPaires($villes) {
    $paires = [];
    for ($i = 1; $i < 11; $i++) {
        for ($j = $i + 1; $j <10; $j++) {
            $paire = [$i,$j];
            $paires[] = $paire;
        }
    }

    return $paires;
}
$paires = genererPaires($villes);

// foreach ($paires as $paire) {
//     echo $paire[0]." ".$paire[1]."<br>";
// }

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
 function historique($id){
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbName = "app";
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt1 = $pdo->prepare('SELECT ID_LIVRAISON ,DATE_LIVRAISON FROM livraison where ID_LIVRAISON IN ( SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id) ORDER BY DATE_LIVRAISON ASC  ');
    $stmt1->bindParam(':id', $id);
    $stmt1->execute();
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    echo '<table>';
    echo'<tr>';
    echo'<th>'.'livré aux point de relais'.'</th>';
    echo'<th>'.'date de livraison '.'</th>';
    echo'</tr>';
    foreach ($result1 as $row){
        $idl = $row['ID_LIVRAISON'];    
        $date=$row['DATE_LIVRAISON'];
        $stmt = $pdo->prepare('SELECT pr.NOM_PR, pr.ACTIVITE, pr.VILLE, pr.NOM_PRIORITAIRE, pr.CODE_POSTAL
                              FROM point_relais pr
                              JOIN livraison l ON pr.ID_PR = l.ID_PR_FIN
                              WHERE l.ID_LIVRAISON = :idl');
        $stmt->bindParam(':idl', $idl);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        echo'<td>'.$res['ACTIVITE'] .' '. $res["NOM_PRIORITAIRE"]. ' ' . $res["VILLE"].' ' . $res["CODE_POSTAL"].'</td> ';
        echo'<td>'.$date.'</td> ';
       
       echo'</table>';
       $res=[];
      
    }
}
historique(100);
 function position_actuelle($id){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    $stmt = $pdo->prepare('SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($result)){
        $stmt = $pdo->prepare('SELECT * FROM point_relais WHERE ID_PR in( select
            ID_PR_INITIAL from colis where ID_COLIS= :id);');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $pos = $result["ACTIVITE"]." ".$result["NOM_PR"]." ".$result["VILLE"]." ".$result["CODE_POSTAL"];
        return $pos;
    }
    else {
        $stmt = $pdo->prepare('SELECT * FROM point_relais
            WHERE ID_PR IN 
            (SELECT ID_PR_FIN FROM livraison WHERE ID_LIVRAISON IN (SELECT ID_LIVRAISON FROM livre WHERE ID_COLIS = :id) 
            ORDER BY DATE_LIVRAISON );
            ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pos = $result[count($result)-1]["ACTIVITE"]." ".$result[count($result)-1]["NOM_PR"]." ".$result[count($result)-1]["VILLE"]." ".$result[count($result)-1]["CODE_POSTAL"];
        return $pos;

    }
}


function posinit($id) {
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'app';
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    $stmt = $pdo->prepare('SELECT * FROM point_relais WHERE ID_PR in( select
    ID_PR_INITIAL from colis where ID_COLIS= :id);');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $pos = $result["ACTIVITE"]." ".$result["NOM_PR"]." ".$result["VILLE"]." ".$result["CODE_POSTAL"];
    return $pos;
    
}



?>


</body>
</html>