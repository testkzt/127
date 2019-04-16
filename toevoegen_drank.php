<?php
require 'connection.php';
$dranken_ID = $drank_naam = $drank_prijs = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $drank_naam = filter_input(INPUT_POST, 'drank_naam', FILTER_SANITIZE_STRING);
    $drank_prijs = filter_input(INPUT_POST, 'drank_prijs', FILTER_SANITIZE_NUMBER_FLOAT);

    $stmt = $conn->prepare('INSERT INTO dranken (drank_naam, drank_prijs) VALUES (:drank_naam, :drank_prijs)');
    $stmt->execute([
        ':drank_naam' => $drank_naam,
        ':drank_prijs' => $drank_prijs
    ]);
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Gerechten</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    
</head>
<body>
    <?php include 'menu.php';?>
    <form method="post">
                <label>
                    Naam:
                    <input class="naam" name="drank_naam" >
                </label>
                <label>
                    Prijs:
                    <input class="prijs" name="drank_prijs">
                </label>
                <button type="submit">Toevoegen</button>
            </form>

</body>
</html>