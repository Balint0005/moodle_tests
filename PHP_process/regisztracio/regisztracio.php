<?php

if(isset($_POST['submit-btn'])) {
    include "../../dbcon/connectdb.php";
    
    $teljesnev = $_POST['fullname'];
    $felhasznalonev = $_POST['username'];
    $jelszo = $_POST['passw'];
    $ellenorzojelszo = $_POST['passw2'];
    $email = $_POST['email'];
    $tanarvagydiak = $_POST['studentTeacher'];

    if ( empty($teljesnev) || empty($felhasznalonev) || empty($jelszo) || empty($ellenorzojelszo) || empty($email)) {
        header("Location: ../../regisztracio.php?error=emptyfields");
     } else if ( (!preg_match("/^[A-z|á|ú|ő|é|í|ö|ü|ó|ű|Á|Ú|Ő|É|Í|Ö|Ü|Ó|Ú\s]*$/", $teljesnev) )) {
        header("Location: ../../regisztracio.php?error=badfullname");
     } else if ($jelszo !== $ellenorzojelszo) {
        header("Location: ../../regisztracio.php?error=passnotmatch");
     } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../regisztracio.php?error=bademail");
     } else {
        $sql = "SELECT * FROM felhasznalok WHERE email = ?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$email]);
  
        if($stmt->rowCount() > 0){ 
              header("Location:  ../../regisztracio.php?error=userexist");
        } else {
           $jelszo = password_hash($jelszo, PASSWORD_DEFAULT);
  
           $sql = "INSERT INTO felhasznalok (fnev, nev, jelszo, email, jogosultsag)
            VALUES (?,?,?,?,?)";
     
           $stmt = $conn->prepare($sql);
           $stmt->execute([$felhasznalonev, $teljesnev, $jelszo, $email, $tanarvagydiak]);
           header("Location: ../../regisztracio.php?error=success");
        }
     }

} else {
    header("Location: ../../index.php");
}

?>