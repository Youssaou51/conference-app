<?php
require 'db.php';

$token = $_GET['t'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM participants WHERE token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch();

if ($user) {
    // On dit au navigateur que c'est un fichier de contact
    header('Content-Type: text/vcard; charset=utf-8');
    header('Content-Disposition: attachment; filename="contact_' . $token . '.vcf"');

    // Contenu de la vCard
    echo "BEGIN:VCARD\n";
    echo "VERSION:3.0\n";
    echo "FN:" . $user['nom_complet'] . "\n";
    echo "ORG:" . $user['entreprise'] . "\n";
    echo "TITLE:" . $user['poste'] . "\n";
    echo "EMAIL;TYPE=INTERNET:" . $user['email'] . "\n";
    if (!empty($user['linkedin_url'])) {
        echo "URL:" . $user['linkedin_url'] . "\n";
    }
    echo "END:VCARD";
    exit;
} else {
    die("Erreur : Impossible de générer le contact.");
}