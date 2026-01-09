<?php
require 'db.php';
$token = $_GET['t'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM participants WHERE token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch();

if ($user) {
    header('Content-Type: text/vcard');
    header('Content-Disposition: attachment; filename="contact.vcf"');
    echo "BEGIN:VCARD\nVERSION:3.0\n";
    echo "FN:" . $user['nom_complet'] . "\n";
    echo "ORG:" . $user['entreprise'] . "\n";
    echo "TITLE:" . $user['poste'] . "\n";
    echo "EMAIL:" . $user['email'] . "\n";
    echo "END:VCARD";
}