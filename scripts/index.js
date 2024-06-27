$(document).ready(function () {
    $('#toggleOptions').click(function () {
        $('.optional-fields').toggle();
        $(this).hide();
    });

    $('#item-file').change(function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#file-preview-img').attr('src', e.target.result);
                $('.file-preview').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('.file-preview').hide();
        }
    });

    $('#addItemForm').on('submit', function (event) {
        event.preventDefault();
        const form = this;

        if (form.checkValidity() === false) {
            event.stopPropagation();
        } else {
            $.ajax({
                url: $(form).attr('action'),
                type: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function (response) {
                    const item = $('#item').val();
                    const category = $('#category').val();
                    $('#confirmation-message').html(`Item: ${item}, Category: ${category} <i class="fas fa-check-circle text-success"></i>`);
                    $('#confirmation').show();
                    form.reset();
                    $('.optional-fields').hide();
                    $('#toggleOptions').show();
                }
            });
        }

        form.classList.add('was-validated');
    });
});