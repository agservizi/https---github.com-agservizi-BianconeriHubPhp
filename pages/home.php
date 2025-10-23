<?php
$newsItems = getNewsItems();
$latestNews = $newsItems[0] ?? null;
$matches = getUpcomingMatches();
$nextMatch = $matches[0] ?? null;
$communityPosts = array_slice(getCommunityPosts(), 0, 3);
$loggedUser = getLoggedInUser();
?>
<section class="mx-auto max-w-6xl space-y-8">
    <div class="grid gap-6 md:grid-cols-[1.15fr_0.85fr]">
        <article class="app-card overflow-hidden px-6 py-6">
            <div class="relative">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_65%)]"></div>
                <div class="relative flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-[0.4em] text-gray-500">Prossimo match</p>
                        <?php if ($nextMatch): ?>
                            <h2 class="text-3xl font-semibold">Juventus <span class="text-gray-500">vs</span> <?php echo htmlspecialchars($nextMatch['opponent'], ENT_QUOTES, 'UTF-8'); ?></h2>
                            <p class="text-sm text-gray-400">
                                <?php echo htmlspecialchars($nextMatch['venue'], ENT_QUOTES, 'UTF-8'); ?> • <?php echo htmlspecialchars($nextMatch['date'], ENT_QUOTES, 'UTF-8'); ?> • <?php echo htmlspecialchars($nextMatch['time'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        <?php else: ?>
                            <h2 class="text-3xl font-semibold">Calendario in aggiornamento</h2>
                            <p class="text-sm text-gray-400">Torneremo presto con le prossime sfide della stagione.</p>
                        <?php endif; ?>
                    </div>
                    <div class="glass-panel rounded-2xl px-5 py-4 text-sm text-gray-300">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Match focus</p>
                        <div class="mt-2 flex items-center gap-4">
                            <div>
                                <p class="text-2xl font-semibold text-white">80%</p>
                                <p class="text-[0.65rem] text-gray-500 uppercase tracking-wide">Fiducia tifosi</p>
                            </div>
                            <div>
                                <p class="text-2xl font-semibold text-white">3</p>
                                <p class="text-[0.65rem] text-gray-500 uppercase tracking-wide">Match consecutivi vinti</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <a href="?page=partite" class="glass-panel rounded-2xl px-4 py-4 transition-all duration-300 hover:bg-white/10">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Modalità stadio</p>
                        <p class="text-base font-semibold text-white">Line-up, statistiche e commento live</p>
                    </a>
                    <a href="?page=community" class="glass-panel rounded-2xl px-4 py-4 transition-all duration-300 hover:bg-white/10">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Match chat</p>
                        <p class="text-base font-semibold text-white">Unisciti alla curva Sud digitale</p>
                    </a>
                </div>
            </div>
        </article>

        <div class="space-y-4">
            <?php if ($latestNews): ?>
            <article class="app-card overflow-hidden px-6 py-6">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-gray-500">
                        <span class="h-2 w-2 rounded-full bg-juventus-silver"></span>
                        Breaking news
                    </div>
                    <h2 class="text-xl font-semibold text-white leading-relaxed"><?php echo htmlspecialchars($latestNews['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p class="text-sm text-gray-400 leading-relaxed"><?php echo htmlspecialchars($latestNews['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="?page=news" class="inline-flex items-center gap-2 text-sm font-medium text-white hover:text-juventus-silver transition-all">
                        Leggi gli approfondimenti
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </article>
            <?php endif; ?>

            <article class="app-card px-6 py-6">
                <p class="text-xs uppercase tracking-wide text-gray-500">Prossime uscite</p>
                <div class="mt-4 space-y-3">
                    <div class="flex items-center justify-between text-sm text-gray-300">
                        <span>Modalità Live Match</span>
                        <span class="text-xs text-gray-500">Novità</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-300">
                        <span>Badge fedeltà tifosi</span>
                        <span class="text-xs text-gray-500">In sviluppo</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-300">
                        <span>Upload galleria tifosi</span>
                        <span class="text-xs text-gray-500">In arrivo</span>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <div class="app-card px-6 py-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-gray-500">Notizie selezionate</p>
                <h2 class="text-2xl font-semibold text-white">Radar bianconero</h2>
            </div>
            <a href="?page=news" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-wide text-white transition-all hover:bg-white/20">Tutte le news</a>
        </div>
        <div class="mt-6 flex snap-x snap-mandatory gap-4 overflow-x-auto pb-2">
            <?php foreach ($newsItems as $item):
                $imagePath = __DIR__ . '/../' . ($item['image'] ?? '');
                $image = (!empty($item['image']) && file_exists($imagePath))
                    ? $item['image']
                    : 'https://via.placeholder.com/520x320/0f0f0f/ffffff?text=BianconeriHub';
            ?>
            <article class="snap-start min-w-[240px] max-w-[260px] overflow-hidden rounded-2xl border border-white/5 bg-white/5">
                <div class="relative h-32 overflow-hidden">
                    <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>" class="h-full w-full object-cover">
                    <span class="absolute top-3 right-3 rounded-full bg-black/70 px-3 py-1 text-xs uppercase tracking-wide text-white"><?php echo htmlspecialchars($item['tag'] ?? 'News', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div class="p-4 space-y-2">
                    <h3 class="text-sm font-semibold text-white leading-snug"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="text-xs text-gray-400 leading-relaxed line-clamp-3"><?php echo htmlspecialchars($item['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="?page=news" class="inline-flex items-center gap-1 text-xs font-semibold text-white/80 hover:text-white">
                        Apri scheda
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-[1.05fr_0.95fr]">
        <section class="app-card px-6 py-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-500">Community live</p>
                    <h2 class="text-xl font-semibold text-white">Curva digitale</h2>
                </div>
                <a href="?page=community" class="inline-flex items-center gap-2 rounded-full bg-white text-black px-4 py-2 text-xs uppercase tracking-wide font-semibold transition-all hover:bg-juventus-silver">Apri chat</a>
            </div>
            <div class="space-y-4">
                <?php foreach ($communityPosts as $post): ?>
                    <article class="rounded-2xl border border-white/5 bg-white/5 px-4 py-4">
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span class="font-semibold text-white"><?php echo htmlspecialchars($post['author'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span><?php echo htmlspecialchars(getHumanTimeDiff($post['created_at']), ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <p class="mt-2 text-sm text-gray-200 leading-relaxed"><?php echo htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="mt-3 flex items-center gap-4 text-xs text-gray-500 uppercase tracking-wide">
                            <button type="button" class="transition-all hover:text-white">Like</button>
                            <button type="button" class="transition-all hover:text-white">Commenta</button>
                            <button type="button" class="transition-all hover:text-white">Condividi</button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if ($loggedUser): ?>
                <a href="?page=community" class="inline-flex items-center justify-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm text-white transition-all hover:bg-white/20">Posta un aggiornamento</a>
            <?php else: ?>
                <a href="?page=login" class="inline-flex items-center justify-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm text-white transition-all hover:bg-white/20">Accedi per partecipare</a>
            <?php endif; ?>
        </section>

        <section class="app-card px-6 py-6 space-y-5">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">Agenda bianconera</h2>
                <a href="?page=partite" class="text-xs uppercase tracking-wide text-gray-500 hover:text-white">Tutto il calendario</a>
            </div>
            <div class="space-y-4">
                <?php foreach ($matches as $match): ?>
                    <article class="rounded-2xl border border-white/5 bg-white/5 px-4 py-4 flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-white">Juventus vs <?php echo htmlspecialchars($match['opponent'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <span class="rounded-full bg-white/10 px-3 py-1 text-xs uppercase tracking-wide text-gray-300"><?php echo htmlspecialchars($match['competition'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <p class="text-xs text-gray-400"><?php echo htmlspecialchars($match['date'], ENT_QUOTES, 'UTF-8'); ?> • <?php echo htmlspecialchars($match['time'], ENT_QUOTES, 'UTF-8'); ?> • <?php echo htmlspecialchars($match['venue'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span><?php echo htmlspecialchars($match['status'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span><?php echo $match['broadcast'] ? htmlspecialchars($match['broadcast'], ENT_QUOTES, 'UTF-8') : 'Diretta in definizione'; ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <?php if ($loggedUser): ?>
        <div class="app-card px-6 py-6 text-center">
            <p class="text-sm text-gray-300">Ciao <?php echo htmlspecialchars($loggedUser['username'], ENT_QUOTES, 'UTF-8'); ?>, la curva aspetta la tua voce.</p>
            <a class="mt-4 inline-flex items-center gap-2 rounded-full bg-white text-black px-5 py-3 text-sm font-semibold transition-all hover:bg-juventus-silver" href="?page=community">Lancia un sondaggio nella community</a>
        </div>
    <?php else: ?>
        <div class="app-card px-6 py-6 text-center">
            <p class="text-sm text-gray-300">Crea un account per personalizzare l’esperienza, salvare i tuoi match e ricevere alert live.</p>
            <a class="mt-4 inline-flex items-center gap-2 rounded-full bg-white text-black px-5 py-3 text-sm font-semibold transition-all hover:bg-juventus-silver" href="?page=register">Registrati ora</a>
        </div>
    <?php endif; ?>
</section>
