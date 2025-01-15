<?php 
    session_start();

    if(isset($_POST['submit-btn'])){
        include "../dbcon/connectdb.php";

        $tesztneve = $_POST['testname'];
        $pontPerKerdes = $_POST['point'];
        $minimumpont = $_POST['minimum'];
        $fid = $_SESSION['Fid'];

        if ( empty($tesztneve) || empty($pontPerKerdes) || empty($minimumpont)) {
            header("Location: ../tesztkeszit.php?feedback=emptyfields");
         } else if ( (!preg_match("/^[0-9]*$/", $pontPerKerdes) )) {
            header("Location: ../tesztkeszit.php?feedback=badpoint");
         } else if ( (!preg_match("/^[0-9]*$/", $minimumpont) )) {
            header("Location: ../tesztkeszit.php?feedback=badminpoint");
         } else {
            $sql = "INSERT INTO teszt (tnev, kerdesenkent_pont, minpont, felhasznaloID)
            VALUES (?,?,?,?)";
     
           $stmt = $conn->prepare($sql);
           $stmt->execute([$tesztneve, $pontPerKerdes, $minimumpont, $fid]);
           header("Location: ../tesztkeszit.php?feedback=success");
         }

    } else {
        header("Location: ../tesztkeszit.php");
    }
?>