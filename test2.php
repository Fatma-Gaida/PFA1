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
 $res=verifier(3,7,4);
 if ($res==1){
    echo"accepté";
 }
 else echo"refusé";
 function get_ville($ch,$villes){
    for ($i=1;$i<10;$i++){
        if (strpos($ch, $villes[$i])){
            return $i;
        }
    }

 }


?>


</body>
</html>