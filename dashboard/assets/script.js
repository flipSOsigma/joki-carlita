$(document).ready(function() {
    // Handle form submissions
    // Handle add form submissions
$('.add-form').on('submit', function(e) {
    e.preventDefault();
    
    const form = $(this);
    const type = form.data('type');
    
    // Collect form data
    const formData = {};
    form.find('input, textarea, select').each(function() {
        // Skip buttons
        if ($(this).attr('type') !== 'submit') {
            formData[$(this).attr('name')] = $(this).val();
        }
    });
    
    // Show loading state
    const submitButton = form.find('button[type="submit"]');
    const originalText = submitButton.text();
    submitButton.prop('disabled', true).html(`
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
    `);
    
    // Send AJAX request
    $.ajax({
        url: 'add_data.php',
        type: 'POST',
        data: {
            type: type,
            form_data: formData
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification('Data added successfully!', 'success');
                form[0].reset(); // Reset form
            } else {
                showNotification('Error: ' + response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            showNotification('Error adding data: ' + error, 'error');
        },
        complete: function() {
            submitButton.prop('disabled', false).text(originalText);
        }
    });
});
    $('.ajax-form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const section = form.data('section');
        const index = form.data('index');
        
        // Collect form data
        const formData = {};
        form.find('input, textarea, select').each(function() {
            // Skip buttons
            if ($(this).attr('type') !== 'submit') {
                formData[$(this).attr('name')] = $(this).val();
            }
        });
        
        // Prepare data for AJAX
        const dataToSend = {
            section: section,
            form_data: formData
        };
        
        if (index !== undefined) {
            dataToSend.index = index;
        }
        
        // Show loading state
        const submitButton = form.find('button[type="submit"]');
        const originalText = submitButton.text();
        submitButton.prop('disabled', true).html(`
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Saving...
        `);
        
        // Send AJAX request
        $.ajax({
            url: 'save_data.php',
            type: 'POST',
            data: dataToSend,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification('Changes saved successfully!', 'success');
                } else {
                    showNotification('Error: ' + response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                showNotification('Error saving data: ' + error, 'error');
            },
            complete: function() {
                submitButton.prop('disabled', false).text(originalText);
            }
        });
    });
    
    // Show notification
    function showNotification(message, type) {
        const notification = $('#notification');
        notification.removeClass('bg-green-500 bg-red-500');
        
        if (type === 'error') {
            notification.addClass('bg-red-500');
        } else {
            notification.addClass('bg-green-500');
        }
        
        notification.text(message)
            .removeClass('translate-y-16 opacity-0')
            .addClass('translate-y-0 opacity-100');
        
        setTimeout(() => {
            notification.removeClass('translate-y-0 opacity-100')
                .addClass('translate-y-16 opacity-0');
        }, 3000);
    }
    
    // Smooth scrolling for navigation
    $('nav a').on('click', function(e) {
        if (this.hash !== '') {
            e.preventDefault();
            const hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 20
            }, 800);
        }
    });
});
