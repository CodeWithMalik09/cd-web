<head>
    <style>
  #local{
color: black;
font-weight: bold;
font-family:nunito;
font-size:15px;
}
/*for responsive */
#res2{
    display: none;
}
@media(max-width:700px){
    #res{
        display: none;
    }
    #res2{
        display: block;
    }
}

    </style>
</head>

<div class="cc">
    <div class="cc__l">
        <img src="<?php echo e(url('storage') . '/' . $coaching->logo); ?>" alt="Coaching Logo">
        <div class="cc__l-cbtn">
            <?php
                $rand = rand(1000, 500000);
                $valarr = [
                    'name' => $coaching->name,
                    'logo' => $coaching->logo,
                    'id' => Crypt::encryptString($coaching->id),
                ];
            ?>
            <input type="checkbox" class="comparebtn" value="<?php echo e(json_encode($coaching->only(['id', 'logo', 'name']))); ?>"
                data-id="<?php echo e($coaching->id); ?>" id="comparebtn_<?php echo e($rand); ?>">
            <label for="comparebtn_<?php echo e($rand); ?>">Add To Compare</label>
        </div>
    </div>
    <a href="<?php echo e(url('coaching') . '/' . $coaching->slug); ?>">
        <div class="cc__m">
            <div class="cc__m-h">
                
                <?php echo e($coaching->name); ?>

                
            </div>
            <div class="cc__m-r">
                <div class="cc__m-r-rc">
                    <i class="fa fa-star"></i>
                    <p><?php echo e($coaching->stats->average_rating ?? 0); ?></p>
                </div>
                <p><?php echo e($coaching->stats->likes ?? 0); ?> Likes & <?php echo e($coaching->stats->dislikes ?? 0); ?> Dislikes

                   <?php if($coaching->is_verified == 1): ?>
                            <!-- Display verified item -->
                            <img src="<?php echo e(asset('assets/verify.png')); ?>" alt="" height="35px" width="110px" style="margin-bottom:-7px ">
                        <?php endif; ?>

               </p>
            </div>
               <br>
              <p id="local">
                <?php if($coaching->locality != '' && $coaching->locality != NULL && $coaching->locality != 'null'): ?>
                    <?php $__currentLoopData = json_decode($coaching->locality); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $decodedLocality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($decodedLocality != 'others'): ?>
                            <?php $__currentLoopData = $localities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($decodedLocality == $locality->id): ?>
                                    <?php echo e($locality->name); ?>,
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($city->id, json_decode($coaching->cities))): ?>
                        <?php echo e($city->name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>            
            <ul>
                <li>Establishment: <?php echo e($coaching->establishment ?? "N/A"); ?> | Head Of the Institute: <?php echo e($coaching->head_organisation ?? "N/A"); ?></li>
                <li>Total Branch across India: <?php echo e($coaching->total_branches ?? "N/A"); ?></li>
                <li>Course:<?php echo e($coaching->mainCourse->name); ?></li>
                <li>Contact Number: <?php echo e($coaching->phone); ?></li>
                <li>Email: <?php echo e($coaching->email ?? "N/A"); ?></li>
                <li>Address: <?php echo e(ucwords(strtolower($coaching->address))); ?>,
                    <?php echo e(ucwords(strtolower($coaching->district))); ?>, <?php echo e(ucwords(strtolower($coaching->state))); ?>,
                    <?php echo e($coaching->country); ?>,
                    <?php echo e($coaching->pincode); ?></li>
            </ul>
            <div class="cc__m-bg">
                <a href="<?php echo e(url('feestructure') . '/' . $coaching->slug); ?>">
                    <div class="cc__m-bg-btn">FEE</div>
                </a>
                <a href="<?php echo e(url('faculties') . '/' . $coaching->slug); ?>">
                    <div class="cc__m-bg-btn">FACULTY</div>
                </a>
                <a href="<?php echo e(url('results') . '/achivement/' . $coaching->slug); ?>">
                    <div class="cc__m-bg-btn">ACHIEVEMENTS</div>
                </a>
                <a href="<?php echo e(url('results') . '/result/' . $coaching->slug); ?>" id="res">
                    <div class="cc__m-bg-btn">RESULTS</div>
                </a>
            </div>
           <a href="<?php echo e(url('results') . '/result/' . $coaching->slug); ?>" style="width:100px;margin-top:5px"id="res2">
                <div class="cc__m-bg-btn">RESULTS</div>
            </a>
        </div>
    </a>
    <div class="cc__r">
        <i class="fa fa-share"></i>
        <div class="cc__r-sc">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url("coaching/$coaching->slug")); ?>"
                target="_blank">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="https://wa.me/?text=<?php echo e(url("coaching/$coaching->slug")); ?>" target="_blank">
                <i class="fa fa-whatsapp"></i>
            </a>
            <a href="http://twitter.com/share?text=ShareCoachingDetaile&url=<?php echo e(url("coaching/$coaching->slug")); ?>"
                target="_blank">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="#">
                <i class="fa fa-linkedin"></i>
            </a>
        </div>
        <?php if(session('user')): ?>
            <i class="fa fa-heart wishbtn"
                style="cursor: pointer;<?php echo e($coaching->wishlisted ? 'color:red;' : 'color:grey;'); ?>"
                data-id="<?php echo e(Crypt::encrypt($coaching->id)); ?>" data-type="coaching"></i>
            <a class="cc__r-btn" href="<?php echo e(url("onlineadmission/$coaching->id")); ?>">
                <div>
                    <p>Enroll Now</p>
                </div>
            </a>
        <?php else: ?>
            <a href="<?php echo e(url('login')); ?>">
                <i class="fa fa-heart"></i>
            </a>
            <a class="cc__r-btn" href="<?php echo e(url('login')); ?>">
                <div>
                    <p>Enroll Now</p>
                </div>
            </a>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH C:\Users\asus\Downloads\cd\resources\views/components/coachingcard.blade.php ENDPATH**/ ?>