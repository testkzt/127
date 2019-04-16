<?php
require 'connection.php';
try {
$sql = 'SELECT dranken_ID, drank_naam, drank_prijs
        FROM dranken
        ORDER BY dranken_ID';

$q = $conn->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
die("Could not connect to the database:" . $e->getMessage());
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Dranken</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <?php include 'menu.php';?>
        <div class="data">
            <!--Tonen van data -->
            <table  border='1' cellpadding='10'>
                <thead>
                <tr>
                    <th>naam</th>
                    <th>prijs</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $q->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['drank_naam']); ?></td>
                        <td><?php echo htmlspecialchars($row['drank_prijs']); ?></td>
                        <td><a href="aanpassen_drank.php?dranken_ID=<?php echo $row['dranken_ID'] ?>">aanpassen</a></td>
                        <td><a href="verwijderen_drank.php?dranken_ID=<?php echo $row['dranken_ID'] ?>">X</a></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

            <a href="toevoegen_drank.php">+ Een drank toevoegen</a>
        </div>
    </div>
</body>
</html>