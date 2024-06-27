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
            console.log("Form validation failed.");
        } else {
            console.log("Form is valid, sending AJAX request...");
            $.ajax({
                url: $(form).attr('action'),
                type: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log("AJAX request successful:", response);
                    try {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            const item = $('#item').val();
                            const category = $('#category').val();
                            $('#confirmation-message').html(`Item: ${item}, Category: ${category} <i class="fas fa-check-circle text-success"></i>`);
                            $('#confirmation').show();
                            form.reset();
                            $('.optional-fields').hide();
                            $('#toggleOptions').show();
                        } else {
                            alert(res.message);
                        }
                    } catch (e) {
                        console.error("Failed to parse JSON response:", e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", xhr.responseText);
                    console.error("Status:", status);
                    console.error("Error:", error);
                }
            });
        }

        form.classList.add('was-validated');
    });
});