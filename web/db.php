<?php
  $pdo = new PDO('mysql:host=localhost; dbname=gyegempz_kazst', 'gyegempz_kazst', '123456q!');

    if ($pdo->connect_error) {
       //die("Connection failed: " . $pdo->connect_error);
         echo "ERROOR";
    
    }
  echo "Connected successfully";
?>

