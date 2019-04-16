<?php
require 'connection.php';

var_dump($_GET);

$sql = "DELETE FROM `gerechten` WHERE gerecht_ID = :gerecht_ID";
$stmt = $conn->prepare($sql);
$stmt->execute([':gerecht_ID' => $_GET['gerecht_ID']]);

header('Location: gerechten.php');
?>