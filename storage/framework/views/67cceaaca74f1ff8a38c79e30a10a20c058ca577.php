<div class="blog__c-pag">
    <?php if(!$data->onFirstPage()): ?>
        <a href="<?php echo e($data->previousPageUrl()); ?>">
            <span class="material-icons">chevron_left</span>
        </a>
    <?php endif; ?>
    <?php
        $start = $data->currentPage() < 3 ? 1 : $data->currentPage() - 2;
        $end = $data->lastPage() < 3 ? $data->lastPage() : ($data->currentPage() + 3 > $data->lastPage() ? $data->lastPage() : $data->currentPage() + 3);
    ?>
    <?php for($i = $start; $i <= $end; $i++): ?>
        <?php if(request('page') == $i || (request('page') == null && $i == 1)): ?>
            <a href="<?php echo e($data->url($i)); ?>" class="active-page"><?php echo e($i); ?></a>
        <?php else: ?>
            <a href="<?php echo e($data->url($i)); ?>"><?php echo e($i); ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if($data->hasMorePages()): ?>
        <a href="<?php echo e($data->nextPageUrl()); ?>">
            <span class="material-icons">chevron_right</span>
        </a>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\asus\Downloads\cd\resources\views/components/pagination.blade.php ENDPATH**/ ?>