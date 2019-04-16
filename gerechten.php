<?php
require 'connection.php';
try {
$sql = 'SELECT B.bestelling_ID, G.gerecht_naam, G.gerecht_prijs, D.drank_naam, D.drank_prijs
        FROM bestellingen B
        INNER JOIN gerechten G ON B.gerecht_id = G.gerecht_ID
        INNER JOIN dranken D ON B.drank_id = D.dranken_ID
        ORDER BY bestelling_ID';

$q = $conn->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
die("Could not connect to the database:" . $e->getMessage());
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Bestellingen</title>
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
        <div class="data">
            <!--Tonen van data -->
            <table  border='1' cellpadding='10'>
                <thead>
                <tr>
                    <th>Reserveringsnummer</th>
                    <th>Gerecht naam</th>
                    <th>Gerecht prijs</th>
                    <th>Drank naam</th>
                    <th>Drank prijs</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $q->fetch()): ?>
                    <tr>
                        <td><?php echo($row['bestelling_ID']); ?></td>
                        <td><?php echo htmlspecialchars($row['gerecht_naam']); ?></td>
                        <td><?php echo htmlspecialchars($row['gerecht_prijs']); ?></td>
                        <td><?php echo htmlspecialchars($row['drank_naam']); ?></td>
                        <td><?php echo htmlspecialchars($row['drank_prijs']); ?></td>
                        <td><a href="aanpassen.php?bestelling_ID=<?php echo $row['bestelling_ID'] ?>">aanpassen</a></td>
                        <td><a href="verwijderen.php?bestelling_ID=<?php echo $row['bestelling_ID'] ?>">X</a></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

            <a href="toevoegen_bestellingen.php">+ Een bestelling toevoegen</a>
        </div>
    </div>
</body>
</html>