<?php 
    session_start();
    include "../dbcon/connectdb.php";

    $kerdesekDB = $_POST['kerdesekSzam'];
    $actTestID = $_POST['actTestID'];
    $fid = $_SESSION['Fid'];
    $kezdesIdeje = $_POST['startTime'];
    $valaszok = array();

    $db = 1;
    for($i = 0; $i < $kerdesekDB; $i++){
        $valaszok[$i] = $_POST[$db];
        $db++;
        echo $valaszok[$i];
    }

    $sql = "SELECT * FROM teszt WHERE Tid=$actTestID";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    $actTestPointPerAnswer = $row['kerdesenkent_pont'];
    $actTestMinPoint = $row['minpont'];
    $osszesPont = $actTestPointPerAnswer*$kerdesekDB;

    $elertPont = 0;

    //Pontszámítás

    $sql2 = "SELECT * FROM teszttartalmazza WHERE tesztID=$actTestID";
    $result2 = $conn->query($sql2);
    $k = 0;
    while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
        $adottKerdesID = $row2['kerdesID'];
        $sql3 = "SELECT * FROM kerdes WHERE Kid=$adottKerdesID";
        $result3 = $conn->query($sql3);
        $adottKerdesAdatai = $result3->fetch(PDO::FETCH_ASSOC);

        if($valaszok[$k] == $adottKerdesAdatai['jovalasz']){
            $elertPont += $actTestPointPerAnswer;
        }
        
        $k++;
    }
   
    $sikeres = FALSE;
    if($elertPont >= $actTestMinPoint){
        $sikeres = TRUE;
    }

    //kitolt táblába felvinni a kapcsolatokat
    $sql4 = "INSERT INTO kitoltotte (felhasznaloID, tesztID, elertPontSzam, sikeres,kitoltesKezdete)
    VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql4);
    $stmt->execute([$fid, $actTestID, $elertPont, $sikeres,$kezdesIdeje]);

    header("Location: ../tesztekvalasztas.php");

?>