<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodle</title>
    <link rel="stylesheet" href="CSS/style.css">

    <style>
        .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        }

        .active, .collapsible:hover {
        background-color: #555;
        }

        .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: rgba(7, 92, 65, 1);
        }
    </style>


</head>
<body>

<?php
session_start();

if(isset($_SESSION['logedin']) == FALSE) {
    header('Location: index.php');
    exit;
}
?>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Kezdőlap</a></li>
                <?php if(!isset($_SESSION['logedin'])) { ?>
                    <li><a href="regisztracio.php">Regisztráció</a></li>
                    <li><a href="belep.php">Bejelentkezés</a></li>
                <?php } ?>
                    <li><a href="tesztekvalasztas.php">Tesztek</a></li>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a href="tesztkeszit.php">Teszt Készítés</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a href="tesztmodosit.php">Tesztek Módosítása</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['logedin']) && $_SESSION['jogosultsag'] == 2) { ?>
                    <li><a id="active" href="tesztlista.php">Teszt kitöltések</a></li>
                <?php } ?>
                <li><a href="statisztika.php">Statisztika</a></li>
                <?php if(isset($_SESSION['logedin'])){ ?>
                <form action="PHP_process/kijelentkezes.php" method="post">
                    <li> <a href="PHP_process/kijelentkezes.php">Kijelentkezés</a> </li>
                </form>
                <?php } ?>
            </ul>
                <?php
                
                if(isset($_SESSION['logedin'])){

              ?>
              <span class="right">
                <?php    echo $_SESSION['nev']; ?>
              </span>
              <?php
                }
               ?>
        </nav>
    </header>
    <main>
        <?php
            include "dbcon/connectdb.php";
            $sql = "SELECT * FROM  teszt";
            $result = $conn->query($sql);

            $userID = $_SESSION['Fid'];
            ?>

        <div class="test-box-main-center">
            <div class="test-box-center">
                <h1>TESZTEK</h1>
                <?php
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<hr>';
                    
                    echo '<button type="button" class="collapsible">'.$row['tnev'].'</button>';
                    ?>
                        <div class="content">
                            <?php
                                $tesztID = $row['Tid'];
                                $sql2 = "SELECT * FROM kitoltotte WHERE tesztID=$tesztID";
                                $result2 = $conn->query($sql2); 
                                while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                                    $aktualisFelhasznaloID = $row2['felhasznaloID'];
                                    $sql3 = "SELECT * FROM felhasznalok WHERE Fid=$aktualisFelhasznaloID";
                                    $result3 = $conn->query($sql3);
                                    $row3 = $result3->fetch(PDO::FETCH_ASSOC);
                                    if($row2['sikeres'] == 1){
                                        echo '<p>Felhasználó: '.$row3['fnev'].' | Kitöltés: Sikeres | Elértpontszám: '.$row2['elertPontSzam'].'.</p><br>';
                                    } else {
                                        echo '<p>Felhasználó: '.$row3['fnev'].' | Kitöltés: Sikertelen | Elértpontszám: '.$row2['elertPontSzam'].'.</p><br>';
                                    }
                                }
                            ?>
                        </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>

<script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
            });
        }         
</script>



</body>
</html>

