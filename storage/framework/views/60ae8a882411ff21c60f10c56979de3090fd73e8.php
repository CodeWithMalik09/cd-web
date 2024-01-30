<?php $__env->startSection('content'); ?>
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <a href="<?php echo e(url('dashboard/createcoaching')); ?>">New Coaching</a>
                <form action="<?php echo e(url('dashboard/search-coaching')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="table__c">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Phone</th>
                        <th>District</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Enrollments</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php if(count($coachings) > 0): ?>
                            <?php
                                $i = 1;
                            ?>
                            <?php $__currentLoopData = $coachings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coaching): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr style="background-color:<?php echo e($i % 2 == 0 ? 'rgba(242,242,242)' : 'white'); ?>;">
                                    <td><?php echo e($i); ?></td>
                                    <td style="max-width:160px;"><?php echo e($coaching->name); ?></td>
                                    <td><?php echo e($coaching->mainCourse->name ?? "N/A"); ?></td>
                                    <td><?php echo e($coaching->phone); ?></td>
                                    <td><?php echo e($coaching->district); ?></td>
                                    <td><?php echo e($coaching->cities ? $citylist[json_decode($coaching->cities)[0]] : 'N/A'); ?></td>
                                    <td><?php echo e($coaching->state); ?></td>
                                    <td style="text-align: center;">
                                        <a target="_blank" href="<?php echo e(url('dashboard/coaching-enrollments') . '/' . $coaching->id); ?>" title="Enrollment" style="display:inline-flex !important;">
                                            <span class="material-icons">preview</span>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if(isset($type) && $type == 'unapproved'): ?>
                                            <a href="<?php echo e(url('dashboard/approve-coaching') . '/' . $coaching->id); ?>"
                                                title="Approve">
                                                <span class="material-icons">check</span>
                                            </a>
                                        <?php endif; ?>
                                        <a target="_blank" href="<?php echo e(url('coaching') . '/' . $coaching->slug); ?>" title="Edit">
                                            <span class="material-icons">preview</span>
                                        </a>
                                        <?php if($coaching->is_verified == 0): ?>
                                    <a onclick="ApproveItem(this)" data-type="coaching" data-href="<?php echo e(url('dashboard/approve') . '/' . $coaching->id); ?>" title="Edit">
                                        <span class="material-icons">close</span>
                                    </a>
                                    <?php else: ?>
                                    <a onclick="unApproveItem(this)" data-type="coaching" data-href="<?php echo e(url('dashboard/unapprove') . '/' . $coaching->id); ?>" title="Edit">
                                        <span class="material-icons">done</span>
                                    </a>
                                    <?php endif; ?>
                                        <a onclick="editItem(this)" data-type="coaching" data-href="<?php echo e(url('dashboard/editcoaching') . '/' . $coaching->id); ?>" title="Edit">
                                            <span class="material-icons">edit</span>
                                        </a>
                                        <a onclick="deleteItem(this)" data-type="coaching" data-href="<?php echo e(url('dashboard/deletecoaching') . '/' . $coaching->id); ?>" title="Delete">
                                            <span class="material-icons">delete</span>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    $i++;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if(!isset($search)): ?>
                <?php echo $__env->make('dashboard.components.pagination', ['data' => $coachings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/coaching/coachings.blade.php ENDPATH**/ ?>