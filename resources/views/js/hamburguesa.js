function toggleMenu() {
    const navCenter = document.querySelector('.nav-center');
    const navActions = document.querySelector('.nav-actions');
    const menuButton = document.querySelector('.menu-toggle');
    
    navCenter.classList.toggle('active');
    navActions.classList.toggle('active');
    const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
    menuButton.setAttribute('aria-expanded', !isExpanded);
}