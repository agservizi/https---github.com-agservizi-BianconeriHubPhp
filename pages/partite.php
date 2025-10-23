<?php $matches = getUpcomingMatches(); ?>
<section class="mx-auto max-w-6xl space-y-8">
    <header class="app-card px-6 py-6 space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-gray-500">Calendario ufficiale</p>
                <h1 class="text-3xl font-semibold text-white">Match center Juventus</h1>
                <p class="mt-2 text-sm text-gray-400">Serie A, Champions League e Coppa Italia in un’unica timeline, ottimizzata per la tua fan app.</p>
            </div>
            <div class="glass-panel rounded-2xl px-5 py-4 text-sm text-gray-300">
                <p class="text-xs uppercase tracking-wide text-gray-500">Modalità match live</p>
                <p class="text-xl font-semibold text-white">Coming Soon</p>
                <p class="text-xs text-gray-500">Commento testuale, notifiche push e highlights.</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <button type="button" class="inline-flex items-center gap-2 rounded-full bg-white text-black px-4 py-2 text-xs uppercase tracking-wide transition-all">Tutte</button>
            <button type="button" class="inline-flex items-center gap-2 rounded-full bg-white/10 text-white px-4 py-2 text-xs uppercase tracking-wide transition-all hover:bg-white/20">Serie A</button>
            <button type="button" class="inline-flex items-center gap-2 rounded-full bg-white/10 text-white px-4 py-2 text-xs uppercase tracking-wide transition-all hover:bg-white/20">Champions</button>
            <button type="button" class="inline-flex items-center gap-2 rounded-full bg-white/10 text-white px-4 py-2 text-xs uppercase tracking-wide transition-all hover:bg-white/20">Friendly</button>
        </div>
    </header>

    <?php if (empty($matches)): ?>
        <div class="app-card px-6 py-6 text-center text-sm text-gray-400">Il calendario verrà aggiornato a breve. Resta connesso!</div>
    <?php else: ?>
        <div class="app-card px-6 py-6">
            <div class="relative pl-8">
                <span class="absolute top-0 bottom-0 left-3 w-px bg-white/10"></span>
                <div class="space-y-6">
                    <?php foreach ($matches as $index => $match): ?>
                        <article class="relative rounded-2xl border border-white/5 bg-white/5 px-4 py-5 transition-all duration-300 hover:bg-white/10">
                            <span class="absolute left-[-32px] top-6 flex h-8 w-8 items-center justify-center rounded-full <?php echo $index === 0 ? 'bg-white text-black font-semibold' : 'bg-white/10 text-white'; ?>">
                                <?php echo $index + 1; ?>
                            </span>
                            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500"><?php echo htmlspecialchars($match['competition'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    <h2 class="text-xl font-semibold text-white">Juventus vs <?php echo htmlspecialchars($match['opponent'], ENT_QUOTES, 'UTF-8'); ?></h2>
                                </div>
                                <span class="rounded-full bg-white/10 px-3 py-1 text-xs uppercase tracking-wide text-gray-300"><?php echo htmlspecialchars($match['status'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                            <div class="mt-4 grid gap-4 text-sm text-gray-300 sm:grid-cols-2">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Quando</p>
                                    <p><?php echo htmlspecialchars($match['date'], ENT_QUOTES, 'UTF-8'); ?> — <?php echo htmlspecialchars($match['time'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Dove</p>
                                    <p><?php echo htmlspecialchars($match['venue'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Diretta</p>
                                    <p><?php echo !empty($match['broadcast']) ? htmlspecialchars($match['broadcast'], ENT_QUOTES, 'UTF-8') : 'In aggiornamento'; ?></p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Memo tifoso</p>
                                    <p>Arriva allo stadio 90' prima per coreografia dedicata.</p>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm text-white/80">
                                <a href="#" class="inline-flex items-center gap-2 hover:text-white">Scheda pre-match</a>
                                <button class="inline-flex items-center gap-2 rounded-full bg-white text-black px-4 py-2 font-semibold transition-all hover:bg-juventus-silver">Aggiungi al calendario</button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <aside class="app-card px-6 py-6 space-y-4">
        <h2 class="text-xl font-semibold text-white">Sincronizza il tuo calendario</h2>
        <p class="text-sm text-gray-300">Scarica il file .ics con tutte le partite della Juventus e resta aggiornato con promemoria prima del calcio d’inizio.</p>
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <button class="inline-flex items-center justify-center gap-2 rounded-full bg-white text-black px-5 py-3 text-sm font-semibold transition-all hover:bg-juventus-silver">Download .ics</button>
            <button class="inline-flex items-center justify-center gap-2 rounded-full bg-white/10 text-white px-5 py-3 text-sm font-semibold transition-all hover:bg-white/20">Invia via email</button>
        </div>
    </aside>
</section>
