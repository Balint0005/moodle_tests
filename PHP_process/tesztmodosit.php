<?php 
    session_start();
    include "../dbcon/connectdb.php";

    $Tid = $_POST['testSelect'];
    $ujTesztNev = $_POST['testName'];

    $sql = "UPDATE teszt SET tnev=(?) WHERE Tid=(?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ujTesztNev,$Tid]);


    header("Location: ../tesztmodosit.php?feedback=success");
?>