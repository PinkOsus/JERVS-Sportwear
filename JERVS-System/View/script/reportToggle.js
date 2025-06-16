    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
          const input = this.previousElementSibling;
          const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', type);
          this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
      });