document.addEventListener('DOMContentLoaded', function () {
    // ===== DOM Elements =====
    const openBtn = document.getElementById('openAddMemberBtn');
    const addMemberPanel = document.getElementById('addMemberPanel');
    const addMemberForm = document.getElementById('addUserForm');
    const delForms = document.querySelectorAll('.delete-member-form');
    const passwordInput = addMemberForm?.querySelector('input[name="password"]');
    const togglePassword = addMemberForm?.querySelector('.toggle-password');

    // ===== Toggle Add Member Panel =====
    openBtn?.addEventListener('click', () => {
        addMemberPanel.style.display = 'block';
    });

    // ===== Close Panel =====
    window.closeModal = function () {
        addMemberPanel.style.display = 'none';
        addMemberForm?.reset();
    };

    // ===== Toggle Password Visibility =====
    togglePassword?.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    // ===== Form Submission =====
    addMemberForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch("../../Controller/Member-Management/add_member.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Member added successfully!');
                    addMemberForm.reset();
                    closeModal();
                    window.location.reload(); // Refresh to show new member
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    });

    // ===== Delete Confirmation =====
    //form submission for deleting members
    delForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('../../Controller/Member-Management/delete_member.php', {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Member deleted successfully!');
                    window.location.reload(); // Refresh to reflect deletion
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("An error occurred:", error);
            });
        });
    });
});