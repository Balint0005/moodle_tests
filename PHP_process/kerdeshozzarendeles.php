<?php
    session_start();

    if(isset($_POST['submit-btn'])) {
        include "../dbcon/connectdb.php";

        $tesztID = $_POST['testID'];
        $kerdesID = $_POST['kerdesID'];

        $sql = "INSERT INTO teszttartalmazza (tesztID, kerdesID) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$tesztID, $kerdesID]);

        header("Location: ../tesztkeszit.php?feedback3=success");

    } else {
        header("Location: ../tesztkeszit.php?feedback3=error");
    }

?>