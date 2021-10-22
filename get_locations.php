<?php

require 'config.php';

try {

$db = new PDO($dsn, $username, $password);
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$sth = $db->query("SELECT * FROM research WHERE status = '1'");
$research = $sth->fetchAll();

echo json_encode( $research );

} catch (Exception $e) {
echo $e->getMessage();
}

?>