@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crcoaching">
        <div class="crcoaching__c">
            <form action="{{ url('dashboard/updatecoaching') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $coaching->id }}">
                <div class="crcoaching__c-l">
                    <div class="form">
                        <h5>Edit Coaching</h5>
                        <div class="fr">
                            <div class="fi">
                                <label for="coachingname">Name *</label>
                                <input type="text" name="name" value="{{ $coaching->name }}" id="coachingname"
                                    required>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="city">City *</label>
                                <select name="cities[]" id="cityDropdown">
                                    @foreach ($cities as $city)
                                        @if ($coaching->cities != null && in_array($city->id, json_decode($coaching->cities) ?? []))
                                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                        @else
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="fi">
                                <label for="courses">Course *</label>
                                <select name="main_course_id" id="courses" required>
                                    <option disabled selected>Select Main Course</option>
                                    @foreach ($courses as $course)
                                        @if ($coaching->main_course_id != null && $course->id == $coaching->main_course_id)
                                            <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                        @else
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="localities">Locality</label>
                                <input type="hidden" id="selectedCity" value="{{ $city->id }}">
                                <select name="locality[]" multiple="true" id="localityDropdown" class="select-multiple">
                                    @foreach($currentLocalities as $loc)
                                        @if ($coaching->locality != null && in_array($loc->id, json_decode($coaching->locality) ?? []))
                                            <option value="{{ $loc->id }}" selected>{{ $loc->name }}</option>
                                        @else
                                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                                        @endif
                                    @endforeach
                                    
                                    @if ($coaching->locality != null && in_array('others', json_decode($coaching->locality) ?? []))
                                        <option value="others" selected>Others</option>
                                    @else
                                        <option value="others">Others</option>
                                    @endif
                                </select>                           
                            </div>
                        </div>

                        {{-- <div class="fr">
                            <div class="fi">
                                <label for="courses">Courses *</label>
                                <select name="courses[]" multiple id="courses" class="select-multiple">
                                    @foreach ($courses as $course)
                                        @if ($coaching->courses != null && in_array($course->id, json_decode($coaching->courses) ?? []))
                                            <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                        @else
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}


                        <div class="fr">
                            <div class="fi">
                                <label for="category">Course Type *</label>
                                <select name="categories[]" multiple="multiple" id="categories" class="select-multiple">
                                    @foreach ($categories as $category)
                                        @if ($coaching->categories != null && in_array($category->id, json_decode($coaching->categories) ?? []))
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                              <div class="fr">
                            <div class="fi">
                                <label for="library">Top Coachings ?</label>
                                <select name="topcoachings" id="topcoachings" required>
                                    @if ($coaching->topcoachings)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                                                    

                        <div class="fr">
                            <div class="fi">
                                <label for="streams">Streams</label>
                                <input type="text" name="streams" id="streams" value="{{ $coaching->streams }}">
                            </div>
                            <div class="fi">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{ $coaching->email }}" id="email">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" maxlength="24" name="phone" value="{{ $coaching->phone }}"
                                    id="phone" required>
                            </div>
                            <div class="fi">
                                <label for="altphone">Alternate Phone Number</label>
                                <input type="tel" maxlength="24" name="alternate_phone"
                                    value="{{ $coaching->alternate_phone }}" id="altphone">
                            </div>
                        </div>

                   <div class="fr">
                 <div class="fi">
              <label for="landline">WhatsApp Number</label>
               <input type="text" name="whatsapp_number" value="{{$coaching->whatsapp_no}}" id="whatsapp">
                 </div>
            <div class="fi">
              <label for="landline">Landline Number</label>
           <input type="text" name="landline_number" value="{{$coaching->landline_number}}" id="landline">
             </div>

                </div>


                        <div class="fr">
                              <div class="fi">
                                <label for="landmark">Landmark</label>
                                <input type="text" name="landmark" value="{{$coaching->landmark}}" id="landmark">
                            </div>                            
                         <div class="fi">
                                <label for="address">Address </label>
                                <input type="text" name="address" value="{{ $coaching->address }}" id="address">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="district">District *</label>
                                <input type="text" name="district" value="{{ $coaching->district }}" id="district">
                            </div>
                            <div class="fi">
                                <label for="state">State *</label>
                                <input type="text" name="state" value="{{ $coaching->state }}" id="state"
                                    required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="country">Country *</label>
                                <input type="text" name="country" value="{{ $coaching->country }}" id="country"
                                    required>
                            </div>
                            <div class="fi">
                                <label for="pincode">Pincode *</label>
                                <input type="number" max="999999" maxlength="6" name="pincode"
                                    value="{{ $coaching->pincode }}" id="pincode" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" value="{{ $coaching->latitude }}" id="latitude">
                            </div>
                            <div class="fi">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" value="{{ $coaching->longitude }}"
                                    id="longitude">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="website">Website</label>
                                <input type="url" name="website" value="{{ $coaching->website }}" id="website">
                            </div>
                            <div class="fi">
                                <label for="facebook">Facebook Link</label>
                                <input type="url" name="facebook_link" value="{{ $coaching->facebook_link }}"
                                    id="facebook">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="youtube">Youtube Link</label>
                                <input type="url" name="youtube_link" value="{{ $coaching->youtube_link }}"
                                    id="youtube">
                            </div>
                            <div class="fi">
                                <label for="twitter">Twitter Link</label>
                                <input type="url" name="twitter_link" value="{{ $coaching->twitter_link }}"
                                    id="twitter">
                            </div>
                        </div>

                            <div class="fr">
                            <div class="fi">

                                <label for="youtube_video_link">YouTube Video Link</label>
                                <input type="text" name="youtube_video_link" id="youtube_video_link" value="{{$coaching->youtube_video_link}}">
                            </div>
                        </div>


                        <div class="fr">
                          <div class="fi">
                                <label for="test">Scholarship cum admission process test</label>
                                <select name="scholarship_admission_process" id="test" required>
                                    @if ($coaching->scholarship_admission_process)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>                            
                            <div class="fi">
                                <label for="status">Coaching/Institute Status</label>
                                {{-- <input type="text" name="institute_status" id="status"> --}}
                                @php
                                    $status_type = ['Pvt. Ltd.', 'Trust', 'Society', 'Partnership', 'Proprietorship', 'State govt. Reg.', 'others'];
                                @endphp
                                <select name="institute_status" id="status" required>
                                    @foreach ($status_type as $status)
                                        @if ($status == $coaching->institute_status)
                                            <option value="{{ $status }}" selected>{{ $status }}</option>
                                        @else
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="establishment">Establishment</label>
                                <input type="text" name="establishment" value="{{ $coaching->establishment }}"
                                    id="establishment">
                            </div>
                            <div class="fi">
                                <label for="branches">Total Branches</label>
                                <input type="number" maxlength="6" name="total_branches"
                                    value="{{ $coaching->total_branches }}" id="branches">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="head">Head Organisation</label>
                                <input type="text" name="head_organisation"
                                    value="{{ $coaching->head_organisation }}" id="head">
                            </div>
                            
                             <div class="fi">
                                <label for="strength">Batch Strength</label>
                                <input type="text" name="batch_strength" value="{{ $coaching->batch_strength }}"
                                    id="strength">
                            </div> 
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="doubt">Revision & Doubt Classes *</label>
                                <select name="doubt_classes" id="doubt" required>
                                    @if ($coaching->doubt_and_revision_class)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                            <div class="fi">
                                <label for="library">Library Facility *</label>
                                <select name="library_facility" id="library" required>
                                    @if ($coaching->library_facility)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fr">

                            <div class="fi">
                                <label for="hostel">Girls Hostel *</label>
                                <select name="girls_hostel" id="hostel" required>
                                    @if ($coaching->girls_hostel)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                            <div class="fi">
                                <label for="hostel">Hostel Facility *</label>
                                <select name="boys_hostel" id="hostel" required>
                                    @if ($coaching->boys_hostel)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="area">Total Area</label>
                                <input type="text" name="total_area" value="{{ $coaching->total_area }}"
                                    id="area">
                            </div>
                            <div class="fi">
                                <label for="payment">Available Modes Of Payment</label>
                                <input type="text" name="modes_of_payment" value="{{ $coaching->modes_of_payment }}"
                                    id="payment">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ac">AC Available</label>
                                <select name="ac_available" id="ac" required>
                                    @if ($coaching->ac_available)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                            <div class="fi">
                                <label for="pa">Projector Available</label>
                                <select name="projector_available" id="pa" required>
                                    @if ($coaching->projector_available)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="at">Biometric Attendence</label>
                                <select name="biometric_attendence" id="at" required>
                                    @if ($coaching->biometric_attendence)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                            <div class="fi">
                                <label for="cctv">CCTV with recording</label>
                                <select name="cctv_with_recording" id="cctv" required>
                                    @if ($coaching->cctv_with_recording)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="audio">Audio System Available</label>
                                <select name="audio_system_available" id="audio" required>
                                    @if ($coaching->audio_system_available)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                            <div class="fi">
                                <label for="oftest">Offline Test</label>
                                <select name="offline_test" id="oftest" required>
                                    @if ($coaching->offline_test)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            {{-- <div class="fi">
                                <label for="test">Scholarship cum admission process test</label>
                                <select name="scholarship_admission_process" id="test" required>
                                    @if ($coaching->scholarship_admission_process)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div> --}}
                             <div class="fi">
                                <label for="test">Institute management system</label>
                                <select name="institute_management_system" id="test" required>
                                    @if ($coaching->institute_management_system)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div> 
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="ctest">Class Test</label>
                                <select name="class_test" id="ctest" required>
                                    @if ($coaching->class_test)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                            <div class="fi">
                                <label for="otest">Online Test</label>
                                <select name="online_test" id="otest" required>
                                    @if ($coaching->online_test)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="transport">Transport Facility *</label>
                                <select name="transport_facility" id="transport" required>
                                    @if ($coaching->transport_facility)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                            <div class="fi">
                                <label for="st">Providing Study Material</label>
                                <select name="study_material" id="st" required>
                                    @if ($coaching->study_material)
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @else
                                        <option value="0" selected>No</option>
                                        <option value="1">Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="tandc">Term & Condition * </label>
                                <textarea name="tandc" id="tandc" cols="30" rows="6">{{ $coaching->tandc }}</textarea>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="about">About * </label>
                                <textarea name="about" id="about" cols="30" rows="6">{{ $coaching->about }}</textarea>
                            </div>
                        </div>
                            @include('dashboard.coaching.working_hours', ['working_hours' => $coaching->working_hours])
                        @include('dashboard.coaching.result', [
                            'results' => $coaching->resultsAndAchivements->where('data_type','achivement'),
                        ])

                        @include('dashboard.coaching.results', [
                            'results' => $coaching->resultsAndAchivements->where('data_type','result'),
                        ])
                        @include('dashboard.coaching.faculty', ['faculties' => $coaching->faculties])
                        @include('dashboard.coaching.feestructure', ['fees' => $coaching->feeStructures])

                    </div>
                </div>
                <div class="crcoaching__c-r">
                    <div class="btn__c">
                        <button type="submit" class="btn__c-btn">Update Coaching</button>
                    </div>

                    <h2>Images</h2>
                    <div class="di">
                        @if ($coaching->thumbnail)
                            <img src="{{ url('storage') . '/' . $coaching->thumbnail }}" id="thumbnail-view">
                        @else
                            <img src="{{ asset('assets/img_placeholder.png') }}"
                                style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                        @endif
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Select Thumbnail</label>
                    <div class="lic">
                        @if ($coaching->logo)
                            <img src="{{ url('storage') . '/' . $coaching->logo }}" id="thumbnail-view">
                        @else
                            <img src="{{ asset('assets/img_placeholder.png') }}"
                                style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                        @endif
                    </div>
                    <input type="file" name="logo" id="logo">
                    <label for="logo">Logo</label>
                    <div class="gc">
                        @if ($coaching->galleries->count() > 0)
                            @foreach ($coaching->galleries as $img)
                                <div class="img__c">
                                    <a href="{{ url("dashboard/delete-coaching-gallery-image/$img->id") }}">
                                        <div class="remove">
                                            <span>X</span>
                                        </div>
                                    </a>
                                    <img src="{{ url('storage') . '/' . $img->image }}" alt="">
                                </div>
                            @endforeach
                        @endif
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
    @foreach ($localities as $locality)
        if ({{ $locality->city }} == selectedCity) {
            var option = document.createElement('option');
            option.value = "{{ $locality->id }}";
            option.text = "{{ $locality->name }}";
            localityDropdown.appendChild(option);
        }
    @endforeach

    // Add the "Others" option at the end
    var othersOption = document.createElement('option');
    othersOption.value = "others";
    othersOption.text = "Others";
    localityDropdown.appendChild(othersOption);
}

        // updateLocalityDropdown(selectedCity);
        
    </script>
@endsection
