<?php $__env->startSection('content'); ?>
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <a href="javascript:void(0)">Students</a>
                <form action="<?php echo e(url('dashboard/search-student')); ?>" method="POST">
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
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Time</th>
                        <th>Enrollments</th>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                        ?>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="background-color:<?php echo e($i % 2 == 0 ? 'rgba(242,242,242)' : 'white'); ?>;">
                                <td><?php echo e($i); ?></td>
                                <td style="max-width:160px;"><?php echo e($student->name); ?></td>
                                <td><?php echo e($student->phone); ?></td>
                                <td><?php echo e($student->email); ?></td>
                                <td><?php echo e($student->latest_login_time); ?></td>
                                <td>
                                    <a target="_blank" href="<?php echo e(url('dashboard/student-enrollments') . '/' . $student->id); ?>" title="View">
                                        <span class="material-icons">preview</span>
                                    </a>

                                </td>
                            </tr>
                            <?php
                                $i++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if(!isset($search)): ?>
                <?php echo $__env->make('dashboard.components.pagination', ['data' => $students], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/student/latest_loggedin_students.blade.php ENDPATH**/ ?>