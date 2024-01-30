<div class="pagination">
    <div class="pagination__c">
        <div class="pagination__c-lm">
            <a href="<?php echo e($data->url(0)); ?>" title="Move To First Page">
                <span class="material-icons">keyboard_double_arrow_left</span>                       
            </a>
        </div>
        <div class="pagination__c-l">
            <a href="<?php echo e($data->previousPageUrl()); ?>" title="Previous Page">
                <span class="material-icons">chevron_left</span>
            </a>
        </div>
        <div class="pagination__c-c">
            <p><?php echo e($data->currentPage()); ?></p>
        </div>
        <div class="pagination__c-r">
            <a href="<?php echo e($data->nextPageUrl()); ?>" title="Next Page">
                <span class="material-icons">chevron_right</span>
            </a>
        </div>
        <div class="pagination__c-rm">
            <a href="<?php echo e($data->url($data->lastPage())); ?>" title="Last Page">
                <span class="material-icons">keyboard_double_arrow_right</span>
            </a>
        </div>
    </div>
</div><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/components/pagination.blade.php ENDPATH**/ ?>