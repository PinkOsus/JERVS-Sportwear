// Remove the marginLeft manipulation from your JavaScript
// The CSS will now handle this entirely

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const body = document.body;

    // Toggle sidebar function
    function toggleSidebar() {
        body.classList.toggle('sidebar-active');
    }

    // Toggle sidebar when button is clicked
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 992 && 
            sidebar && 
            !sidebar.contains(e.target) && 
            e.target !== sidebarToggle && 
            (!sidebarToggle || !sidebarToggle.contains(e.target))) {
            body.classList.remove('sidebar-active');
        }
    });
});