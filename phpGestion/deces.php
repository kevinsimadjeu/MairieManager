<?php
header('Content-Type:text/html; charset=UTF-8');

$DB_DSN = 'mysql:host=localhost;dbname=mairie_database';
$DB_USER = 'root';
$DB_PASS = '01Judicael';
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASS);
    echo 'connexion établie';
} catch (PDOException $pe) {
    echo 'ERREUR:' . $pe->getMessage();
}
if (isset($_POST) && !empty($_POST)) {
    $ne = $_POST['nom_def'];
    $dn = $_POST['nom_dec'];
    $ln = $_POST['lieu_de'];
    $np = $_POST['date_de'];
    $nm = $_POST['date_dem'];
    $st = $pdo->prepare('INSERT INTO demande_acte_mariage(nom_defunt,nom_declarant,lieu_deces,date_deces,date_demande) VALUES(:nom_defunt,:nom_declarant,:date_deces,:date_deces,:date_demande');
    $st->execute(array('nom_defunt' => $ne, 'nom_declarant' => $dn, 'date_deces' => $ln, 'date_demande' => $nm));
    echo "<center><h1><em>Merci pour votre compréhension. vos données seront traitées</h1>";
}


?></pre>