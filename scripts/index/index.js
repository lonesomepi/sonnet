document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('toggleOptions').addEventListener('click', function () {
        const optionalFields = document.querySelectorAll('.optional-fields');
        optionalFields.forEach(function (field) {
            field.style.display = field.style.display === 'none' ? 'block' : 'none';
        });
        this.style.display = 'none';
    });

    document.getElementById('item-file').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById('file-preview-img');
                img.src = e.target.result;
                document.querySelector('.file-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.querySelector('.file-preview').style.display = 'none';
        }
    });

    document.getElementById('addItemForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const form = this;

        if (!form.checkValidity()) {
            event.stopPropagation();
        } else {
            const xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const item = document.getElementById('item').value;
                    const category = document.getElementById('category').value;
                    document.getElementById('confirmation-message').innerHTML = `Item: ${item}, Category: ${category} <i class="fas fa-check-circle text-success"></i>`;
                    document.getElementById('confirmation').style.display = 'block';
                    form.reset();
                    document.querySelectorAll('.optional-fields').forEach(function (field) {
                        field.style.display = 'none';
                    });
                    document.getElementById('toggleOptions').style.display = 'block';
                }
            };
            xhr.send(new FormData(form));
        }

        form.classList.add('was-validated');
    });
});