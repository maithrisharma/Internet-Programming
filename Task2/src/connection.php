<?php
$server = 'db';
$username = 'root';
$password = 'csym019';
//The name of the schema/database we created earlier in Adminer
//If this schema/database does not exist you will get an error!
$schema = 'Recipe DB';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password,
[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// $stmt = $pdo->prepare('SELECT * FROM Recipes');

// $stmt->execute();
// foreach ($stmt as $row) {
//  echo '<p>' . $row['name'] . '</p>';
// }
?>