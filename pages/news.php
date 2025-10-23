<?php
$newsItems = getNewsItems();
$featured = $newsItems[0] ?? null;
$secondaryNews = array_slice($newsItems, 1);
$categories = ['Ultime', 'Tattica', 'Next Gen', 'Mercato', 'Europa'];
?>
<section class="mx-auto max-w-6xl space-y-8">
    <header class="app-card overflow-hidden px-6 py-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-gray-500">BianconeriHub Newsroom</p>
                <h1 class="text-3xl font-semibold text-white">Ultime notizie dalla Continassa</h1>
                <p class="mt-2 text-sm text-gray-400 max-w-xl">Approfondimenti premium, interviste esclusive e breaking news su Juventus, Next Gen e settore giovanile.</p>
            </div>
            <div class="glass-panel rounded-2xl px-5 py-4 text-sm text-gray-300">
                <p class="text-xs uppercase tracking-wide text-gray-500">Aggiornamenti live</p>
                <p class="text-xl font-semibold text-white">24/7</p>
                <p class="text-xs text-gray-500">Attiva le notifiche per le breaking news.</p>
            </div>
        </div>
        <div class="mt-6 flex flex-wrap gap-2">
            <?php foreach ($categories as $index => $category): ?>
                <button type="button" class="<?php echo $index === 0 ? 'bg-white text-black' : 'bg-white/10 text-white hover:bg-white/20'; ?> inline-flex items-center gap-2 rounded-full px-4 py-2 text-xs uppercase tracking-wide transition-all">
                    <?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </header>

    <?php if ($featured):
        $featurePath = __DIR__ . '/../' . ($featured['image'] ?? '');
        $featureImage = (!empty($featured['image']) && file_exists($featurePath))
            ? $featured['image']
            : 'https://via.placeholder.com/960x480/0f0f0f/ffffff?text=BianconeriHub';
    ?>
    <article class="app-card overflow-hidden px-6 py-6">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="relative h-56 overflow-hidden rounded-2xl border border-white/5">
                <img src="<?php echo htmlspecialchars($featureImage, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($featured['title'], ENT_QUOTES, 'UTF-8'); ?>" class="h-full w-full object-cover">
                <span class="absolute top-4 left-4 rounded-full bg-black/70 px-3 py-1 text-xs uppercase tracking-wide text-white"><?php echo htmlspecialchars($featured['tag'] ?? 'Focus', ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <div class="space-y-4">
                <p class="text-xs uppercase tracking-wide text-gray-500">In evidenza</p>
                <h2 class="text-2xl font-semibold text-white leading-snug"><?php echo htmlspecialchars($featured['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="text-sm text-gray-300 leading-relaxed"><?php echo htmlspecialchars($featured['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="flex flex-wrap gap-2 text-xs text-gray-500">
                    <span class="rounded-full bg-white/10 px-3 py-1 uppercase tracking-wide">Analisi</span>
                    <span class="rounded-full bg-white/10 px-3 py-1 uppercase tracking-wide">Match Prep</span>
                </div>
                <a href="#" class="inline-flex items-center gap-2 rounded-full bg-white text-black px-4 py-2 text-sm font-semibold transition-all hover:bg-juventus-silver">Apri articolo completo</a>
            </div>
        </div>
    </article>
    <?php endif; ?>

    <div class="grid-auto-fit">
        <?php foreach ($secondaryNews as $item):
            $imagePath = __DIR__ . '/../' . ($item['image'] ?? '');
            $image = (!empty($item['image']) && file_exists($imagePath))
                ? $item['image']
                : 'https://via.placeholder.com/640x360/0f0f0f/ffffff?text=BianconeriHub';
        ?>
        <article class="app-card overflow-hidden">
            <div class="relative h-40 overflow-hidden">
                <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>" class="h-full w-full object-cover">
                <span class="absolute top-3 right-3 rounded-full bg-black/70 px-2.5 py-1 text-[0.65rem] uppercase tracking-wide text-white"><?php echo htmlspecialchars($item['tag'] ?? 'News', ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <div class="p-5 space-y-3">
                <h3 class="text-lg font-semibold text-white leading-snug"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p class="text-sm text-gray-400 leading-relaxed line-clamp-3"><?php echo htmlspecialchars($item['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>5 min read</span>
                    <a href="#" class="inline-flex items-center gap-2 text-sm font-medium text-white hover:text-juventus-silver transition-all">
                        Leggi ora
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <aside class="app-card px-6 py-6 space-y-4">
        <h2 class="text-xl font-semibold text-white">Newsletter Bianconera</h2>
        <p class="text-sm text-gray-300">Iscriviti per ricevere recap settimanali, analisi tattiche e approfondimenti su Next Gen e Women.</p>
        <form action="#" method="post" class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <input type="email" name="newsletter_email" class="w-full rounded-full bg-black/70 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Inserisci la tua email">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-white text-black px-5 py-3 text-sm font-semibold transition-all hover:bg-juventus-silver">Iscriviti</button>
        </form>
    </aside>
</section>
