<?php
if (!isset($siteName)) {
    require_once __DIR__ . '/../config.php';
}

if (!isset($pageTitle) || $pageTitle === '') {
    $pageTitle = $siteName;
}
$loggedUser = getLoggedInUser();
$flashMessages = pullFlashMessages();
$topNavItems = getNavigationItems();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BianconeriHub - Hub per tifosi della Juventus con notizie, risultati e community." />
    <title><?php echo htmlspecialchars($pageTitle . ' | ' . $siteName, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        juventus: {
                            black: '#000000',
                            white: '#ffffff',
                            silver: '#c0c0c0',
                        },
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="assets/css/tailwind.css">
</head>
<body class="bg-black text-white font-['Inter',sans-serif]" data-current-page="<?php echo htmlspecialchars($currentPage ?? 'home', ENT_QUOTES, 'UTF-8'); ?>">
<div class="relative min-h-screen flex flex-col overflow-hidden bg-gradient-to-b from-black via-gray-950 to-black text-white">
    <div class="pointer-events-none absolute inset-0">
        <div class="radial-highlight"></div>
        <div class="absolute -bottom-40 left-0 h-96 w-96 rounded-full bg-white/5 blur-3xl"></div>
        <div class="absolute -top-48 right-[-120px] h-96 w-96 rounded-full bg-juventus-silver/10 blur-3xl"></div>
    </div>
    <header class="relative z-10 px-4 pt-6 pb-6">
        <div class="mx-auto max-w-6xl space-y-6">
            <div class="glass-panel rounded-3xl px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="badge-accent">Live</span>
                    <p class="text-sm text-gray-300">Matchday Center</p>
                </div>
                <div class="text-right text-xs text-gray-400">
                    <p><?php echo date('d/m'); ?> • <?php echo date('H:i'); ?></p>
                    <p>Torino Timezone</p>
                </div>
            </div>

            <div class="relative overflow-hidden app-card px-6 py-8">
                <div class="radial-highlight"></div>
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                    <div class="space-y-4 max-w-xl">
                        <a href="?page=home" class="inline-flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-black text-xl font-bold">BH</span>
                            <div>
                                <p class="text-sm uppercase tracking-[0.3em] text-gray-500 flex items-center gap-3">
                                    <span>BianconeriHub</span>
                                    <span class="flex items-center gap-1 text-yellow-400 text-lg" aria-hidden="true">
                                        <span>★</span>
                                        <span>★</span>
                                        <span>★</span>
                                    </span>
                                </p>
                                <h1 class="text-3xl font-bold tracking-tight md:text-4xl">La tua fan app ufficiale</h1>
                            </div>
                        </a>
                        <p class="text-sm text-gray-300 leading-relaxed max-w-lg">
                            Segui notizie, calendario, community e mantieniti pronto al fischio d’inizio con una dashboard progettata come un’app mobile premium.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <a href="?page=news" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm text-white transition-all duration-300 hover:bg-white/20">
                                📰 Notizie
                            </a>
                            <a href="?page=partite" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm text-white transition-all duration-300 hover:bg-white/20">
                                ⚽ Calendario
                            </a>
                            <a href="?page=community" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm text-white transition-all duration-300 hover:bg-white/20">
                                👥 Community
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 text-sm text-gray-300">
                        <?php if ($loggedUser): ?>
                            <div class="glass-panel rounded-2xl px-4 py-3">
                                <p class="text-xs text-gray-400 uppercase tracking-wide">Profilo attivo</p>
                                <p class="text-lg font-semibold text-white"><?php echo htmlspecialchars($loggedUser['username'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="text-xs text-gray-500">Badge • <?php echo htmlspecialchars($loggedUser['badge'] ?? 'Tifoso', ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                            <a href="?action=logout" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white text-black px-5 py-3 text-sm font-semibold transition-all duration-300 hover:bg-juventus-silver">
                                Logout
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12" />
                                </svg>
                            </a>
                        <?php else: ?>
                            <div class="glass-panel rounded-2xl px-4 py-3">
                                <p class="text-xs text-gray-400 uppercase tracking-wide">Account ospite</p>
                                <p class="text-lg font-semibold text-white">Crea il tuo profilo</p>
                                <p class="text-xs text-gray-500">Accedi per salvare preferiti e badge personalizzati.</p>
                            </div>
                            <a href="?page=login" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white text-black px-5 py-3 text-sm font-semibold transition-all duration-300 hover:bg-juventus-silver">
                                Accedi / Registrati
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <nav class="hidden md:block">
                <ul class="glass-panel rounded-2xl px-4 py-3 flex items-center gap-4 text-sm">
                    <?php foreach ($topNavItems as $pageKey => $item):
                        $isActive = isset($currentPage) && $currentPage === $pageKey;
                        $baseClasses = 'inline-flex items-center gap-2 rounded-xl px-3 py-2 transition-all duration-300';
                        $stateClasses = $isActive ? 'bg-white text-black font-semibold shadow-lg' : 'text-gray-300 hover:text-white hover:bg-white/10';
                    ?>
                    <li>
                        <a href="?page=<?php echo $pageKey; ?>" class="<?php echo $baseClasses . ' ' . $stateClasses; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="<?php echo $item['icon']; ?>" />
                            </svg>
                            <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main id="main-content" class="relative z-10 flex-1 px-4 pb-32 space-y-6">
        <?php if (!empty($flashMessages)): ?>
            <div class="mx-auto max-w-5xl">
                <div class="space-y-3">
                    <?php foreach ($flashMessages as $flash):
                        $variant = $flash['variant'] ?? 'info';
                        $color = 'bg-gray-900/80 border-gray-800 text-gray-200';
                        if ($variant === 'success') {
                            $color = 'bg-emerald-500/10 border-emerald-500/40 text-emerald-200';
                        } elseif ($variant === 'error') {
                            $color = 'bg-red-500/10 border-red-500/40 text-red-200';
                        }
                    ?>
                    <div class="rounded-2xl border px-4 py-3 text-sm <?php echo $color; ?> transition-all duration-300">
                        <?php echo htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
