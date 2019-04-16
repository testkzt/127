<?php
require 'connection.php';
$klant_ID = $naam = $bestelling_id = $gerecht_id = $drank_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
    $bestelling_id = filter_input(INPUT_POST, 'bestelling_id', FILTER_SANITIZE_NUMBER_FLOAT);

    $stmt = $conn->prepare('INSERT INTO klanten (naam, bestelling_id) VALUES (:naam, :bestelling_id)');
    $stmt->execute([
        ':naam' => $naam,
        ':bestelling_id' => $bestelling_id
    ]);
}

$sql = 'SELECT bestelling_ID
        FROM bestellingen';
$stmt = $conn->prepare($sql);
$stmt->execute();
$bestellingen = $stmt->fetchAll(PDO::FETCH_ASSOC);



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Klanten</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    
</head>
<body>
    <?php include 'menu.php';?>
    <form method="post">
<?php
if(!empty($errors)) {
    foreach ($errors as $error) {
        echo '- ' . $error . '<br>';
    }
}

?>
    <h2>Nieuwe klant</h2>
    <label>
        Naam:
        <input class="naam" name="naam">
    </label>
    <label>
        bestelling_id:
        <input class="bestelling_id" name="bestelling_id" >
    </label>
    <button>Invoeren</button>
</form>
</body>
</html>