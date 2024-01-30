<?php $__env->startSection('content'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="<?php echo e(url('dashboard/insertcoaching')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="crcoaching__c-l">
                    <div class="form">
                        <h5>Add New Coaching</h5>
                        <div class="fr">
                            <div class="fi">
                                <label for="coachingname">Name *</label>
                                <input type="text" name="name" id="coachingname" required>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="cities">City *</label>
                                <select name="cities" id="cityDropdown">
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="main_course_id" id="courses" required>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                           
                      <div class="fr">
                            <div class="fi">
                                <label for="localities">Locality</label>
                                <input type="hidden" id="selectedCity" value="<?php echo e($city->id); ?>">
                                <select name="locality[]" multiple="true" id="localityDropdown" class="select-multiple">
                                    <option value="">Select Locality</option>
                                    <?php $__currentLoopData = $localities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <option value="<?php echo e($locality->id); ?>"><?php echo e($locality->name); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <script>
                            // JavaScript to update the locality dropdown based on the selected city
                            var cityDropdown = document.getElementById('cityDropdown');
                            var localityDropdown = document.getElementById('localityDropdown');
                            var selectedCityInput = document.getElementById('selectedCity');

                            var selectedCity = selectedCityInput.value;

                            cityDropdown.addEventListener('change', function() {
                                selectedCity = this.value;
                                selectedCityInput.value = selectedCity;
                                updateLocalityDropdown(selectedCity);
                            });

                            function updateLocalityDropdown(selectedCity) {
                                localityDropdown.innerHTML = '<option value="">Select Locality</option>';

                                // Filter and sort localities by name
                                var filteredLocalities = <?php echo json_encode($localities); ?>.filter(function(locality) {
                                    return locality.city == selectedCity;
                                });

                                // Sort localities by name
                                filteredLocalities.sort(function(a, b) {
                                    return a.name.localeCompare(b.name);
                                });

                                // Add sorted localities to the dropdown
                                filteredLocalities.forEach(function(locality) {
                                    var option = document.createElement('option');
                                    option.value = locality.id;
                                    option.text = locality.name;
                                    localityDropdown.appendChild(option);
                                });
                                var othersOption = document.createElement('option');
                                othersOption.value = 'others';
                                othersOption.text = 'Others';
                                localityDropdown.appendChild(othersOption);
                            }


                            // Initial call to populate the dropdown when the page loads
                            updateLocalityDropdown(selectedCity);
                        </script>                             
                    

                        <div class="fr">
                            <div class="fi">
                                <label for="category">Course Type *</label>
                                <select name="categories[]" multiple="true" id="categories" class="select-multiple">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                             <div class="fr">
                        <div class="fi">
                            <label for="library">Top Coachings ?</label>
                            <select name="topcoachings" id="topcoachings" required>
                                
                                <option value="0">No</option>
                               <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="streams">Streams</label>
                                <input type="text" name="streams" id="streams">
                            </div>
                            <div class="fi">
                                <label for="email">Email (Leave empty if not found)</label>
                                <input type="email" name="email" id="email">
                            </div>

                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" maxlength="24" name="phone" id="phone" required>
                            </div>
                            <div class="fi">
                                <label for="altphone">Alternate Phone Number</label>
                                <input type="tel" maxlength="24" name="alternate_phone" id="altphone">
                            </div>
                        </div>
                         <div class="fr">
                 <div class="fi">
              <label for="landline">WhatsApp Number</label>
               <input type="text" name="whatsapp_number" id="landline">
                 </div>
            <div class="fi">
              <label for="landline">Landline Number</label>
           <input type="text" name="landline_number" id="landline">
             </div>

                </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="landmark">Landmark</label>
                                <input type="text" name="landmark" id="landmark">
                            </div>
                            <div class="fi">
                                <label for="address">Address *</label>
                                <input type="text" name="address" id="address" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="district">District *</label>
                                <input type="text" name="district" id="district">
                            </div>
                            <div class="fi">
                                <label for="state">State *</label>
                                <input type="text" name="state" id="state" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="country">Country *</label>
                                <input type="text" name="country" id="country" required>
                            </div>
                            <div class="fi">
                                <label for="pincode">Pincode *</label>
                                <input type="number" max="999999" maxlength="6" name="pincode" id="pincode" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="latitude">Latitude *(take it from google map)</label>
                                <input type="text" name="latitude" id="latitude">
                            </div>
                            <div class="fi">
                                <label for="longitude">Longitude *(take it from google map)</label>
                                <input type="text" name="longitude" id="longitude">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="website">Website (Leave empty if not found)</label>
                                <input type="url" name="website" id="website">
                            </div>
                            <div class="fi">
                                <label for="facebook">Facebook Link (Leave empty if not found)</label>
                                <input type="url" name="facebook_link" id="facebook">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="youtube">Youtube Link (Leave empty if not found)</label>
                                <input type="url" name="youtube_link" id="youtube">
                            </div>
                            <div class="fi">
                                <label for="twitter">Twitter Link (Leave empty if not found)</label>
                                <input type="url" name="twitter_link" id="twitter">
                            </div>
                        </div>

                              <div class="fr">
                            <div class="fi">

                                <label for="youtube_video_link">YouTube Video Link</label>
                                <input type="text" name="youtube_video_link" id="youtube_video_link">
                            </div>
                        </div>

                           
                        <div class="fr">
                            <div class="fi">
                                <label for="test">Scholarship cum admission process test</label>
                                <select name="scholarship_admission_process" id="test" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>                            
                            <div class="fi">
                                <label for="status">Coaching/Institute Status</label>
                                
                                <select name="institute_status" id="status" required>
                                    <option value="Pvt. Ltd.">Pvt. Ltd.</option>
                                    <option value="trust">Trust</option>
                                    <option value="Society">Society</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Proprietorship ">Proprietorship</option>
                                    <option value="State govt. Reg.">State govt. Reg.</option>
                                    <option value="Others">Others</option>
                                </select>

                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="establishment">Establishment</label>
                                <input type="text" name="establishment" id="establishment">
                            </div>
                            <div class="fi">
                                <label for="branches">Total Branches</label>
                                <input type="number" maxlength="6" name="total_branches" id="branches">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="head">Head of Organisation</label>
                                <input type="text" name="head_organisation" id="head">
                            </div>
                             <div class="fi">
                                <label for="strength">Batch Strength</label>
                                <input type="text" name="batch_strength" id="strength" >
                            </div>
                            
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="doubt">Revision & Doubt Classes *</label>
                                <select name="doubt_classes" id="doubt" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="library">Library Facility *</label>
                                <select name="library_facility" id="library" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                          

                        <div class="fr">

                            <div class="fi">
                                <label for="hostel">Boys Hostel *</label>
                                <select name="boys_hostel" id="hostel" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="hostel">Girls Hostel *</label>
                                <select name="girls_hostel" id="hostel" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="area">Total Area</label>
                                <input type="text" name="total_area" id="area">
                            </div>
                            <div class="fi">
                                <label for="payment">Available Modes Of Payment</label>
                                <input type="text" name="modes_of_payment"
                                    value="Cash/DD/Online Transfer/Debit and credit card/Paytm & Other" id="payment">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ac">AC Available</label>
                                <select name="ac_available" id="ac" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="pa">Projector Available</label>
                                <select name="projector_available" id="pa" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="at">Biometric Attendence</label>
                                <select name="biometric_attendence" id="at" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="cctv">CCTV with recording</label>
                                <select name="cctv_with_recording" id="cctv" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="audio">Audio System Available</label>
                                <select name="audio_system_available" id="audio" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="oftest">Offline Test</label>
                                <select name="offline_test" id="oftest" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            
                             <div class="fi">
                                <label for="test">Institute management system</label>
                                <select name="institute_management_system" id="test" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div> 
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ctest">Class Test</label>
                                <select name="class_test" id="ctest" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="otest">Online Test</label>
                                <select name="online_test" id="otest" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="transport">Transport Facility *</label>
                                <select name="transport_facility" id="transport" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="st">Providing Study Material</label>
                                <select name="study_material" id="st" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="tandc">Term & Condition</label>
                                <textarea name="tandc" id="tandc" cols="30" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="about">About * </label>
                                <textarea name="about" id="about" cols="30" rows="6" required></textarea>
                            </div>
                        </div>

                       <?php echo $__env->make('dashboard.coaching.working_hours', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('dashboard.coaching.result', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('dashboard.coaching.results', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('dashboard.coaching.faculty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('dashboard.coaching.feestructure', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                    
                </div>
                <div class="crcoaching__c-r">
                    <div class="btn__c">
                        <button type="submit" class="btn__c-btn">Add Coaching</button>
                    </div>
                    <h2>Images</h2>
                    <div class="di">
                        <img src="<?php echo e(asset('assets/img_placeholder.png')); ?>"
                            style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Thumbnail</label>
                    <div class="lic">
                        <img src="<?php echo e(asset('assets/img_placeholder.png')); ?>"
                            style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="logo" id="logo" required>
                    <label for="logo">Logo</label>
                    <div class="gc"></div>
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
                    $('.gc').append(`
                        <div class="img__c">
                            <a onclick="removeGalleryImage(this)">
                                <div class="remove">
                                    <span>X</span>
                                </div>
                            </a>
                            <img src="${re.target.result}" alt="">
                        </div>
                    `);
                }
                reader.readAsDataURL(element)

            });
        });


        function removeGalleryImage(e) {
            e.parentNode.remove();
        }

        window.onload = () => {
            $(document).ready(function() {
                $('.select-multiple').select2({
                    //   theme:"classic"
                });
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\asus\Downloads\cd\resources\views/dashboard/coaching/create.blade.php ENDPATH**/ ?>