<div class="rff">
    <div class="rff__c">
        <h5 class="accordian">Student Achivements</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Course</th>
                    <th>Type</th>
                    <th>Exam Year</th>
                    <th>Stream</th>
                    <th>Student Name</th>
                    <th>Rank</th>
                    <th>Percentage/Score</th>
                    
                    
                    <th>Actions</th>
                </thead>
                <tbody class="achivement_tbody">
                    <?php if(!isset($results) || $results->count() == 0): ?>
                        <tr>
                            <td>
                                <input type="hidden" name="data_type[]" value="achivement">

                                <select name="result_course[]">
                                    <option selected disabled>Select Course</option>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="result_type[]">
                            </td>
                            <td>
                                <input type="text" name="result_exam_year[]">
                            </td>
                            <td>
                                <input type="text" name="result_stream[]">
                            </td>
                            <td>
                                <input type="text" name="result_student_name[]">
                            </td>
                            <td>
                                <input type="text" name="result_rank[]">
                            </td>
                            <td>
                                <input type="text" name="result_percentage[]">
                            </td>
                            
                            
                            <td>
                                <div class="addbtn" onclick="addAchivementRow()"><span class="material-icons">add</span></div>
                            </td>
                        </tr>
                        
                    <?php else: ?>
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="data_type[]" value="achivement">

                                    <select name="result_course[]">
                                        <option selected disabled>Select Course</option>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($result->course_id == $course->id): ?>
                                                <option value="<?php echo e($course->id); ?>" selected><?php echo e($course->name); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="result_type[]" value="<?php echo e($result->type); ?>">
                                </td>
                                <td>
                                    <input type="text" name="result_exam_year[]" value="<?php echo e($result->exam_year); ?>">
                                </td>
                                <td>
                                    <input type="text" name="result_stream[]" value="<?php echo e($result->stream); ?>">
                                </td>
                                <td>
                                    <input type="text" name="result_student_name[]" value="<?php echo e($result->student_name); ?>">
                                </td>
                                <td>
                                    <input type="text" name="result_rank[]" value="<?php echo e($result->rank); ?>">
                                </td>
                                <td>
                                    <input type="text" name="result_percentage[]" value="<?php echo e($result->percentage); ?>">
                                </td>
                                
                                <td>
                                    <div class="addbtn" onclick="addAchivementRow()"><span class="material-icons">add</span></div>
                                    <div class="addbtn" onclick="removeAchivementRow(this,'<?php echo e($result->student_name); ?>',<?php echo e($coaching->id); ?>)"><span class="material-icons">remove</span></div>
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
    function removeAchivementRow(e,studentname = 0,coaching = 0){
        e.parentNode.parentNode.remove();
        if(studentname != 0){
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"/dashboard/delete-result-and-achivement",
                    method:"POST",
                    data:{"coaching_id":coaching,"student_name":studentname,'_token':'<?php echo e(csrf_token()); ?>'},
                    success: (res)=>{
                        if(res.status == "success"){
                        }
                    }
                }
            )
        }
    }


    function addAchivementRow(){
        $('.achivement_tbody').append(
            `
                <tr>
                    <td>
                        <input type="hidden" name="data_type[]" value="achivement">
                        <select name="result_course[]">
                            <option selected disabled>Select Course</option>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="result_type[]">
                    </td>
                    <td>
                        <input type="text" name="result_exam_year[]">
                    </td>
                    <td>
                        <input type="text" name="result_stream[]">
                    </td>
                    <td>
                        <input type="text" name="result_student_name[]">
                    </td>
                    <td>
                        <input type="text" name="result_rank[]">
                    </td>
                    <td>
                        <input type="text" name="result_percentage[]">
                    </td>
                    <td>
                        <div class="addbtn" onclick="addAchivementRow()"><span class="material-icons">add</span></div>
                        <div class="addbtn" onclick="removeRow(this)"><span class="material-icons">remove</span></div>
                    </td>
                </tr>
            `
        );
    }
</script><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/coaching/result.blade.php ENDPATH**/ ?>