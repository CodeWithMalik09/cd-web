<?php $__env->startSection('content'); ?>
<head>
 <link rel="stylesheet" href="<?php echo e(asset('css/coachingcss.css')); ?>">
 <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
 <?php echo $__env->make('social_media', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="ch">
        <div class="ch__c">
            <div class="ch__c-title">
                              <center>
            <div class="heading-container">
        <h1><?php echo e($coaching->name); ?></h1>
    
              </div>
              <div class="paracontainer">
                <p>
                    FIND    THE    BEST    COACHING    IN    YOUR    CITY 
                </p>
    
              </div>
              </center>
                <img src="<?php echo e(asset('assets/thumbnail.jpeg')); ?>" alt="Coaching Detail || Title Image"
                    class="ch__c-title-i">
                
                
            </div>
            <div class="ch__c-b">
                <a href="<?php echo e(url('/')); ?>">
                    <p>Home</p>
                </a> <i class="fa fa-chevron-right"></i>
                <p>Coaching </p> <i class="fa fa-chevron-right"></i>
                <p><?php echo e($coaching->name); ?></p>
            </div>
            <div class="ch__c-f">
                <div class="form">
                    <form>
                        <?php
                            $types = ['Regular', 'Test Series', 'Correspondance', 'Online', 'Tutor', 'Library'];
                        ?>,
                        <select name="type" id="type">
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select name="category" id="course">
                            <?php $__currentLoopData = $allcourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($coaching->main_course_id == $course->id): ?>
                                    <option value="<?php echo e($course->slug); ?>" selected><?php echo e($course->name); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($course->slug); ?>"><?php echo e($course->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select name="city" id="city">
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array($city->id, json_decode($coaching->cities))): ?>
                                    <option value="<?php echo e($city->name); ?>" selected><?php echo e($city->name); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($city->name); ?>"><?php echo e($city->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="submit" id="searchbtn">Search</button>
                    </form>
                </div>
                <script>
                    $('#searchbtn').click((e) => {
                        e.preventDefault();
                        window.open(`<?php echo e(url('homesearch')); ?>/${$('#type').val()}/${$('#course').val()}/${$('#city').val()}`,
                            '_self');
                    })
                </script>
            </div>
            <div class="ch__c-mc">
                <div class="ch__c-mc-l">
                    <?php if(session('user')): ?>
                        <div class="wishlist">
                            <i class="fa fa-heart wishbtn"
                                style="cursor: pointer;color: <?php echo e($coaching->wishlisted ? 'red;' : 'grey;'); ?>"
                                data-id="<?php echo e(Crypt::encrypt($coaching->id)); ?>" data-type="coaching">
                            </i>
                        </div>
                    <?php else: ?>
                        <a class="wishlist" href="<?php echo e(url('login')); ?>">
                            <i class="fa fa-heart wishbtn"></i>
                        </a>
                    <?php endif; ?>
                    <div class="logo">
                        <img src="<?php echo e(url('storage') . '/' . $coaching->logo); ?>" alt="<?php echo e($coaching->name); ?>">
                    </div>
                    <?php
                        $images = [];
                        array_push($images, url('storage') . '/' . $coaching->logo);
                    ?>
                    <div class="gallery">
                        <?php if($coaching->galleries): ?>
                            <?php $__currentLoopData = $coaching->galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    array_push($images, url('storage') . '/' . $img->image);
                                ?>
                                <img src="<?php echo e(url('storage') . '/' . $img->image); ?>" alt="Img"
                                    onclick="viewImage(this)">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                      <div class="extra">
                        <?php if(session('user')): ?>
                            <a href="<?php echo e(url("onlineadmission/$coaching->id")); ?>">Enroll Now</a>
                        <?php else: ?>
                            <a href="<?php echo e(url('login')); ?>">Enroll Now</a>
                        <?php endif; ?>
                        <a href="<?php echo e(url('mapview') . '/' . Crypt::encrypt($coaching->id)); ?>">Map View</a>
                    </div>

                     
                          <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>

                     <div class="address">

                         <div class="popup-container" id="popupContainer">
                            <p style="font-family:nunito;font-size:22px;margin-bottom:10px">Contact Information <i class="fa fa-times" style="margin-left:70px;cursor:pointer" onclick="closeShow()"></i></p>
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:<?php echo e($coaching->phone); ?>" ><?php echo e($coaching->phone); ?></a></p>
                               <?php if($coaching->alternate_phone != null): ?>
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:<?php echo e($coaching->alternate_phone); ?>" ><?php echo e($coaching->alternate_phone); ?></a></p>
                             <?php endif; ?>
                                     <?php if($coaching->landline_number != null): ?>
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:<?php echo e($coaching->landline_number); ?>" ><?php echo e($coaching->landline_number); ?></a></p>
                             <?php endif; ?>

                            <?php if($coaching->phone != $coaching->whatsapp_no && $coaching->whatsapp_no != null): ?>
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:<?php echo e($coaching->whatsapp_no); ?>" ><?php echo e($coaching->whatsapp_no); ?></a></p>
                             <?php endif; ?>
                        </div>

                        <h3>Address</h3>
                        <p>

                         <?php echo e($coaching->landmark ? $coaching->landmark . ', '.' ' : ''); ?>

                            <?php echo e($coaching->address . ', '); ?>

                            <?php echo e(ucwords(strtolower($coaching->district)) . ',  '.' '); ?>

                            <?php echo e(ucwords(strtolower($coaching->state)) . ',  '.' '); ?>

                            <?php echo e($coaching->pincode); ?>                       
                           </p>
                       <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>                       
                           <?php if(session('user')): ?>
                             <div class="contactbtn" style="display:flex;margin-left:5px">


                                    <button id="popupButton" onclick="showPopup()"
                                        style="border-radius: 9.564px;margin-top:5px; margin-bottom:5px;
                                border: 0.956px solid #00C514;
                                  background: linear-gradient(180deg, #6BCF1C 5.73%, rgba(150, 255, 67, 0.82) 10.94%, #4BA505 83.85%);width:60%">
                                     <i class="fa fa-phone"></i>
                                        Show Number


                                    </button>
                                    <center> <button id="popupButton"
                                            style="border-radius: 9.564px;margin-top:5px; margin-bottom:5px;margin-left:7px;
                                           border: 0.956px solid #00C514;
                                          background: linear-gradient(180deg, #6BCF1C 5.73%, rgba(150, 255, 67, 0.82) 10.94%, #4BA505 83.85%);width:100%">
                                           <i class="fab fa-whatsapp"></i>
                                            <a href="https://wa.me/<?php echo e($coaching->whatsapp_no); ?>" target="_blank"
                                                style="color:white">Chat</a>



                                        </button>
                                </div>
                            </center>
                        <?php else: ?>
                        <div class="contactbtn" style="display:flex;margin-left:5px">


                            <button
                                style="border-radius: 9.564px;margin-top:5px; margin-bottom:5px;
                               border: 0.956px solid #00C514;
                                   background: linear-gradient(180deg, #6BCF1C 5.73%, rgba(150, 255, 67, 0.82) 10.94%, #4BA505 83.85%);width:60%"><i
                                    class="fa fa-phone" aria-hidden="true"></i>
                                    <a href="<?php echo e(url('login')); ?>" target="_blank"
                                    style="color:white">   Get Number </a>


                            </button>
                            <center> <button id="popupButton"
                                    style="border-radius: 9.564px;margin-top:5px; margin-bottom:5px;margin-left:7px;
            border: 0.956px solid #00C514;
            background: linear-gradient(180deg, #6BCF1C 5.73%, rgba(150, 255, 67, 0.82) 10.94%, #4BA505 83.85%);width:100%"><i
                                        class="fab fa-whatsapp"></i>
                                    <a href="<?php echo e(url('login')); ?>" target="_blank"
                                        style="color:white">Chat</a>



                                </button>
                        </div>
                    </center>                        
                    <?php endif; ?>

                    </div>
                    <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>
                        
                    <div class="workinghours">
                        <?php
                            $hasWorkingHours = false;

                        ?>
                        <?php $__currentLoopData = $newworkinghours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newworkinghour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(
                                $newworkinghour->coaching_id == $coaching->id &&
                                    !empty($newworkinghour->weekdays) &&
                                    !empty($newworkinghour->from) &&
                                    !empty($newworkinghour->to)): ?>
                                <?php
                                    $hasWorkingHours = true;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($hasWorkingHours): ?>
                            <h3>Working Hours</h3>
                        <?php endif; ?>

                        <?php $__currentLoopData = $newworkinghours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newworkinghour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(
                                $newworkinghour->coaching_id == $coaching->id &&
                                    !empty($newworkinghour->weekdays) &&
                                    !empty($newworkinghour->from) &&
                                    !empty($newworkinghour->to)): ?>
                                <?php
                                    $hasWorkingHours = true;
                                ?>

                                <p id="wh">
                                    <?php echo e($newworkinghour->weekdays); ?>

                                    <?php echo e($newworkinghour->from.'-'); ?>

                                    <?php echo e($newworkinghour->to); ?>

                                </p>
                                <br>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                          <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>
                     <?php if($coachingList->count() !=0): ?>
                  <div class="similarcoachings">
                        <h3 style="font-family: nunito;font-size:20px;margin-bottom:8px;margin-left:5px">Similar Coachings
                        </h3>
                    </div>
                    <?php endif; ?>


                    <div class="gallerys">

                        <?php $__currentLoopData = $coachingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coachingList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url('coaching') . '/' . $coachingList->slug); ?>">
                         <img src="<?php echo e(url('storage') . '/' . $coachingList->logo); ?>" alt="<?php echo e($coachingList->name); ?>"width="100%">


                                <center>
                                    <p id="title" style="font-size: 17px;font-family:nunito">
                                        <?php echo e($coachingList->name); ?></p>
                                    <p id="paragraph" style="font-size:12px;color:gray;margin-top:-6px;">
                                        <?php echo e($coachingList->mainCourse->name); ?></p>

                                    

                                    <?php if($coachingList->locality != '' && $coachingList->locality != null && $coachingList->locality != 'null'): ?>
                                        <?php $__currentLoopData = json_decode($coachingList->locality); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $decodedLocality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($decodedLocality != 'others'): ?>
                                                <?php $__currentLoopData = $localities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($decodedLocality == $locality->id): ?>
                                                        <p style="font-size:12px;color:gray;margin-top:-5px;">
                                                            <?php echo e($locality->name); ?>,
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    
                                    
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($city->id, json_decode($coachingList->cities))): ?>

                                          <span style="font-size:12px;color:gray;margin-top:-5px;">      <?php echo e($city->name); ?></span></p>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </center>
                            </a>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                                                              
                   
                </div>
                <div class="ch__c-mc-r">
                    <div class="mrow">
                        <h2><?php echo e($coaching->name); ?></h2>
                        <div class="row">
         
                            <input type="checkbox" class="comparebtn" data-id="<?php echo e($coaching->id); ?>"
                                value="<?php echo e(json_encode($coaching->only(['id', 'logo', 'name']))); ?>" id="compare-btn"
                                style="display:none;">
                            <label class="share-btn coaching-compare-btn" for="compare-btn">
                                <i class="fa fa-random"></i>
                                <span>Compare</span>
                            </label>
                            <div
                                class="share-btn"onclick="shareMe('<?php echo e(urlencode(url('coaching') . '/' . $coaching->slug)); ?>')">
                                <i class="fa fa-share"></i>
                                <span>Share</span>
                                <div class="share-container">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url("coaching/$coaching->slug")); ?>"
                                        target="_blank">
                                        <i class="fab fa-facebook"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a href="http://twitter.com/share?text=ShareCoachingDetaile&url=<?php echo e(url("coaching/$coaching->slug")); ?>"
                                        target="_blank">
                                        <i class="fab fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a href="https://wa.me/?text=<?php echo e(url("coaching/$coaching->slug")); ?>" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>Whatsapp</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
           
                    <div class="dflex">
                    <p id="en">
                        <?php if(session('user')): ?>
                        <a href="<?php echo e(url("onlineadmission/$coaching->id")); ?>" id="enow">Enroll Now</a>
                    <?php else: ?>
                        <a href="<?php echo e(url('login')); ?>" id="enow">Enroll Now</a>
                    <?php endif; ?>
                </p>
                   <?php if($feedisc!=null && $feedisc->scholarship_discount !='YES' && $feedisc->scholarship_discount !='NO' && $feedisc->scholarship_discount !='Yes' && $feedisc->scholarship_discount !='No' && $feedisc->scholarship_discount !=null): ?>
                <p id="disc">
             
                      <?php echo e($feedisc->scholarship_discount !='YES' && $feedisc->scholarship_discount !='NO' && $feedisc->scholarship_discount !='Yes' && $feedisc->scholarship_discount !='No' && $feedisc->scholarship_discount !=null?  $feedisc->scholarship_discount.' '.'off' :''); ?>

            
            </p>
          <?php endif; ?>
        </div>   
                      
                    <div class="rc">
   <p style="font-size:15px;color:white;background-color:#2873F0;padding:9px 18px;border-radius:5px">

                        <i class="fa fa-star"></i>
                        <?php echo e($coaching->stats->average_rating ?? 0); ?></p>

                    <p style="margin-left:10px;font-size:15px;color:white;background-color:#2873F0;padding:8px 15px;border-radius:5px">
                        <img src="<?php echo e(asset('assets/like.png')); ?>" height="15px" width="15px">
                        <?php echo e($coaching->stats->likes . ' ' . '|' ?? 0.0); ?>



                        <img src="<?php echo e(asset('assets/dislike.png')); ?>" height="15px" width="15px">
                        <?php echo e($coaching->stats->dislikes ?? 2.2); ?>

                    </p>

                    <?php if($coaching->is_verified == 1): ?>
                        <!-- Display verified item -->
                        <img src="<?php echo e(asset('assets/verify.png')); ?>" alt="" height="35px" width="110px"
                            style="margin-bottom:-7px ">
                    <?php endif; ?>                      
                       <br>
                        </div>
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

                     <div class="sc">
                    <div id="popupMenu" class="popup-menu" style="display: none;">
                        <?php $__currentLoopData = $othercourses->unique('mainCourse.name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $othercourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url('coaching') . '/' . $othercourse->slug); ?>" style="margin-right:6px">

                                <button style="margin:5px;">
                                    <?php echo e('     ' . $othercourse->mainCourse->name ?? 'N/A'); ?>

                                </button>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <h2 style="background-color: lightgray;padding:6px 10px;color:black;margin:3px;margin-top:5px">
                        General
                        Information</h2>


                    <div class="container mt-5 custom-container" style="margin:20px">
                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                       <img src="<?php echo e(asset('img/Establishment1.png')); ?>" alt="" style="height: 22px;width:22px;margin-bottom:-5px;margin-right:5px"> Establishment
                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                       | <?php echo e($coaching->establishment ?? 'N/A'); ?>

                                    </div>
                                </div>
                            </div>


                            <!-- Third Column -->

                        </div>
                        <!-- Repeat the above structure for additional rows -->


                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo e(asset('img/hod.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Head of Organisation
                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | <?php echo e($coaching->head_organisation ?? 'N/A'); ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Third Column -->

                        </div>
                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo e(asset('img/tbai.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Total Branches Accross India

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | <?php echo e($coaching->total_branches ?? 'N/A'); ?>

                                    </div>
                                </div>
                            </div>


                            <!-- Third Column -->

                        </div>
                        <!-- Repeat the above structure for additional rows -->


                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo e(asset('img/area.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Total Area

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | <?php echo e($coaching->total_area ?? 'N/A'); ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Third Column -->

                        </div>
                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo e(asset('img/status.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Status of Coaching

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | <?php echo e($coaching->institute_status); ?>

                                    </div>
                                </div>
                            </div>


                            <!-- Third Column -->

                        </div>
                        <!-- Repeat the above structure for additional rows -->


                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <iconify-icon icon="material-symbols:category" style="font-size:22px;color:#2873F0;margin-bottom:-5px;margin-right:5px"></iconify-icon>
                                        Course Type

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                    | <?php echo e($categories); ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Third Column -->

                        </div>

                       <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <iconify-icon icon="carbon:course" style="font-size:20px;color:#2873F0;margin-bottom:-5px;margin-right:5px" ></iconify-icon>Streams

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | <?php echo e($coaching->streams); ?>

                                    </div>
                                </div>
                            </div>


                            <!-- Third Column -->

                        </div>


                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <iconify-icon icon="carbon:course" style="font-size:20px;color:#2873F0;margin-bottom:-5px;margin-right:5px" ></iconify-icon>Course

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | <?php echo e($coaching->mainCourse->name); ?>

                                    </div>
                                </div>
                            </div>


                            <!-- Third Column -->

                        </div>
                        <!-- Repeat the above structure for additional rows -->
                        <div class="row" style="width:100%">
                            <!-- First Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?php echo e(asset('img/course.png')); ?>" alt="" style="height:20px;width:20px;margin-bottom:-5px;margin-right:5px">Other Courses

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        |  <?php $__currentLoopData = $othercourses->unique('mainCourse.name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $othercourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                        <a href="<?php echo e(url('coaching') . '/' . $othercourse->slug); ?>" class="other">


                                                <?php echo e($othercourse->mainCourse->name?? 'N/A'); ?>


                                        </a>
                                        <?php if($loop->iteration > 3): ?>

                                            <?php break; ?>

                                        <?php elseif($loop->iteration < $othercourses->count()): ?>
                                        ,<?php echo e(' '); ?>

                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($othercourses->count() > 4): ?>
                                    <span id="showcourse" onclick="showcoursePopup()" style="cursor: pointer;font-size:1.6rem;text-decoration:underline">See All</span>
                                     <?php elseif($othercourses->count() < 1): ?>
                                      N/A
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <!-- Third Column -->

                        </div>



                        <!-- Add more rows with 3 columns each as needed -->
                    </div>

                </div>

                
                <div class="sc">
                    <h2 style="background-color: lightgray;padding:6px 10px;color:black;margin:3px;margin-top:5px">
                       Classroom Facilities</h2>

                        <div class="container mt-5 custom-container" style="margin:20px">

                            <!-- Repeat the above structure for additional rows -->


                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/ac.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">AC Available

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->ac_available == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/projector.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Projector Available
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->projector_available == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>


                                <!-- Third Column -->

                            </div>
                            <!-- Repeat the above structure for additional rows -->


                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/biometric.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Biometric Available

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                        | <?php echo e($coaching->biometric_attendence == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>

                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/cctv.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">CCTV With Recording
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->cctv_with_recording == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>


                                <!-- Third Column -->

                            </div>
                            <!-- Repeat the above structure for additional rows -->
                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/audio.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Audio System
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                         | <?php echo e($coaching->audio_system_available == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>


                                <!-- Third Column -->

                            </div>

                        </div>

                </div>

                
                <div class="sc">
                    <h2 style="background-color: lightgray;padding:6px 10px;color:black;margin:3px;margin-top:5px">
                       Other Facilities</h2>

                        <div class="container mt-5 custom-container" style="margin:20px">

                            <!-- Repeat the above structure for additional rows -->


                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/hostel.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Boys Hostel

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->boys_hostel == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>

                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/hostel.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Girls Hostel

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->girls_hostel == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/transport.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Transportation
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->transport_facility == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>


                                <!-- Third Column -->

                            </div>

                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/Library13.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Library

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->library_facility == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                        </div>
                </div>

                
                <div class="sc">
                    <h2 style="background-color: lightgray;padding:6px 10px;color:black;margin:3px;margin-top:5px">
                       Study Material & Test Facilities</h2>

                        <div class="container mt-5 custom-container" style="margin:20px">

                            <!-- Repeat the above structure for additional rows -->


                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/dvd.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Study Material/Books/DVD

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->study_material == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/scholarship.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Scholarship cum Admission Test
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->scholarship_admission_process == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>


                                <!-- Third Column -->

                            </div>

                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/offline.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Offline Test

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->offline_test == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/online.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Online Test

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->online_test == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                        </div>
                </div>


                
                <div class="sc">
                    <h2 style="background-color: lightgray;padding:6px 10px;color:black;margin:3px;margin-top:5px">
                       Other Details</h2>

                        <div class="container mt-5 custom-container" style="margin:20px">

                            <!-- Repeat the above structure for additional rows -->


                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/revision.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Revision & Doubt Classes

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->doubt_and_revision_class == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/payment.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Available Modes of Payment
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->modes_of_payment ?? 'N/A'); ?>

                                        </div>
                                    </div>
                                </div>


                                <!-- Third Column -->

                            </div>

                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/batch.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Strength of Students Per Batch

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->batch_strength ?? 'N/A'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                            <div class="row" style="width:100%">
                                <!-- First Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('img/institute.png')); ?>" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Institute Management System

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | <?php echo e($coaching->institute_management_system == 1 ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                        </div>
                </div>

                    <?php if($coaching->feeStructures->count() > 0): ?>
                        <h4 class="ch__c-mc-r-sh">Fee Structure, Admission process & Enrollment -</h4>
                        <div class="tblcon">
                            <table>
                                <thead>
                                    <th>S.No.</th>
                                    <th>Course</th>
                                    <th>Course Name</th>
                                    <th>Stream</th>
                                    
                                    <th>Batch Starting Date</th>
                                    <th>Duration</th>
                                    <th>Fees</th>
                                    <th>Admission Process</th>
                                    <th>Admission Open</th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $coaching->feeStructures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $structure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key < 3): ?>
                                            <tr
                                                style="background-color: <?php echo e(($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white'); ?>;">
                                                <td><?php echo e($key + 1); ?></td>
                                                <?php if($structure->course): ?>
                                                    <td><?php echo e($structure->course['name'] ?? ''); ?></td>
                                                <?php else: ?>
                                                    N/A
                                                <?php endif; ?>
                                                <td><?php echo e($structure->course_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($structure->stream ?? 'N/A'); ?></td>
                                                
                                                <td><?php echo e($structure->batch_starting_date == null ? 'N/A' : date('d F Y', strtotime($structure->batch_starting_date))); ?>

                                                </td>
                                                <td><?php echo e($structure->course_duration ?? 'N/A'); ?></td>
                                                <td><span style="font-family: arial;">₹</span>
                                                    <?php echo e($structure->fees ?? 'N/A'); ?>

                                                </td>
                                                <td>Online/Offline</td>
                                                <td><?php if(session('user')): ?>
                                                    <a href="<?php echo e(url("onlineadmission/$coaching->id")); ?>" style="background-color:#253f94;font-size:10px;width:70px;margin-top:50%;font-weight:bold">Enroll Now</a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(url('login')); ?>" style="background-color:#253f94;font-size:10px;width:70px;margin-top:50%;font-weight:bold">Enroll Now</a>
                                                <?php endif; ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($coaching->feeStructures->count() > 3): ?>
                            <a href="<?php echo e(url('feestructure') . '/' . $coaching->slug); ?>" class="viewmore">View
                                More</a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(count($coaching->resultsAndAchivements->where('data_type', 'achivement')) > 0): ?>
                        <h4 class="ch__c-mc-r-sh">Students Achivement -</h4>
                        <div class="tblcon">
                            <table>
                                <thead>
                                    <th>S.No.</th>
                                    <th>Course</th>
                                    <th>Exam Year</th>
                                    <th>Type</th>
                                    <th>Stream</th>
                                    <th>Student Name</th>
                                    <th>Rank</th>
                                    <th>Percentage/Score</th>
                                    
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $coaching->resultsAndAchivements->where('data_type', 'achivement'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key < 3): ?>
                                            <tr
                                                style="background-color: <?php echo e(($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white'); ?>;">
                                                <td><?php echo e($key + 1); ?></td>
                                                <?php if($result->course): ?>
                                                    <td><?php echo e($result->course['name'] ?? 'N/A'); ?></td>
                                                <?php else: ?>
                                                    <td>
                                                        N/A
                                                    </td>
                                                <?php endif; ?>
                                                <td><?php echo e($result->exam_year ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->type ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->stream ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->student_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->rank ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->percentage ?? 'N/A'); ?></td>
                                                
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($coaching->resultsAndAchivements->where('data_type', 'achivement')->count() > 3): ?>
                            <a href="<?php echo e(url('results') . '/achivement' . '/' . $coaching->slug); ?>" class="viewmore">View
                                More</a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(count($coaching->resultsAndAchivements->where('data_type', 'result')) > 0): ?>
                        <h4 class="ch__c-mc-r-sh">Students Results -</h4>
                        <div class="tblcon">
                            <table>
                                <thead>
                                    <th>S.No.</th>
                                    <th>Exam Year</th>
                                    <th>Stream/Post</th>
                                    <th>Selected Students(PT)</th>
                                    <th>Selected Students(Mains)</th>
                                    <th>Selected Students(Final)</th>
                                    
                                </thead>
                                <tbody>
                                    <?php
                                        $key = 0;
                                    ?>
                                    <?php $__currentLoopData = $coaching->resultsAndAchivements->where('data_type', 'result'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key < 3): ?>
                                            <tr
                                                style="background-color: <?php echo e(($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white'); ?>;">
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($result->exam_year ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->stream ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->selected_in_pt ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->selected_in_mains ?? 'N/A'); ?></td>
                                                <td><?php echo e($result->selected_in_final ?? 'N/A'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php
                                            $key++;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($coaching->resultsAndAchivements->where('data_type', 'result')->count() > 3): ?>
                            <a href="<?php echo e(url('results') . '/result' . '/' . $coaching->slug); ?>" class="viewmore">View
                                More</a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(count($coaching->faculties) > 0): ?>
                        <h4 class="ch__c-mc-r-sh">Faculties -</h4>
                        <div class="tblcon">
                            <table>
                                <thead>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Specialization In</th>
                                    <th>University</th>
                                    <th>College</th>
                                    <th>Experience (in years)</th>
                             
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $coaching->faculties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faculty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key < 3): ?>
                                            <tr
                                                style="background-color: <?php echo e(($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white'); ?>;">
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($faculty->name ?? 'N/A'); ?></td>
                                                <td><?php echo e($faculty->designation ?? 'N/A'); ?></td>
                                                <td><?php echo e($faculty->specialization_on ?? 'N/A'); ?></td>
                                                <td><?php echo e($faculty->university ?? 'N/A'); ?></td>
                                                <td><?php echo e($faculty->college ?? 'N/A'); ?></td>
                                                <td><?php echo e($faculty->experience_in_years ?? 'N/A'); ?></td>
                                                    
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($coaching->faculties->count() > 3): ?>
                            <a href="<?php echo e(url('faculties') . '/' . $coaching->slug); ?>" class="viewmore">View
                                More</a>
                        <?php endif; ?>
                    <?php endif; ?>


                    <h4 class="ch__c-mc-r-sh">About <?php echo e($coaching->name); ?> | Facility | Classrooms -</h4>
                     <br>

                     <?php if($coaching->youtube_video_link != null): ?>
                     <div class="video-container">
                         <iframe width="560" height="315" src="<?php echo e($coaching->youtube_video_link); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                     </div>
                 <?php endif; ?> 
                   <p class="ch__c-mc-r-p"><?php echo e($coaching->about); ?></p>
                    <div class="row justify-content-between align-items-center">
                        <h4 class="ch__c-mc-r-sh">Rating & Reviews -</h4>
                        <?php if(auth()->user()): ?>
                            <a href="<?php echo e(url("write-review/$coaching->slug")); ?>" class="cta">Write Review</a>
                        <?php else: ?>
                            <a href="<?php echo e(url('login')); ?>" class="cta">Login to Write Review</a>
                        <?php endif; ?>
                    </div>
                    <?php //echo "<pre>"; //print_r($coaching->reviews);
                    // foreach($coaching->reviews as $reviews)
                    // {

                    //     $reviewCount[$reviews->overall_rating][] = $reviews->overall_rating;
                    // }
                    // print_r($reviewCount);
                    ?>
                    <?php if($coaching->reviews->count() > 0): ?>
                        <div class="review">
                            <div class="review__count">
                                <div class="review__count-l">
                                    <div class="review__count-ar">
                                        <h3><?php echo e(round($coaching->reviews->sum('overall_rating') / $coaching->reviews->count(), 1)); ?>

                                            <i class="fa fa-star"></i>
                                        </h3>
                                        <p>Average Rating</p>
                                        <p>By</p>
                                        <p><?php echo e($coaching->reviews->count()); ?> people</p>
                                    </div>
                                    <div class="review__count-rb">
                                        <div class="review__count-rb-i">
                                            <p>5</p><i class="fa fa-star"></i>
                                            <div class="bar">
                                                <div style="width:60%;"></div>
                                            </div>
                                            60 %
                                        </div>
                                        <div class="review__count-rb-i">
                                            <p>4</p><i class="fa fa-star"></i>
                                            <div class="bar">
                                                <div style="width:30%;"></div>
                                            </div>
                                            30 %
                                        </div>
                                        <div class="review__count-rb-i">
                                            <p>3</p> <i class="fa fa-star"></i>
                                            <div class="bar">
                                                <div style="width:45%;"></div>
                                            </div>
                                            45 %
                                        </div>
                                        <div class="review__count-rb-i">
                                            <p>2</p> <i class="fa fa-star"></i>
                                            <div class="bar">
                                                <div style="width:35%;"></div>
                                            </div>
                                            35 %
                                        </div>
                                        <div class="review__count-rb-i">
                                            <p>1</p> <i class="fa fa-star"></i>
                                            <div class="bar">
                                                <div style="width:10%;background-color:red;"></div>
                                            </div>
                                            10 %
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $fee_ratings = round($coaching->reviews->sum('stars_fees') / $coaching->reviews->count(), 1);
                                    $faculty_ratings = round($coaching->reviews->sum('stars_faculties') / $coaching->reviews->count(), 1);
                                    $material_ratings = round($coaching->reviews->sum('stars_study_materials') / $coaching->reviews->count(), 1);
                                    $result_ratings = round($coaching->reviews->sum('stars_results') / $coaching->reviews->count(), 1);
                                ?>
                                <div class="review__count-r">
                                    <div class="review__count-avgitem">
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green <?php echo e(($fee_ratings / 5) * 360); ?>deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p><?php echo e($fee_ratings); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Fees</p>
                                        </div>
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green <?php echo e(($faculty_ratings / 5) * 360); ?>deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p><?php echo e($faculty_ratings); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Faculty</p>
                                        </div>
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green <?php echo e(($material_ratings / 5) * 360); ?>deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p><?php echo e($material_ratings); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Study Materials</p>
                                        </div>
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green <?php echo e(($result_ratings / 5) * 360); ?>deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p><?php echo e($result_ratings); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Results</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review__review">
                                <?php $__currentLoopData = $coaching->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="review__review-i">
                                        <div class="reviewer">
                                            <div class="star">
                                                <p><?php echo e($review->overall_rating); ?></p><i class="fa fa-star"></i>
                                            </div>
                                            <p><?php echo e($review->user->name ?? ''); ?></p>
                                        </div>
                                        <p class="rtxt"><?php echo e($review->review); ?></p>
                                        <div class="cred">
                                            <p>Verified User</p><i class="fa fa-shield"></i>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h4 class="ch__c-mc-r-sh">Connect us on -</h4>
                    <div class="ch__c-mc-r-cc">
                        
                           <div class="od">
                            <div class="em">
                                <p>Email</p>
                                <a href="mailto:<?php echo e($coaching->email); ?>">
                                    <span class="material-icons">email</span>
                                </a>
                            </div>
                            <div class="links">
                                <p>Connect us</p>
                                <div class="lc">
                                    <?php if($coaching->website): ?>
                                        <a href="<?php echo e($coaching->website); ?>" target="_blank">
                                            <div class="fa fa-globe"></div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($coaching->facebook_link): ?>
                                        <a href="<?php echo e($coaching->facebook_link); ?>" target="_blank">
                                           <i class="fab fa-facebook" aria-hidden="true"></i>
                                           
                                        </a>
                                    <?php endif; ?>
                                    <?php if($coaching->youtube_link): ?>
                                        <a href="<?php echo e($coaching->youtube_link); ?>" target="_blank">
                                            <div class="fab fa-youtube"></div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($coaching->twitter_link): ?>
                                        <a href="<?php echo e($coaching->twitter_link); ?>" target="_blank">
                                            <div class="fab fa-twitter"></div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="comparewidget">
        <a href="<?php echo e(url('compare')); ?>" class="comparewidget__a">
            <div class="comparewidget__c">
                <p>Compare</p>
                <span class="comparewidget__c-count">1</span>
            </div>
        </a>
        <div class="comparewidget__ic">
            <div class="comparewidget__ic-cc">
                
            </div>
            <div class="remove">Remove All</div>
        </div>
    </div>


   <script>
        var images = <?php echo json_encode($images); ?>

    </script>
    <div class="imgcarousel" style="display: none;">
        <span class="imgcarousel__close" onclick="closeViewImage()">X</span>
        <span class="imgcarousel__prev" onclick="showPrevImage()"><i class="fa fa-chevron-left"></i></span>
        <div class="imgcarousel__c">
            <img src="" class="imgcarousel__c-img">
        </div>
        <span class="imgcarousel__next" onclick="showNextImage()"><i class="fa fa-chevron-right"></i></span>
    </div>

<?php $__env->stopSection(); ?>
<script>
    function showcoursePopup() {
  var popup = document.getElementById("popupMenu");

  if(popup.style.display=="block"){
    popup.style.display="none";
  }
  else
  popup.style.display="block";
}

</script>
<script>
    function showPopup() {
        var popupContainer = document.getElementById("popupContainer");
        // Show the popup
        popupContainer.style.display = "block";

        // Close the popup when clicked outside of it
        window.addEventListener("click", function(event) {
            if (event.target === popupContainer) {
                popupContainer.style.display = "none";
            }
        });
    }
    function closeShow(){
        var popupContainer = document.getElementById("popupContainer");
        popupContainer.style.display = "none";

    }
</script>

<?php echo $__env->make('layouts.coachingHeader', ['slug' => $coaching->slug], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/coaching.blade.php ENDPATH**/ ?>