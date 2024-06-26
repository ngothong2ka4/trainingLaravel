document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('createCategoryForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (validateForm()) {
            this.submit();
        }
    });

    function validateForm() {
        var name = document.getElementById('name').value.trim();
        var slug = document.getElementById('slug').value.trim();
        var isValid = true;

        // Reset error messages
        document.getElementById('nameError').textContent = '';
        document.getElementById('slugError').textContent = '';

        // Validate name
        if (name === '') {
            document.getElementById('nameError').textContent = 'Name is required.';
            document.getElementById('name').classList.add('is-invalid');
            isValid = false;
        } else {
            document.getElementById('name').classList.remove('is-invalid');
        }

        return isValid;
    }
});
