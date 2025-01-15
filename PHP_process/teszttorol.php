<?php
    session_start();
    include "../dbcon/connectdb.php";

    $Tid = $_POST['testSelect2'];

    $sql = "DELETE FROM teszt WHERE Tid=(?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$Tid]);

    header("Location: ../tesztmodosit.php?feedback2=success");
?>