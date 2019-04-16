<?php
require 'connection.php';
try {
$sql = 'SELECT K.klant_ID, K.naam, B.gerecht_id, B.drank_id
        FROM klanten K
        INNER JOIN bestellingen B ON K.bestelling_id = B.bestelling_ID
        ORDER BY klant_ID';

$q = $conn->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
die("Could not connect to the database:" . $e->getMessage());
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Klanten</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <?php include 'menu.php';?>
        <div class="data">
            <!--Tonen van data -->
            <table  border='1' cellpadding='10'>
                <thead>
                <tr>
                    <th>klant_ID</th>
                    <th>Naam</th>
                    <th>gerecht_id</th>
                    <th>drank_id</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $q->fetch()): ?>
                    <tr>
                        <td><?php echo($row['klant_ID']); ?></td>
                        <td><?php echo htmlspecialchars($row['naam']); ?></td>
                        <td><?php echo htmlspecialchars($row['gerecht_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['drank_id']); ?></td>
                        <td><a href="aanpassen_klanten.php?klant_ID=<?php echo $row['klant_ID'] ?>">aanpassen</a></td>
                        <td><a href="verwijderen_klanten.php?klant_ID=<?php echo $row['klant_ID'] ?>">X</a></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

            <a href="toevoegen_klanten.php">+ Een klant toevoegen</a>
        </div>
    </div>
</body>
</html>