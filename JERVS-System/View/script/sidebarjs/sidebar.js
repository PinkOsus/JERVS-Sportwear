document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.fashion-sidebar');
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    document.body.appendChild(overlay);
    
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });
    
    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
    
    // Toggle submenus
    const navItems = document.querySelectorAll('.with-submenu');
    
    navItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        const submenuToggle = item.querySelector('.submenu-toggle');
        
        // Handle click on the entire nav link
        link.addEventListener('click', function(e) {
            // Only prevent default if clicking on the toggle icon
            if (e.target === submenuToggle || submenuToggle.contains(e.target)) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other open submenus
                navItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            }
        });
    });
    
    // Close submenus when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.fashion-sidebar')) {
            navItems.forEach(item => {
                item.classList.remove('active');
            });
        }
    });
    
    // Responsive adjustments
    function handleResize() {
        if (window.innerWidth > 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    }
    
    window.addEventListener('resize', handleResize);
    handleResize();
});