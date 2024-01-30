<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('components.homeheaderbottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(!isset($_COOKIE['showpopup'])): ?>
        <?php echo $__env->make('components.homeloginpopup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('social_media', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="es">
        <div class="es__c">
            <h2 class="es__c-h2">Select Your Exam/Course</h2>
            <div class="es__c-c">
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(url('course') . '/' . urlencode($course->slug)); ?>">
                        <div class="esc">
                            <div class="esc__c">
                                <?php if($course->icon): ?>
                                    <img src="<?php echo e(asset('storage/' . $course->icon)); ?>" alt="CoachingDetail Course Icon">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('img/badge.svg')); ?>" alt="CoachingDetail Course Icon">
                                    <p class="esc__c-letter">
                                        <?php echo e($course->name[0]); ?>

                                    </p>
                                <?php endif; ?>
                            </div>

                            <p class="esc__title"><?php echo e($course->name); ?></p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
       
    </section>

    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($course->coachings->count() != 0): ?>
            <section class="ccv">
                <div class="ccv__c">
                    <div class="ccv__c-h">
                        <h5>Recently Added <?php echo e($course->name); ?> Coachings</h5>
                        <a href="<?php echo e(url('course') . '/' . $course->slug); ?>">
                            <span class="vlbtn">VIEW ALL</span>
                        </a>
                    </div>
                    <div class="ccv__c-cl">
                        <?php $__currentLoopData = $course->coachings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coaching): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url('coaching') . '/' . $coaching->slug); ?>" class="ccv__c-cl-cc">
                                <div>
                                    <img src="<?php echo e(url('storage') . '/' . $coaching->logo); ?>" alt="<?php echo e($coaching->name); ?>"
                                        loading="lazy">
                                    <h4><?php echo e($coaching->name); ?></h4>
                                    <p>
                                        
                                        <?php echo e($coaching->mainCourse->name); ?>

                                    </p>
                                    <p><?php echo e($cities->find(json_decode($coaching->cities)[0])->name ?? ''); ?>,
                                        <?php echo e(ucwords(strtolower($coaching->state))); ?></p>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <?php if(isset($recents)): ?>
        <section class="ccv">
            <div class="ccv__c">
                <div class="ccv__c-h">
                    <h5>Recently Viewed</h5>
                    <a href="<?php echo e(url('search') . '/' . 'recent'); ?>">
                        <span class="vlbtn">VIEW ALL</span>
                    </a>
                </div>
                <div class="ccv__c-cl">
                    <?php $__currentLoopData = $recents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coaching): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(url('coaching') . '/' . $coaching->slug); ?>" class="ccv__c-cl-cc">
                            <div>
                                <img src="<?php echo e(url('storage') . '/' . $coaching->logo); ?>" alt="<?php echo e($coaching->name); ?>"
                                    loading="lazy">
                                <h4><?php echo e($coaching->name); ?></h4>
                                <p><?php echo e($coaching->mainCourse->name); ?></p>
                                <p><?php echo e($cities->find(json_decode($coaching->cities)[0])->name ?? ''); ?>,<?php echo e(ucwords(strtolower($coaching->state))); ?>

                                </p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>


    

    

    <section class="t">
        <div class="t__c">
            <div class="t__c-h">
                <p>Testimonials</p>
            </div>
            <div class="t__c-c">
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_rakesh.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Rakesh</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>The Coachingdetail.com portal helped my brother in giving appropriate institute for
                                preparation for JEE and my brother securing a good rank. The different concepts helped in
                                searching good institute. I have already recommended this portal to known students.Again
                                thanks Coachingdetail and Taquino india Team</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_viswajeet.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Vishwajeet</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>At CD, teachers are always available for help and clearing doubts through social platform.
                                The way of teaching is helpful to students like me. Now I am preparing BPSC exam and this
                                social education platform is very useful for me.Thanks Coachingdetail</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_kundan.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Kundan</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>I think Coachingdetail.com is the best coaching comparison website and app for JEE and other
                                exams preparation . They provide us which is best coaching nearby you.I am very thankful to
                                Coachingdetail team for their continuous support and motivation which helped me to dream big
                                for myself and gave me the confidence to achieve it.</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_sneha.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Sneha</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>Really No.1 App.This websites is very helpful for the selection of coaching/Institute. With
                                the help of coachingdetail ,i have selected the coaching for junior engineer exam
                                preparation.Now the day,I am working as an engineer at Bihar Govt.Thanks Coachingdetail
                                team.</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_ritika.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Ritika</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>I loved Coachingdetail portal. Really this portal is very helpful for all students which
                                wants to admission in coaching institutes. before the selection of coaching you can compare
                                the institutes accordingthe faculty,fee,results facilities Etc. Coachingdetail helps to me
                                for the searching of GATE exam preparation institute at Patna.</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_deepak.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Deepak</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>

                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>I am a simple student and preparing for competitive exams like Bank, Railway, SSC Etc.With
                                the help of coachingdetail App I joined the coaching institutes without fee because some
                                coaching provide free of cost of education. This facilities i had known from coachingdetail
                                app.Thanks CD</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_nitish.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Nitish</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>If you want to join any coaching classes, before that you can visit coachingdetail portal.
                                Because this portal helps to you for the selection of coaching classes. I really use the App
                                of coachingdetail for the searching of SSC Exam preparation institutes at Delhi</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="<?php echo e(asset('assets/testimonial/tst_pintu.jpeg')); ?>" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Pintu</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>At first thanks Taquino India team for developing the portal and app of coachingdetail.This
                                is the best platform for teachers/faculties like me. Here teachers can promote our name with
                                the help of social education platform at coachingdetail. Here teachers/Students can post
                                education related topics.Here tweet and retweet facilities also available.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(session('enrollment_message')): ?>
        <script>
            swal({
                title: "Message",
                text: "<?php echo e(session('enrollment_message')); ?>",
                icon: "success",
                button: "OK",
            });
        </script>
    <?php endif; ?>
<?php echo $__env->make('faq', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php echo $__env->make('homekeyword', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/home.blade.php ENDPATH**/ ?>