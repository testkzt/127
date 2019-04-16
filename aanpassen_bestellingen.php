<?php
require 'connection.php';
$bestelling_ID = $gerecht_id = $drank_id = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gerecht_id = filter_input(INPUT_POST, 'gerecht_id', FILTER_SANITIZE_NUMBER_FLOAT);
    $drank_id = filter_input(INPUT_POST, 'drank_id', FILTER_SANITIZE_NUMBER_FLOAT);

    $sql = "UPDATE `bestellingen` SET `gerecht_id` = :gerecht_id, `drank_id` = :drank_id  WHERE bestelling_ID = :bestelling_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':bestelling_ID' => $_GET['bestelling_ID'],
            ':gerecht_id' => $_POST['gerecht_id'],
            ':drank_id' => $_POST['drank_id']
        ]);
}

$stmt = $conn->prepare('SELECT bestelling_ID, gerecht_id, drank_id FROM bestellingen WHERE bestelling_ID = :bestelling_ID');
$stmt->execute([
    ':bestelling_ID' => $_GET['bestelling_ID']
]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Aanpassen bestellingen</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
   <?php include 'menu.php';?>
        <div class="part_2">
            <!--Tonen van data -->
            <form method="post">
                <label>
                    gerecht_id:
                    <input class="gerecht" name="gerecht_id"  value="<?php echo $data['gerecht_id']?>">
                </label>
                <label>
                    drank_id:
                    <input class="drank" name="drank_id" value="<?php echo $data['drank_id']?>">
                </label>
                <button type="submit">Aanpassen</button>
            </form>

        </div>
    </div>
</body>
</html>