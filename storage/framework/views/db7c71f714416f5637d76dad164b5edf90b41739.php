<div class="rff">
    <div class="rff__c">
        <h5 class="accordian">Student Results</h5>
        <div class="rff__c-table">
            <table>
                <thead>
                    <th>Course</th>
                    <th>Exam Year</th>
                    <th>Stream/Post</th>
                    <th>Selected Students(PT)</th>
                    <th>Selected Students(Mains)</th>
                    <th>Selected Students(Final)</th>
                    
                    
                    <th>Actions</th>
                </thead>
                <tbody class="result_tbody">
                    <?php if(!isset($results) || $results->count() == 0): ?>
                        <tr>
                            <td>
                                <input type="hidden" name="rcdata_type[]" value="result">
                                <select name="rcresult_course[]">
                                    <option selected disabled>Select Course</option>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <select name="rcresult_exam_year[]" id="">
                                    <option disabled selected>Select Year</option>
                                    <option value="N/A">N/A</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="rcresult_stream[]">
                            </td>
                            <td>
                                <select name="selected_in_pt[]">
                                    <option disabled selected>Select</option>
                                    <option value="N/A">N/A</option>
                                    <option value="1-24">1-24</option>
                                    <option value="24-49">24-49</option>
                                    <option value="50-99">50-99</option>
                                    <option value="100-249">100-249</option>
                                    <option value="250-499">250-499</option>
                                    <option value="500-999">500-999</option>
                                    <option value="1000+">1000+</option>
                                </select>
                            </td>
                            <td>
                                <select name="selected_in_mains[]">
                                    <option disabled selected>Select</option>
                                    <option value="N/A">N/A</option>
                                    <option value="1-24">1-24</option>
                                    <option value="24-49">24-49</option>
                                    <option value="50-99">50-99</option>
                                    <option value="100-249">100-249</option>
                                    <option value="250-499">250-499</option>
                                    <option value="500-999">500-999</option>
                                    <option value="1000+">1000+</option>
                                </select>
                            </td>
                            <td>
                                <select name="selected_in_final[]">
                                    <option disabled selected>Select</option>
                                    <option value="N/A">N/A</option>
                                    <option value="1-24">1-24</option>
                                    <option value="24-49">24-49</option>
                                    <option value="50-99">50-99</option>
                                    <option value="100-249">100-249</option>
                                    <option value="250-499">250-499</option>
                                    <option value="500-999">500-999</option>
                                    <option value="1000+">1000+</option>
                                </select>
                            </td>
                            <td>
                                <div class="addbtn" onclick="addResultRow()"><span class="material-icons">add</span>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php
                            $year_range = ['N/A',2018, 2019, 2020, 2021, 2022, 2023];
                            $selection_range = ['N/A','1-24', '24-49', '50-99', '100-249', '250-499', '500-999', '1000+'];
                        ?>
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="rcdata_type[]" value="result">
                                    <select name="rcresult_course[]">
                                        <option selected disabled>Select Course</option>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($result->course_id == $course->id): ?>
                                                <option value="<?php echo e($course->id); ?>" selected><?php echo e($course->name); ?>

                                                </option>
                                            <?php else: ?>
                                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>

                                <td>
                                    <select name="rcresult_exam_year[]" id="">
                                        <?php $__currentLoopData = $year_range; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($year == $result->exam_year): ?>
                                                <option value="<?php echo e($year); ?>" selected><?php echo e($year); ?>

                                                </option>
                                            <?php else: ?>
                                                <option value="<?php echo e($year); ?>"><?php echo e($year); ?>

                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>

                                    <input type="text" name="rcresult_stream[]" value="<?php echo e($result->stream); ?>">
                                </td>
                                <td>
                                    <select name="selected_in_pt[]" id="">
                                        <?php $__currentLoopData = $selection_range; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($select == $result->selected_in_pt): ?>
                                                <option value="<?php echo e($select); ?>" selected><?php echo e($select); ?>

                                                </option>
                                            <?php else: ?>
                                                <option value="<?php echo e($select); ?>"><?php echo e($select); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="selected_in_mains[]" id="">
                                        <?php $__currentLoopData = $selection_range; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($select == $result->selected_in_mains): ?>
                                                <option value="<?php echo e($select); ?>" selected><?php echo e($select); ?>

                                                </option>
                                            <?php else: ?>
                                                <option value="<?php echo e($select); ?>"><?php echo e($select); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="selected_in_final[]" id="">
                                        <?php $__currentLoopData = $selection_range; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($select == $result->selected_in_final): ?>
                                                <option value="<?php echo e($select); ?>" selected><?php echo e($select); ?>

                                                </option>
                                            <?php else: ?>
                                                <option value="<?php echo e($select); ?>"><?php echo e($select); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>

                                <td>
                                    <div class="addbtn" onclick="addResultRow()"><span class="material-icons">add</span>
                                    </div>
                                    <div class="addbtn"
                                        onclick="removeResultRow(this,'<?php echo e($result->student_name); ?>',<?php echo e($coaching->id); ?>)">
                                        <span class="material-icons">remove</span>
                                    </div>
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
    function removeResultRow(e, studentname = 0, coaching = 0) {
        e.parentNode.parentNode.remove();
        if (studentname != 0) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/dashboard/delete-result-and-achivement",
                method: "POST",
                data: {
                    "coaching_id": coaching,
                    "student_name": studentname,
                    '_token': '<?php echo e(csrf_token()); ?>'
                },
                success: (res) => {
                    if (res.status == "success") {}
                }
            })
        }
    }


    function addResultRow() {
        $('.result_tbody').append(
            `
                <tr>
                    <td>
                        <input type="hidden" name="rcdata_type[]" value="result">
                        <select name="rcresult_course[]">
                            <option selected disabled>Select Course</option>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <select name="rcresult_exam_year[]" id="">
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="rcresult_stream[]">
                    </td>
                    <td>
                        <select name="selected_in_pt[]">
                            <option value="1-24">1-24</option>
                            <option value="24-49">24-49</option>
                            <option value="50-99">50-99</option>
                            <option value="100-249">100-249</option>
                            <option value="250-499">250-499</option>
                            <option value="500-999">500-999</option>
                            <option value="1000+">1000+</option>
                        </select>
                    </td>
                    <td>
                        <select name="selected_in_mains[]">
                            <option value="1-24">1-24</option>
                            <option value="24-49">24-49</option>
                            <option value="50-99">50-99</option>
                            <option value="100-249">100-249</option>
                            <option value="250-499">250-499</option>
                            <option value="500-999">500-999</option>
                            <option value="1000+">1000+</option>
                        </select>
                    </td>
                    <td>
                        <select name="selected_in_final[]">
                            <option value="1-24">1-24</option>
                            <option value="24-49">24-49</option>
                            <option value="50-99">50-99</option>
                            <option value="100-249">100-249</option>
                            <option value="250-499">250-499</option>
                            <option value="500-999">500-999</option>
                            <option value="1000+">1000+</option>
                        </select>
                    </td>
                    <td>
                        <div class="addbtn" onclick="addResultRow()"><span class="material-icons">add</span></div>
                        <div class="addbtn" onclick="removeRow(this)"><span class="material-icons">remove</span></div>
                    </td>
                </tr>
            `
        );
    }
</script>
<?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/coaching/results.blade.php ENDPATH**/ ?>