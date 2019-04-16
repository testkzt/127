<?php
require 'connection.php';
$klant_ID = $naam = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);

    $sql = "UPDATE `klanten` SET `naam` = :naam WHERE klant_ID = :klant_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':klant_ID' => $_GET['klant_ID'],
            ':naam' => $_POST['naam']
        ]);
}

$stmt = $conn->prepare('SELECT K.naam, K.bestelling_id
                        FROM klanten K 
                        WHERE klant_ID = :klant_ID');
$stmt->execute([
    ':klant_ID' => $_GET['klant_ID']
]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Aanpassen klanten</title>
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
                <button type="submit">Aanpassen</button>
            </form>

        </div>
    </div>
</body>
</html>