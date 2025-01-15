<?php

session_start();

if(isset($_POST['login-submit'])) {
    include "../dbcon/connectdb.php";

    $email = $_POST['email'];
    $jelszo = $_POST['passw'];

    if(empty($email)){
        header("Location ../belep.php?error=fnevmissing");
    }
    else if(empty($jelszo)){
        header("Location ../belep.php?error=passmissing");
    } else {

        $sql = "SELECT * FROM felhasznalok WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        
        if($stmt->rowCount() == 1){
            $felhasznalo = $stmt->fetch();

            $db_id = $felhasznalo['Fid'];
            $db_fnev = $felhasznalo['fnev'];
            $db_teljesnev = $felhasznalo['nev'];
            $db_jelszo = $felhasznalo['jelszo'];
            $db_email = $felhasznalo['email'];
            $db_jogosultsag = $felhasznalo['jogosultsag'];

            if($db_email == $email){
                if(password_verify($jelszo, $db_jelszo)){
                    $_SESSION['Fid'] = $db_id;
                    $_SESSION['fnev'] = $db_fnev;
                    $_SESSION['nev'] = $db_teljesnev;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['jogosultsag'] = $db_jogosultsag;
                    $_SESSION['logedin'] = TRUE;

                    header("Location: ../tesztekvalasztas.php");
                    exit;
                } else {
                    header("Location: ../belep.php?error=badpass");
                }
            } else {
                header("Location: ../belep.php?error=badfnev");
            }

        } else {
            header("Location: ../belep.php?error=invaliduser");
        }
    }
} else {
    header("Location: ../belep.php?error=invalidbtn");
    exit;
}

?>