<?php
require 'connection.php';
$bestelling_ID = $gerecht_id = $drank_id = $gerecht_naam = $drank_naam = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gerecht_id = filter_input(INPUT_POST, 'gerecht', FILTER_SANITIZE_NUMBER_FLOAT);
    $drank_id = filter_input(INPUT_POST, 'drank', FILTER_SANITIZE_NUMBER_FLOAT);

    $stmt = $conn->prepare('INSERT INTO bestellingen (gerecht_id, drank_id) VALUES (:gerecht_id, :drank_id)');
    $stmt->execute([
        ':gerecht_id' => $gerecht_id,
        ':drank_id' => $drank_id
    ]);
}
$sql = 'SELECT G.gerecht_naam, G.gerecht_ID as gerecht
        FROM gerechten G';
$stmt = $conn->prepare($sql);
$stmt->execute();
$gerechten = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql = 'SELECT D.drank_naam, D.dranken_ID as drank
        FROM dranken D';
$stmt = $conn->prepare($sql);
$stmt->execute();
$dranken = $stmt->fetchAll(PDO::FETCH_ASSOC);


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Gerechten</title>
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
    <h2>Nieuwe bestelling</h2>
    <label>
        gerecht:
        <select name="gerecht">
<?php foreach ($gerechten as $gerecht) {
    echo '<option value="' . $gerecht['gerecht'] .'" >' . $gerecht['gerecht_naam'] .'</option>' . PHP_EOL;
} ?>
        </select>
    </label>
    <label>
        drank:
        <select name="drank" >
<?php foreach ($dranken as $drank) {
    echo '<option value="' . $drank['drank'] .'" >' . $drank['drank_naam'] .'</option>' . PHP_EOL;
} ?>
        </select>
    </label>
    <button>Invoeren</button>
</form>
</body>
</html>