<?php 
require 'db.php';
$token = $_GET['t'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM participants WHERE token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user) { die("Participant introuvable."); }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-sm text-center">
        <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
            <?= strtoupper(substr($user['nom_complet'], 0, 1)) ?>
        </div>
        <h1 class="text-2xl font-bold"><?= htmlspecialchars($user['nom_complet']) ?></h1>
        <p class="text-blue-600"><?= htmlspecialchars($user['poste']) ?> @ <?= htmlspecialchars($user['entreprise']) ?></p>
        <div class="mt-8 space-y-4">
            <a href="vcard.php?t=<?= $user['token'] ?>" class="block w-full py-3 bg-green-500 text-white rounded-xl font-bold">📥 Enregistrer le contact</a>
            <?php if($user['linkedin_url']): ?>
                <a href="<?= $user['linkedin_url'] ?>" class="block w-full py-3 bg-blue-800 text-white rounded-xl font-bold">LinkedIn</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>