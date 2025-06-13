document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.fashion-sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.querySelector('.sidebar-overlay');
    const body = document.body;
    const mainWrapper = document.querySelector('.main-wrapper');

    // Initialize sidebar state based on screen size
    function initSidebar() {
        if (window.innerWidth > 992) {
            body.classList.add('sidebar-visible');
            body.classList.remove('sidebar-hidden');
            if (mainWrapper) {
                mainWrapper.style.marginLeft = '280px';
            }
        } else {
            body.classList.remove('sidebar-visible');
            body.classList.add('sidebar-hidden');
            if (mainWrapper) {
                mainWrapper.style.marginLeft = '0';
            }
        }
    }

    // Toggle sidebar function
    function toggleSidebar() {
        body.classList.toggle('sidebar-visible');
        body.classList.toggle('sidebar-hidden');
        
        // Update margin only on mobile
        if (window.innerWidth <= 992 && mainWrapper) {
            if (body.classList.contains('sidebar-visible')) {
                mainWrapper.style.marginLeft = '280px';
            } else {
                mainWrapper.style.marginLeft = '0';
            }
        }
    }

    // Initial setup
    initSidebar();

    // Toggle sidebar when button is clicked
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });
    }

    // Close sidebar when clicking on overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            if (window.innerWidth <= 992) {
                toggleSidebar();
            }
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 992 && 
            sidebar && 
            !sidebar.contains(e.target) && 
            e.target !== sidebarToggle && 
            (!sidebarToggle || !sidebarToggle.contains(e.target))) {
            body.classList.remove('sidebar-visible');
            body.classList.add('sidebar-hidden');
            if (mainWrapper) {
                mainWrapper.style.marginLeft = '0';
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            body.classList.add('sidebar-visible');
            body.classList.remove('sidebar-hidden');
            if (mainWrapper) {
                mainWrapper.style.marginLeft = '280px';
            }
        } else {
            if (!body.classList.contains('sidebar-visible')) {
                body.classList.add('sidebar-hidden');
                if (mainWrapper) {
                    mainWrapper.style.marginLeft = '0';
                }
            }
        }
    });
});