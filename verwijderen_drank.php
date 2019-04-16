<?php
require 'connection.php';

var_dump($_GET);

$sql = "DELETE FROM `dranken` WHERE dranken_ID = :dranken_ID";
$stmt = $conn->prepare($sql);
$stmt->execute([':dranken_ID' => $_GET['dranken_ID']]);

header('Location: drank.php');
?>