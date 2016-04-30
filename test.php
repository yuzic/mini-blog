<?php
$dbh = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', 'virtc2012true');
$stmt = $dbh->prepare("SELECT * FROM users WHERE id <?limits");
$stmt->bindValue('?imits' , 10, false);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
//$stmt = $dbh->prepare('SELECT * FROM users limit :limits');
//$stmt->execute(
//    [':limits' , 10]
//);
//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($results);