<?php
    session_start();
    include "../dbcon/connectdb.php";

    $Kid = $_POST['testID'];

    $sql = "DELETE FROM kerdes WHERE Kid=(?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$Kid]);

    header("Location: ../tesztmodosit.php?feedback4=success");
?>