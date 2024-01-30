<div class="rff">
    <div class="rff__c">
        <h5>Fee Structure</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Course</th>
                    <th>Course Name</th>
                    <th>Stream</th>
                    <th>Fees</th>
                    <th>Batch Starting Date</th>
                    <th>Duration</th>
                    <th>Admission Process</th>
                    <th>Scholarship Discount</th>
                    <th>Actions</th>
                </thead>
                <tbody class="fee_tbody">
                    <?php if(!isset($fees) || $fees->count() == 0): ?>
                        <tr>
                            <td>
                                <select name="fee_course[]">
                                    <option selected disabled>Select Course</option>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="fee_course_name[]">
                            </td>
                            <td>
                                <input type="text" name="fee_stream[]">
                            </td>
                            <td>
                                <input type="text" name="fee_fee[]">
                            </td>
                            <td>
                                <input type="date" name="fee_date[]">
                            </td>
                            <td>
                                <input type="text" name="fee_duration[]">
                            </td>
                            <td>
                                <input type="text" name="fee_process[]">
                            </td>
                            <td>
                                <input type="text" name="fee_discount[]">
                            </td>
                        
                            <td>
                                <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                            </td>
                        </tr>
                        
                    <?php else: ?>
                        <?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <select name="fee_course[]">
                                        <option selected disabled>Select Course</option>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($fee->course_id == $course->id): ?>
                                                <option value="<?php echo e($course->id); ?>" selected><?php echo e($course->name); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="fee_course_name[]" value="<?php echo e($fee->course_name); ?>">
                                </td>
                                <td>
                                    <input type="text" name="fee_stream[]" value="<?php echo e($fee->stream); ?>">
                                </td>
                                <td>
                                    <input type="text" name="fee_fee[]" value="<?php echo e($fee->fees); ?>">
                                </td>
                                <td>
                                    <input type="date" name="fee_date[]" value="<?php echo e($fee->batch_starting_date); ?>">
                                </td>
                                <td>
                                    <input type="text" name="fee_duration[]" value="<?php echo e($fee->course_duration); ?>">
                                </td>
                                <td>
                                    <input type="text" name="fee_process[]" value="<?php echo e($fee->admission_process); ?>">
                                </td>
                                <td>
                                    <input type="text" name="fee_discount[]" value="<?php echo e($fee->scholarship_discount); ?>">
                                </td>
                                <td>
                                    <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                                    <div class="addbtn" onclick="removeFeeRow(this,<?php echo e($fee->id); ?>)"><span class="material-icons">remove</span></div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function removeFeeRow(e,fee = 0){
        e.parentNode.parentNode.remove();
        if(fee != 0){
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"/dashboard/delete-fee-structure",
                    method:"POST",
                    data:{"fee_id":fee,'_token':'<?php echo e(csrf_token()); ?>'},
                    success: (res)=>{
                        if(res.status == "success"){
                        }
                    }
                }
            )
        }
    }

    function addFeeRow(){
        $('.fee_tbody').append(
            `
                <tr>
                    <td>
                        <select name="fee_course[]">
                            <option selected disabled>Select Course</option>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="fee_course_name[]">
                    </td>
                    <td>
                        <input type="text" name="fee_stream[]">
                    </td>
                    <td>
                        <input type="text" name="fee_fee[]">
                    </td>
                    <td>
                        <input type="date" name="fee_date[]">
                    </td>
                    <td>
                        <input type="text" name="fee_duration[]">
                    </td>
                    <td>
                        <input type="text" name="fee_process[]">
                    </td>
                    <td>
                        <input type="text" name="fee_discount[]">
                    </td>
                    <td>
                        <div class="addbtn" onclick="addFeeRow()"><span class="material-icons">add</span></div>
                        <div class="addbtn" onclick="removeFeeRow(this)"><span class="material-icons">remove</span></div>
                    </td>
                </tr>
            `
        );
    }
</script><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/coaching/feestructure.blade.php ENDPATH**/ ?>