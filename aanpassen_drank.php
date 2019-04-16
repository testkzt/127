<?php
require 'connection.php';
$dranken_ID = $drank_naam = $drank_prijs = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = filter_input(INPUT_POST, 'drank_naam', FILTER_SANITIZE_STRING);
    $prijs = filter_input(INPUT_POST, 'drank_prijs', FILTER_SANITIZE_NUMBER_FLOAT);


    $sql = "UPDATE `dranken` SET `drank_naam` = :drank_naam, `drank_prijs` = :drank_prijs  WHERE dranken_ID = :dranken_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':dranken_ID' => $_GET['dranken_ID'],
            ':drank_naam' => $_POST['drank_naam'],
            ':drank_prijs' => $_POST['drank_prijs']
        ]);
}

$stmt = $conn->prepare('SELECT dranken_ID, drank_naam, drank_prijs FROM dranken WHERE dranken_ID = :dranken_ID');
$stmt->execute([
    ':dranken_ID' => $_GET['dranken_ID']
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
                    <input class="drank_naam" name="drank_naam"  value="<?php echo $data['drank_naam']?>">
                </label>
                <label>
                    Prijs:
                    <input class="drank_prijs" name="drank_prijs" value="<?php echo $data['drank_prijs']?>">
                </label>
                <button type="submit">Aanpassen</button>
            </form>

        </div>
    </div>
</body>
</html>