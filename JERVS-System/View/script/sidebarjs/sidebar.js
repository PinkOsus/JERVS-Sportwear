document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const body = document.body;
    const navLinks = document.querySelectorAll('.nav-link');
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    
    // Function to update active state
    function setActiveLink() {
        const currentPage = window.location.pathname.split('/').pop();
        navLinks.forEach(link => {
            const linkPage = link.getAttribute('href').split('/').pop();
            if (linkPage === currentPage) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    // Set active link on page load
    setActiveLink();

    // Toggle sidebar function
    function toggleSidebar() {
        body.classList.toggle('sidebar-active');
        
        // Add or remove overlay based on screen size
        if (window.innerWidth <= 992) {
            if (body.classList.contains('sidebar-active')) {
                document.body.appendChild(overlay);
                document.body.style.overflow = 'hidden'; // Prevent scrolling when sidebar is open
            } else {
                if (document.body.contains(overlay)) {
                    document.body.removeChild(overlay);
                }
                document.body.style.overflow = ''; // Re-enable scrolling
            }
        }
    }

    // Close sidebar function
    function closeSidebar() {
        body.classList.remove('sidebar-active');
        if (document.body.contains(overlay)) {
            document.body.removeChild(overlay);
        }
    }

    // Toggle sidebar when button is clicked
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });
    }

    // Close sidebar when clicking overlay
    overlay.addEventListener('click', closeSidebar);

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 992 && 
            sidebar && 
            !sidebar.contains(e.target) && 
            e.target !== sidebarToggle && 
            (!sidebarToggle || !sidebarToggle.contains(e.target))) {
            closeSidebar();
        }
    });

    // Update active state when navigating
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 992) {
                closeSidebar();
            }
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            body.classList.remove('sidebar-active');
            if (document.body.contains(overlay)) {
                document.body.removeChild(overlay);
            }
            document.body.style.overflow = ''; // Ensure scrolling is enabled
        }
    });
});