$(document).ready(function() {
    // jQuery validation on form submission
    $('#postForm').submit(function(event) {
        let title = $('#title').val().trim();
        let content = $('#content').val().trim();
        let valid = true;

        // Clear previous error messages
        $('.error').remove();

        // Validate title
        if (title.length === 0) {
            $('#title').after('<span class="error text-danger">Title is required.</span>');
            valid = false;
        } else if (title.length > 255) {
            $('#title').after('<span class="error text-danger">Title cannot exceed 255 characters.</span>');
            valid = false;
        }

        // Validate content
        if (content.length === 0) {
            $('#content').after('<span class="error text-danger">Content is required.</span>');
            valid = false;
        }

        // Prevent form submission if validation fails
        if (!valid) {
            event.preventDefault();
        }
    });
    
});
