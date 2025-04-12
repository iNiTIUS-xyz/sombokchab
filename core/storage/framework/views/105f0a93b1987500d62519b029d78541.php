$(document).on('click','#submit',function () {
    $(this).addClass("disabled")
    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e(__("Submitting")); ?>');
});<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/components/btn/submit.blade.php ENDPATH**/ ?>