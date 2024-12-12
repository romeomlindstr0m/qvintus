// JavaScript for toggling the navbar and dropdown functionality

document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle
    const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');
  
    if (mobileMenuButton && mobileMenu) {
      mobileMenuButton.addEventListener('click', () => {
        const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
        mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
        mobileMenu.classList.toggle('hidden');
      });
    }
  
    // Profile dropdown toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');
  
    if (userMenuButton && userMenu) {
      userMenuButton.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent click from propagating to document
        const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
        userMenuButton.setAttribute('aria-expanded', !isExpanded);
        userMenu.classList.toggle('hidden');
      });
  
      // Close dropdown when clicking outside
      document.addEventListener('click', (event) => {
        if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
          userMenu.classList.add('hidden');
          userMenuButton.setAttribute('aria-expanded', 'false');
        }
      });
    }
  });
  