<?php
// $server = 'db';
// $username = 'root';
// $password = 'csym019';
// //The name of the schema/database we created earlier in Adminer
// //If this schema/database does not exist you will get an error!
// $schema = 'Login';
// $pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password,
// [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// $stmt = $pdo->prepare('SELECT * FROM Recipes');

// $stmt->execute();
// foreach ($stmt as $row) {
//  echo '<p>' . $row['name'] . '</p>';
// }

$db_host="db"; //localhost server 
$db_user="root"; //database username
$db_password="csym019"; //database password   
$db_name="Login"; //database name

try
{
 $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
 $e->getMessage();
}

?>
