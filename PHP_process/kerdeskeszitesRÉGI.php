<?php 
    session_start();

    if(isset($_POST['submit-btn'])) {
        include "../dbcon/connectdb.php";

        $tesztID = $_POST['testID'];
        $kerdesSzovege = $_POST['question'];
        $jovalasz = $_POST['rightansw'];
        $rosszValasz1 = $_POST['wrongansw1'];
        $rosszValasz2 = $_POST['wrongansw2'];
        $rosszValasz3 = $_POST['wrongansw3'];
        $fid = $_SESSION['Fid'];

        if(empty($kerdesSzovege) || empty($jovalasz) || empty($rosszValasz1) || empty($rosszValasz2) || empty($rosszValasz3)){
            header("Location: ../tesztkeszit.php?error=emptyfields");
        } else {
            $sql = "INSERT INTO kerdes (kerdesszovege, jovalasz, rosszvalasz1, rosszvalasz2, rosszvalasz3, felhasznaloID)
            VALUES (?,?,?,?,?,?)";
     
           $stmt = $conn->prepare($sql);
           $insert = $stmt->execute([$kerdesSzovege, $jovalasz, $rosszValasz1, $rosszValasz2, $rosszValasz3, $fid]);
           if ($insert) {
                $sql2 = "SELECT * FROM kerdes ORDER BY Kid DESC LIMIT 1";

                $result = $conn->query($sql2);
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $lastRecord = $row["Kid"];

                    $sql3 = "INSERT INTO teszttartalmazza (tesztID, kerdesID) VALUES (?,?)";
                    $stmt3 = $conn->prepare($sql3);
                    $stmt3->execute([$tesztID, $lastRecord]);
                }
            }

           header("Location: ../tesztkeszit.php");
        }

    } else {
        header("Location: ../tesztkeszit.php");
    }
?>