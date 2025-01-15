<?php 
    session_start();
    include "../dbcon/connectdb.php";

    $Kid = $_POST['questID'];
    $ujKerdesszovege = $_POST['questText'];
    $ujJoValasz = $_POST['questGoodAnsw'];
    $ujRosszValasz1 = $_POST['questBadAnsw1'];
    $ujRosszValasz2 = $_POST['questBadAnsw2'];
    $ujRosszValasz3 = $_POST['questBadAnsw3'];
    if(empty($ujKerdesszovege) && empty($ujJoValasz) && empty($ujRosszValasz1) && empty($ujRosszValasz2) && empty($ujRosszValasz3)){
        header("Location: ../tesztmodosit.php?feedback3=error");
    } else {
        if(!empty($ujKerdesszovege)){
            $sql = "UPDATE kerdes SET kerdesszovege=(?) WHERE Kid=(?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ujKerdesszovege,$Kid]);
        }
        if(!empty($ujJoValasz)){
            $sql = "UPDATE kerdes SET jovalasz=(?) WHERE Kid=(?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ujJoValasz,$Kid]);
        }
        if(!empty($ujRosszValasz1)){
            $sql = "UPDATE kerdes SET rosszvalasz1=(?) WHERE Kid=(?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ujRosszValasz1,$Kid]);
        }
        if(!empty($ujRosszValasz2)){
            $sql = "UPDATE kerdes SET rosszvalasz2=(?) WHERE Kid=(?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ujRosszValasz2,$Kid]);
        }
        if(!empty($ujRosszValasz3)){
            $sql = "UPDATE kerdes SET rosszvalasz3=(?) WHERE Kid=(?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ujRosszValasz3,$Kid]);
        }
    
        header("Location: ../tesztmodosit.php?feedback3=success");
    }
    
?>