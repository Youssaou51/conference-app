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
        
        <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-md">
            <?= strtoupper(substr($user['nom_complet'], 0, 1)) ?>
        </div>

        <h1 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($user['nom_complet']) ?></h1>
        <p class="text-blue-600 font-medium mt-1">
            <?= htmlspecialchars($user['poste'] ?? '') ?> 
            <span class="text-gray-400">@</span> 
            <?= htmlspecialchars($user['entreprise'] ?? '') ?>
        </p>
        
        <div class="mt-10 space-y-4">
            <a href="vcard.php?t=<?= urlencode($user['token']) ?>" 
               class="block w-full py-4 bg-green-500 hover:bg-green-600 text-white rounded-2xl font-bold shadow-lg transition-all active:scale-95">
               📥 Enregistrer le contact
            </a>
            
            <?php if (isset($user['linkedin_url']) && !empty($user['linkedin_url'])): ?>
                <a href="<?= htmlspecialchars($user['linkedin_url']) ?>" 
                   target="_blank" 
                   class="block w-full py-4 bg-blue-800 hover:bg-blue-900 text-white rounded-2xl font-bold shadow-lg transition-all active:scale-95">
                   LinkedIn
                </a>
            <?php endif; ?>
        </div>

        <p class="mt-8 text-xs text-gray-400 uppercase tracking-widest">Digital Business Card</p>
    </div>
</body>
</html>