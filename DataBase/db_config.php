<?php
$db_dsn = "mysql:host=localhost;dbname=mairie_database";
$db_user = "root";
$db_password = "root_sql";
$options =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, /*On a aussi ERRMODE_WARNING , ERRMODE_SILENT(Pour une ne notifier aucune erreur)*/
        PDO::ATTR_PERSISTENT => true, /* Pour avoir une connexon persitante*/
        PDO::ATTR_EMULATE_PREPARES => false
    ];
try {
    $pdo = new PDO($db_dsn, $db_user, $db_password, $options);
} catch (PDOException $err) {
    echo "Erreur de connexion à la base de données: " . $err->getMessage();
}
