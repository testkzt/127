<?php
require 'connection.php';

var_dump($_GET);

$sql = "DELETE FROM `bestellingen` WHERE bestelling_ID = :bestelling_ID";
$stmt = $conn->prepare($sql);
$stmt->execute([':bestelling_ID' => $_GET['bestelling_ID']]);

header('Location: bestellingen.php');
?>