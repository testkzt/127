<?php
require 'connection.php';
$gerecht_ID = $naam = $prijs = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_NUMBER_FLOAT);


    $stmt = $conn->prepare('INSERT INTO gerechten(naam, prijs) VALUES (:naam, :prijs)');
    $stmt->execute([
        ':naam' => $naam,
        ':prijs' => $prijs
    ]);
//    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Gerechten</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <div class="menu">
        <u>
            <li>
                <a href="gerechten.php">Gerechten</a>
            </li>
            <li>
                <a href="drank.php">Dranken</a>
            </li>
            <li>
                <a href="klanten.php">Klanten</a>
            </li>
            <li>
                <a href="bestellingen.php">Gerechten</a>
            </li>
        </u>
    </div>
        <div class="part_2">
            <!--Tonen van data -->
            <form method="post">
                <label>
                    Naam:
                    <input class="naam" name="naam" >
                </label>
                <label>
                    Prijs:
                    <input class="prijs" name="prijs">
                </label>
                <button type="submit">Toevoegen</button>
            </form>

        </div>
    </div>
</body>
</html>