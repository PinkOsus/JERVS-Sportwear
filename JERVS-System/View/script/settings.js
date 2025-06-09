document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabSections = document.querySelectorAll('.settings-section');
    
    tabButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons and sections
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabSections.forEach(section => section.classList.remove('active'));
        
        // Add active class to clicked button and corresponding section
        this.classList.add('active');
        const tabId = this.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('active');
      });
    });
    
    // File upload display
    const fileUpload = document.getElementById('logo-upload');
    if (fileUpload) {
      fileUpload.addEventListener('change', function() {
        const fileName = this.files[0] ? this.files[0].name : 'No file selected';
        document.querySelector('.file-name').textContent = fileName;
        
        // Preview image if selected
        if (this.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const preview = document.querySelector('.logo-preview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Logo Preview" style="max-width: 200px; max-height: 100px; border-radius: 4px;">`;
          }
          reader.readAsDataURL(this.files[0]);
        }
      });
    }
    
    // Theme selection
    const themeOptions = document.querySelectorAll('.theme-option');
    themeOptions.forEach(option => {
      option.addEventListener('click', function() {
        themeOptions.forEach(opt => opt.classList.remove('active'));
        this.classList.add('active');
        // Here you would add code to actually change the theme
        const theme = this.getAttribute('data-theme');
        console.log('Theme changed to:', theme);
      });
    });
  });