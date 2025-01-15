<?php 
    session_start();

    if(isset($_POST['submit-btn'])) {
        include "../dbcon/connectdb.php";

        $kerdesSzovege = $_POST['question'];
        $jovalasz = $_POST['rightansw'];
        $rosszValasz1 = $_POST['wrongansw1'];
        $rosszValasz2 = $_POST['wrongansw2'];
        $rosszValasz3 = $_POST['wrongansw3'];
        $fid = $_SESSION['Fid'];

        if(empty($kerdesSzovege) || empty($jovalasz) || empty($rosszValasz1) || empty($rosszValasz2) || empty($rosszValasz3)){
            header("Location: ../tesztkeszit.php?feedback2=emptyfields");
        } else {
            $sql = "INSERT INTO kerdes (kerdesszovege, jovalasz, rosszvalasz1, rosszvalasz2, rosszvalasz3, felhasznaloID)
            VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $insert = $stmt->execute([$kerdesSzovege, $jovalasz, $rosszValasz1, $rosszValasz2, $rosszValasz3, $fid]);

           header("Location: ../tesztkeszit.php?feedback2=success");
        }

    } else {
        header("Location: ../tesztkeszit.php");
    }
?>