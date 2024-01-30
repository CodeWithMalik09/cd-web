<?php $__env->startSection('content'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="<?php echo e(url('dashboard/updatecoaching')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($coaching->id); ?>">
                <div class="crcoaching__c-l">
                    <div class="form">
                        <h5>Edit Coaching</h5>
                        <div class="fr">
                            <div class="fi">
                                <label for="coachingname">Name *</label>
                                <input type="text" name="name" value="<?php echo e($coaching->name); ?>" id="coachingname"
                                    required>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="city">City *</label>
                                <select name="cities[]" id="cityDropdown">
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($coaching->cities != null && in_array($city->id, json_decode($coaching->cities) ?? [])): ?>
                                            <option value="<?php echo e($city->id); ?>" selected><?php echo e($city->name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="main_course_id" id="courses" required>
                                    <option disabled selected>Select Main Course</option>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($coaching->main_course_id != null && $course->id == $coaching->main_course_id): ?>
                                            <option value="<?php echo e($course->id); ?>" selected><?php echo e($course->name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="localities">Locality</label>
                                <input type="hidden" id="selectedCity" value="<?php echo e($city->id); ?>">
                                <select name="locality[]" multiple="true" id="localityDropdown" class="select-multiple">
                                    <?php $__currentLoopData = $currentLocalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($coaching->locality != null && in_array($loc->id, json_decode($coaching->locality) ?? [])): ?>
                                            <option value="<?php echo e($loc->id); ?>" selected><?php echo e($loc->name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($loc->id); ?>"><?php echo e($loc->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php if($coaching->locality != null && in_array('others', json_decode($coaching->locality) ?? [])): ?>
                                        <option value="others" selected>Others</option>
                                    <?php else: ?>
                                        <option value="others">Others</option>
                                    <?php endif; ?>
                                </select>                           
                            </div>
                        </div>

                        


                        <div class="fr">
                            <div class="fi">
                                <label for="category">Course Type *</label>
                                <select name="categories[]" multiple="multiple" id="categories" class="select-multiple">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($coaching->categories != null && in_array($category->id, json_decode($coaching->categories) ?? [])): ?>
                                            <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                              <div class="fr">
                            <div class="fi">
                                <label for="library">Top Coachings ?</label>
                                <select name="topcoachings" id="topcoachings" required>
                                    <?php if($coaching->topcoachings): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                                                    

                        <div class="fr">
                            <div class="fi">
                                <label for="streams">Streams</label>
                                <input type="text" name="streams" id="streams" value="<?php echo e($coaching->streams); ?>">
                            </div>
                            <div class="fi">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="<?php echo e($coaching->email); ?>" id="email">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" maxlength="24" name="phone" value="<?php echo e($coaching->phone); ?>"
                                    id="phone" required>
                            </div>
                            <div class="fi">
                                <label for="altphone">Alternate Phone Number</label>
                                <input type="tel" maxlength="24" name="alternate_phone"
                                    value="<?php echo e($coaching->alternate_phone); ?>" id="altphone">
                            </div>
                        </div>

                   <div class="fr">
                 <div class="fi">
              <label for="landline">WhatsApp Number</label>
               <input type="text" name="whatsapp_number" value="<?php echo e($coaching->whatsapp_no); ?>" id="whatsapp">
                 </div>
            <div class="fi">
              <label for="landline">Landline Number</label>
           <input type="text" name="landline_number" value="<?php echo e($coaching->landline_number); ?>" id="landline">
             </div>

                </div>


                        <div class="fr">
                              <div class="fi">
                                <label for="landmark">Landmark</label>
                                <input type="text" name="landmark" value="<?php echo e($coaching->landmark); ?>" id="landmark">
                            </div>                            
                         <div class="fi">
                                <label for="address">Address </label>
                                <input type="text" name="address" value="<?php echo e($coaching->address); ?>" id="address">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="district">District *</label>
                                <input type="text" name="district" value="<?php echo e($coaching->district); ?>" id="district">
                            </div>
                            <div class="fi">
                                <label for="state">State *</label>
                                <input type="text" name="state" value="<?php echo e($coaching->state); ?>" id="state"
                                    required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="country">Country *</label>
                                <input type="text" name="country" value="<?php echo e($coaching->country); ?>" id="country"
                                    required>
                            </div>
                            <div class="fi">
                                <label for="pincode">Pincode *</label>
                                <input type="number" max="999999" maxlength="6" name="pincode"
                                    value="<?php echo e($coaching->pincode); ?>" id="pincode" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" value="<?php echo e($coaching->latitude); ?>" id="latitude">
                            </div>
                            <div class="fi">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" value="<?php echo e($coaching->longitude); ?>"
                                    id="longitude">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="website">Website</label>
                                <input type="url" name="website" value="<?php echo e($coaching->website); ?>" id="website">
                            </div>
                            <div class="fi">
                                <label for="facebook">Facebook Link</label>
                                <input type="url" name="facebook_link" value="<?php echo e($coaching->facebook_link); ?>"
                                    id="facebook">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="youtube">Youtube Link</label>
                                <input type="url" name="youtube_link" value="<?php echo e($coaching->youtube_link); ?>"
                                    id="youtube">
                            </div>
                            <div class="fi">
                                <label for="twitter">Twitter Link</label>
                                <input type="url" name="twitter_link" value="<?php echo e($coaching->twitter_link); ?>"
                                    id="twitter">
                            </div>
                        </div>

                            <div class="fr">
                            <div class="fi">

                                <label for="youtube_video_link">YouTube Video Link</label>
                                <input type="text" name="youtube_video_link" id="youtube_video_link" value="<?php echo e($coaching->youtube_video_link); ?>">
                            </div>
                        </div>


                        <div class="fr">
                          <div class="fi">
                                <label for="test">Scholarship cum admission process test</label>
                                <select name="scholarship_admission_process" id="test" required>
                                    <?php if($coaching->scholarship_admission_process): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>                            
                            <div class="fi">
                                <label for="status">Coaching/Institute Status</label>
                                
                                <?php
                                    $status_type = ['Pvt. Ltd.', 'Trust', 'Society', 'Partnership', 'Proprietorship', 'State govt. Reg.', 'others'];
                                ?>
                                <select name="institute_status" id="status" required>
                                    <?php $__currentLoopData = $status_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($status == $coaching->institute_status): ?>
                                            <option value="<?php echo e($status); ?>" selected><?php echo e($status); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($status); ?>"><?php echo e($status); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="establishment">Establishment</label>
                                <input type="text" name="establishment" value="<?php echo e($coaching->establishment); ?>"
                                    id="establishment">
                            </div>
                            <div class="fi">
                                <label for="branches">Total Branches</label>
                                <input type="number" maxlength="6" name="total_branches"
                                    value="<?php echo e($coaching->total_branches); ?>" id="branches">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="head">Head Organisation</label>
                                <input type="text" name="head_organisation"
                                    value="<?php echo e($coaching->head_organisation); ?>" id="head">
                            </div>
                            
                             <div class="fi">
                                <label for="strength">Batch Strength</label>
                                <input type="text" name="batch_strength" value="<?php echo e($coaching->batch_strength); ?>"
                                    id="strength">
                            </div> 
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="doubt">Revision & Doubt Classes *</label>
                                <select name="doubt_classes" id="doubt" required>
                                    <?php if($coaching->doubt_and_revision_class): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="library">Library Facility *</label>
                                <select name="library_facility" id="library" required>
                                    <?php if($coaching->library_facility): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="fr">

                            <div class="fi">
                                <label for="hostel">Girls Hostel *</label>
                                <select name="girls_hostel" id="hostel" required>
                                    <?php if($coaching->girls_hostel): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="hostel">Hostel Facility *</label>
                                <select name="boys_hostel" id="hostel" required>
                                    <?php if($coaching->boys_hostel): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="area">Total Area</label>
                                <input type="text" name="total_area" value="<?php echo e($coaching->total_area); ?>"
                                    id="area">
                            </div>
                            <div class="fi">
                                <label for="payment">Available Modes Of Payment</label>
                                <input type="text" name="modes_of_payment" value="<?php echo e($coaching->modes_of_payment); ?>"
                                    id="payment">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ac">AC Available</label>
                                <select name="ac_available" id="ac" required>
                                    <?php if($coaching->ac_available): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="pa">Projector Available</label>
                                <select name="projector_available" id="pa" required>
                                    <?php if($coaching->projector_available): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="at">Biometric Attendence</label>
                                <select name="biometric_attendence" id="at" required>
                                    <?php if($coaching->biometric_attendence): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="cctv">CCTV with recording</label>
                                <select name="cctv_with_recording" id="cctv" required>
                                    <?php if($coaching->cctv_with_recording): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="audio">Audio System Available</label>
                                <select name="audio_system_available" id="audio" required>
                                    <?php if($coaching->audio_system_available): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="oftest">Offline Test</label>
                                <select name="offline_test" id="oftest" required>
                                    <?php if($coaching->offline_test): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            
                             <div class="fi">
                                <label for="test">Institute management system</label>
                                <select name="institute_management_system" id="test" required>
                                    <?php if($coaching->institute_management_system): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div> 
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ctest">Class Test</label>
                                <select name="class_test" id="ctest" required>
                                    <?php if($coaching->class_test): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="otest">Online Test</label>
                                <select name="online_test" id="otest" required>
                                    <?php if($coaching->online_test): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="transport">Transport Facility *</label>
                                <select name="transport_facility" id="transport" required>
                                    <?php if($coaching->transport_facility): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="st">Providing Study Material</label>
                                <select name="study_material" id="st" required>
                                    <?php if($coaching->study_material): ?>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    <?php else: ?>
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="tandc">Term & Condition * </label>
                                <textarea name="tandc" id="tandc" cols="30" rows="6"><?php echo e($coaching->tandc); ?></textarea>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="about">About * </label>
                                <textarea name="about" id="about" cols="30" rows="6"><?php echo e($coaching->about); ?></textarea>
                            </div>
                        </div>
                            <?php echo $__env->make('dashboard.coaching.working_hours', ['working_hours' => $coaching->working_hours], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('dashboard.coaching.result', [
                            'results' => $coaching->resultsAndAchivements->where('data_type','achivement'),
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('dashboard.coaching.results', [
                            'results' => $coaching->resultsAndAchivements->where('data_type','result'),
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('dashboard.coaching.faculty', ['faculties' => $coaching->faculties], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('dashboard.coaching.feestructure', ['fees' => $coaching->feeStructures], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                </div>
                <div class="crcoaching__c-r">
                    <div class="btn__c">
                        <button type="submit" class="btn__c-btn">Update Coaching</button>
                    </div>

                    <h2>Images</h2>
                    <div class="di">
                        <?php if($coaching->thumbnail): ?>
                            <img src="<?php echo e(url('storage') . '/' . $coaching->thumbnail); ?>" id="thumbnail-view">
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/img_placeholder.png')); ?>"
                                style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                        <?php endif; ?>
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Thumbnail</label>
                    <div class="lic">
                        <?php if($coaching->logo): ?>
                            <img src="<?php echo e(url('storage') . '/' . $coaching->logo); ?>" id="thumbnail-view">
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/img_placeholder.png')); ?>"
                                style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                        <?php endif; ?>
                    </div>
                    <input type="file" name="logo" id="logo">
                    <label for="logo">Logo</label>
                    <div class="gc">
                        <?php if($coaching->galleries->count() > 0): ?>
                            <?php $__currentLoopData = $coaching->galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="img__c">
                                    <a href="<?php echo e(url("dashboard/delete-coaching-gallery-image/$img->id")); ?>">
                                        <div class="remove">
                                            <span>X</span>
                                        </div>
                                    </a>
                                    <img src="<?php echo e(url('storage') . '/' . $img->image); ?>" alt="">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <input type="file" name="gallery[]" multiple id="gallery">
                    <label for="gallery">Add Gallery</label>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#logo').change((e) => {
            let reader = new FileReader();
            reader.onload = (re) => {
                $('.lic').empty()
                $('.lic').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        })
        $('#thumbnail').change((e) => {
            $('.di').empty()
            let reader = new FileReader();
            reader.onload = (re) => {
                $('.di').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        })
        $('#gallery').change((e) => {
            Array.from(e.target.files).forEach(element => {
                console.log(element);
                let reader = new FileReader();
                reader.onload = (re) => {
                    // $('.gc').append(`<img src="${re.target.result}"/>`);
                    $('.gc').append(
                        `
                        <div class="img__c">
                            <a onclick="removeGalleryImage(this)">
                                <div class="remove">
                                    <span>X</span>
                                </div>
                            </a>
                            <img src="${re.target.result}" alt="">
                        </div>
                        `
                    )
                }
                reader.readAsDataURL(element)

            });
        });

        function removeGalleryImage(e) {
            e.parentNode.remove();
        }

        window.onload = () => {
            $(document).ready(function() {
                $('.select-multiple').select2({});
            });

        }

        // JavaScript to update the locality dropdown based on the selected city
        var cityDropdown = document.getElementById('cityDropdown');
        var localityDropdown = document.getElementById('localityDropdown');
        var selectedCityInput = document.getElementById('selectedCity');


        var selectedCity = selectedCityInput.value;

        $('#cityDropdown').on('change', function() {
            selectedCity = this.value;
            selectedCityInput.value = selectedCity;
            $("#localityDropdown").val(null).trigger("change"); 
            $("#localityDropdown").html('');
            updateLocalityDropdown(selectedCity);
        });

function updateLocalityDropdown(selectedCity) {
    // Clear the existing options
    localityDropdown.innerHTML = '';

    // Add options based on selected city
    <?php $__currentLoopData = $localities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        if (<?php echo e($locality->city); ?> == selectedCity) {
            var option = document.createElement('option');
            option.value = "<?php echo e($locality->id); ?>";
            option.text = "<?php echo e($locality->name); ?>";
            localityDropdown.appendChild(option);
        }
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    // Add the "Others" option at the end
    var othersOption = document.createElement('option');
    othersOption.value = "others";
    othersOption.text = "Others";
    localityDropdown.appendChild(othersOption);
}

        // updateLocalityDropdown(selectedCity);
        
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/coaching/edit.blade.php ENDPATH**/ ?>