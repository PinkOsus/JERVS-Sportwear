document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.fashion-sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.querySelector('.sidebar-overlay');
    const body = document.body;

    // Check if sidebar should be initially visible based on screen size
    if (window.innerWidth > 768) {
        body.classList.add('sidebar-visible');
    }

    // Toggle sidebar function
    function toggleSidebar() {
        body.classList.toggle('sidebar-visible');
        body.classList.toggle('sidebar-hidden');
    }

    // Toggle sidebar when button is clicked
    sidebarToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleSidebar();
    });

    // Close sidebar when clicking on overlay
    overlay.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            toggleSidebar();
        }
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 && 
            !sidebar.contains(e.target) && 
            e.target !== sidebarToggle && 
            !sidebarToggle.contains(e.target)) {
            body.classList.remove('sidebar-visible');
            body.classList.add('sidebar-hidden');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            body.classList.add('sidebar-visible');
            body.classList.remove('sidebar-hidden');
        } else {
            if (!body.classList.contains('sidebar-visible')) {
                body.classList.add('sidebar-hidden');
            }
        }
    });
});