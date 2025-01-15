<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodle</title>
    <link rel="stylesheet" href="CSS/style.css">
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
                    <li><a href="tesztlista.php">Teszt kitöltések</a></li>
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

            $actTestID = $_POST['actTestID'];

            $sql = "SELECT * FROM teszttartalmazza WHERE tesztID=$actTestID";
            $sql2 = "SELECT * FROM teszt WHERE Tid=$actTestID";

            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);

            $row = $result2->fetch(PDO::FETCH_ASSOC);
            echo '<h1>'.$row['tnev'].'</h1>'; 
        ?>
        <div class="test-box-main-center">
            <form action="PHP_process/tesztkitolt.php" method="POST">
            <?php 
                $radioCounter = 1;
                $idoatvett = $_POST['ido'];
                
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $adottKerdesID = $row['kerdesID'];
                    $sql3 = "SELECT * FROM kerdes WHERE Kid=$adottKerdesID";
                    $result3 = $conn->query($sql3);
                    $adottKerdesAdatai = $result3->fetch(PDO::FETCH_ASSOC);

                    $random = rand(1,4);

                    if($random == 1){
                        echo '<div class="test-box-center">
                    <h2 id="question">'.$adottKerdesAdatai['kerdesszovege'].'</h2>
                    <hr>
                    <div id="answer-buttons">
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['jovalasz'].'">
                        <label>'.$adottKerdesAdatai['jovalasz'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz1'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz1'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz2'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz2'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz3'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz3'].'</label><br>
                    </div>    
                    </div>';
                    }
                    if($random == 2){
                        echo '<div class="test-box-center">
                    <h2 id="question">'.$adottKerdesAdatai['kerdesszovege'].'</h2>
                    <hr>
                    <div id="answer-buttons">
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz1'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz1'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['jovalasz'].'">
                        <label>'.$adottKerdesAdatai['jovalasz'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz2'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz2'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz3'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz3'].'</label><br>
                    </div>    
                    </div>';
                    }
                    if($random == 3){
                        echo '<div class="test-box-center">
                    <h2 id="question">'.$adottKerdesAdatai['kerdesszovege'].'</h2>
                    <hr>
                    <div id="answer-buttons">
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz2'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz2'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz1'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz1'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['jovalasz'].'">
                        <label>'.$adottKerdesAdatai['jovalasz'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz3'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz3'].'</label><br>
                    </div>    
                    </div>';
                    }
                    if($random == 4){
                        echo '<div class="test-box-center">
                    <h2 id="question">'.$adottKerdesAdatai['kerdesszovege'].'</h2>
                    <hr>
                    <div id="answer-buttons">
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz3'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz3'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz1'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz1'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['rosszvalasz2'].'">
                        <label>'.$adottKerdesAdatai['rosszvalasz2'].'</label><br>
                        <input type="radio" name="'.$radioCounter.'" value="'.$adottKerdesAdatai['jovalasz'].'">
                        <label>'.$adottKerdesAdatai['jovalasz'].'</label><br>
                    </div>    
                    </div>';
                    }
                    
                    $radioCounter++;
                    
                }
                $radioCounter--;
                echo '<input type="hidden" name="kerdesekSzam" value="'.$radioCounter.'">';
                echo '<input type="hidden" name="actTestID" value="'.$actTestID.'">';
                echo '<input type="hidden" name="startTime" value="'.$idoatvett.'">';
            ?>
            <button class="btn" type="submit">Beadás</button>
            </form>
        </div>
    </main>
</body>
</html>

