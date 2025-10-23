<?php
$currentPage = $currentPage ?? 'home';
$navItems = getNavigationItems();
$isAuthenticated = isUserLoggedIn();

if ($isAuthenticated) {
    $navItems['login']['label'] = 'Profilo';
} else {
    $navItems['login']['label'] = 'Login';
}
?>
<nav class="md:hidden fixed bottom-6 left-0 right-0 z-50 px-5">
    <div class="mx-auto max-w-xl">
        <ul class="glass-panel rounded-full px-5 py-3 flex items-center justify-between">
            <?php foreach ($navItems as $pageKey => $item):
                $isActive = $currentPage === $pageKey;
                $isPrimary = $pageKey === 'community';
                $baseClasses = 'flex flex-col items-center gap-1 text-[0.7rem] font-medium transition-all duration-300 ease-in-out';
                $stateClasses = $isActive ? 'text-white' : 'text-gray-400 hover:text-white';
            ?>
            <li class="<?php echo $isPrimary ? 'relative -mt-6' : ''; ?>">
                <a href="?page=<?php echo $pageKey; ?>" class="<?php echo $baseClasses . ' ' . $stateClasses; ?> <?php echo $isPrimary ? 'rounded-full bg-white text-black px-4 py-3 shadow-xl hover:bg-juventus-silver' : ''; ?>" aria-label="Vai a <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>" data-nav-target="<?php echo $pageKey; ?>" data-nav-primary="<?php echo $isPrimary ? 'true' : 'false'; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="<?php echo $isPrimary ? 'w-6 h-6' : 'w-5 h-5'; ?>">
                        <path d="<?php echo $item['icon']; ?>" />
                    </svg>
                    <span class="<?php echo $isPrimary ? 'text-xs font-semibold' : ''; ?>"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
