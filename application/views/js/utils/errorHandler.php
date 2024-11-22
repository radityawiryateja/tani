<div id="errors-notification-container" class="toast-container position-fixed top-0 end-0 p-3"></div>

<script>
    $('input, select, textarea, button').each(function () {
        $(this).on('click keyup', function () {

            const inputGroup = $(this).parent('.input-group');
            if (inputGroup.length !== 0) {
                removeErrorMessage(inputGroup) 
                return
            } 

            removeErrorMessage(this)
        })
    })
    
    window.addEventListener('click', e => {
        if ( e.target.classList.contains('select2-selection__rendered') ) {
            const el = $(e.target).closest('.select2')[0]
    
            removeErrorMessage(el)
        }
    })

    $('input[type="radio"]').click(function () {
        const parent = $(this).closest('.radio-input-wrapper');
        removeErrorMessage(parent.find('.radio-error-indicator')[0])
    })

    const displayTheErrors = (errors, exceptions = []) => {
        $('#errors-notification-container').html('')
    
        $.each(errors, (key, message) => {
            if (exceptions.length != 0) {
                if (exceptions.includes(key)) {
                    displayErrorNotification(message)
    
                    return
                }
            }
    
            let el = $(`#${key}`)

            const inputGroup = el.parent('.input-group');
            if (inputGroup.length !== 0) {
                el = inputGroup; 
            }
    
            if ( $(el).next('.select2').length != 0 ) {
                el = $(el).next('.select2')
            }
    
            const errorMessage = createErrorFeedback(message)
    
            el.addClass('is-invalid')
    
            if (el.next().hasClass('invalid-feedback')) {
                el.next().remove()
            }
            $(errorMessage).insertAfter(el)
        })
    
        if (exceptions.length != 0) {
            const errorNotifications = $('.error-notification')
            const notifications = []
    
            for (const notification of errorNotifications) {
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(notification)
                notifications.push(toastBootstrap)
            }
                
            for (const notification of notifications) {
                notification.show()
            }
        }
    }
    
    const displayErrorNotification = message => {
        const errorsContainer = $('#errors-notification-container')
        const notificationTemplate = `
            <div class="toast align-items-center text-bg-danger border-0 error-notification" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`
    
        errorsContainer.append(notificationTemplate)
    }
    
    const createErrorFeedback = errorMessage => {
        const message = `<div class="invalid-feedback">${errorMessage}</div>`
    
        return message
    }
    
    const removeErrorMessage = el => {
        $(el).removeClass('is-invalid')
    
        if ($(el).next().hasClass('invalid-feedback')) {
            $(el).next().remove()
        }
    }
</script>