<?php
require 'connection.php';

var_dump($_GET);

$sql = "DELETE FROM `klanten` WHERE klant_ID = :klant_ID";
$stmt = $conn->prepare($sql);
$stmt->execute([':klant_ID' => $_GET['klant_ID']]);

header('Location: klanten.php');
?>