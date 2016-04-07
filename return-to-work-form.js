(function($){

    $(function(){

        $('.form-control.date-picker').datepicker();

        $('#return-to-work-form').find('button').click(function(e){

            e.preventDefault();

            var error_messages = $('#error-messages');
            error_messages.html('');

            $('.form-control').each(function(){
                $(this).removeClass('form-control-error');
                var required = $(this).data('required');
                var value = $(this).val();
                var name = $(this).data('name');
                if (required == '1' && value.length == 0)
                {
                    addReturnToWorkError(name+' is required');
                    $(this).addClass('form-control-error');
                }
            });

            return_to_work_counter = 0;
            $('.days-of-week').each(function(){
                if($(this).prop('checked')){
                    return_to_work_counter++;
                }
            });
            if (return_to_work_counter == 0){
                addReturnToWorkError('At least one day of the week is required');
            }

            return_to_work_counter = 0;
            $('.job-length').each(function(){
                if($(this).prop('checked')){
                    return_to_work_counter++;
                }
            });
            if (return_to_work_counter == 0){
                addReturnToWorkError('At least one job length is required');
            }

            return_to_work_counter = 0;
            $('.language').each(function(){
                if($(this).prop('checked')){
                    return_to_work_counter++;
                }
            });
            if (return_to_work_counter == 0){
                addReturnToWorkError('At least one language is required');
            }

            if (error_messages.html().length > 0) {
                $('html,body').animate({
                    scrollTop: error_messages.offset().top - 40
                }, 1000);
            }
            else
            {
                $('#return-to-work-form').submit();
            }

        });

    });


})(jQuery);

var return_to_work_counter;

function addReturnToWorkError(error) {
    var error_messages = jQuery('#error-messages');
    if (error_messages.html().length == 0) {
        error_messages.html('<div class="alert alert-danger"><p>The following errors have occurred:</p><ul></ul></div>')
    }
    error_messages.find('ul').append('<li>'+error+'</li>');
}