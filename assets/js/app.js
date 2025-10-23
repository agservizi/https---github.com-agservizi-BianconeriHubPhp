document.addEventListener('DOMContentLoaded', () => {
    const navItems = document.querySelectorAll('[data-nav-target]');
    const currentPage = document.body.dataset.currentPage;

    const resetItemState = (item) => {
        const isPrimary = item.dataset.navPrimary === 'true';
        item.classList.remove('scale-105', 'scale-110', 'bg-white/10', 'text-white', 'shadow-lg');

        if (!isPrimary) {
            item.classList.add('text-gray-400');
        }
    };

    const activateItem = (item) => {
        const isPrimary = item.dataset.navPrimary === 'true';
        if (isPrimary) {
            item.classList.add('scale-110', 'shadow-lg');
        } else {
            item.classList.add('scale-105', 'bg-white/10', 'text-white');
            item.classList.remove('text-gray-400');
        }
    };

    navItems.forEach((item) => {
        const target = item.getAttribute('data-nav-target');
        if (target === currentPage) {
            activateItem(item);
        }

        item.addEventListener('click', () => {
            navItems.forEach((link) => resetItemState(link));
            activateItem(item);
        });
    });
});
