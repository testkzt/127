<?php
require 'connection.php';
$gerecht_ID = $naam = $prijs = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_NUMBER_FLOAT);


    $sql = "UPDATE `gerechten` SET `naam` = :naam, `prijs` = :prijs  WHERE gerecht_ID = :gerecht_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':gerecht_ID' => $_GET['gerecht_ID'],
            ':naam' => $_POST['naam'],
            ':prijs' => $_POST['prijs']
        ]);
}

$stmt = $conn->prepare('SELECT gerecht_ID, naam, prijs FROM gerechten WHERE gerecht_ID = :gerecht_ID');
$stmt->execute([
    ':gerecht_ID' => $_GET['gerecht_ID']
]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Aanpassen</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <?php include 'menu.php';?>
        <div class="part_2">
            <!--Tonen van data -->
            <form method="post">
                <label>
                    Naam:
                    <input class="naam" name="naam"  value="<?php echo $data['naam']?>">
                </label>
                <label>
                    Prijs:
                    <input class="prijs" name="prijs" value="<?php echo $data['prijs']?>">
                </label>
                <button type="submit">Aanpassen</button>
            </form>

        </div>
    </div>
</body>
</html>