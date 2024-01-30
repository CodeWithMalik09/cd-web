<?php $__env->startSection('content'); ?>
    <div class="dhome">
        <div class="dhome__c">
            
            <div class="cardcontainer">
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Coachings</h4>
                        <p>Total Coachings listed on website</p>
                        <div class="count"><?php echo e($coachings); ?></div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Tutor</h4>
                        <p>Total tutors listed on website</p>
                        <div class="count"><?php echo e($tutors); ?></div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Library</h4>
                        <p>Total libraries listed on website</p>
                        <div class="count"><?php echo e($libraries); ?></div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Courses</h4>
                        <p>Total courses offered by all coachings</p>
                        <div class="count"><?php echo e($courses); ?></div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Operation Areas</h4>
                        <p>Number of cities coaching detail currently working</p>
                        <div class="count"><?php echo e($cities); ?></div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Blogs</h4>
                        <p>Total blogs created on website</p>
                        <div class="count"><?php echo e($blogs); ?></div>
                    </div>
                    <div class="st"></div>
                </div>
                
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Students</h4>
                        <p>Total students registered on website</p>
                        <div class="count"><?php echo e($students); ?></div>
                    </div>
                    <div class="st"></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/home.blade.php ENDPATH**/ ?>