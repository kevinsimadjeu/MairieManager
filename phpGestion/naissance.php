<pre>
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
    $ne = $_POST['nom_enfant'];
    $dn = $_POST['datenais'];
    $ln = $_POST['lieunais'];
    $np = $_POST['nompere'];
    $nm = $_POST['nommere'];
    $dm = $_POST['date_dem'];
    $st = $pdo->prepare('INSERT INTO demande_acte_naissance(nom_enfant,date_naissance,lieu_naissance,nom_pere,nom_mere,date_demande) VALUES(:nom_enfant,:datenais,:lieunais,:nom_pere,:nom_mere,:date_demande');
    $st->execute(array('nom_enfant' => $ne, 'datenais' => $dn, 'lieunais' => $ln, 'nom_pere' => $np, 'nom_mere' => $nm, 'date_demande' => $dm));
    echo "<center><h1><em>Merci pour votre compréhension. vos données seront traitées</h1>";
}


?></pre>