@extends('layouts.header')

@section('content')
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="css/register.css">
    </head>
    @include('components.pagetitle', ['title' => 'Coaching Registration'])
    <div class="enrollnow">
        <div class="enrollnow__c">
            <div class="timeline">
                <div class="stop">
                    <p class="num">1</p>
                    <p class="text">Registration Details</p>
                </div>
                <div class="line"></div>
                <div class="stop">
                    <p class="num">2</p>
                    <p class="text">Gallery</p>
                </div>
                <div class="line"></div>
                <div class="stop">
                    <p class="num">3</p>
                    <p class="text">Confirmation</p>
                </div>
            </div>
            <form action="{{ url('steptwosubmission') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="coaching" value="2">
                <div class="form">

                    <div class="form__h">
                        <h4>Courses</h4>
                    </div>
                    <div class="form_c">
                        @include('coachingregistration.course')

                    </div>

                    <div class="form__h">
                        <h4>City/Localities</h4>
                    </div>
                    <div class="form__c">

                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="cities">City</label>
                                <select name="city" id="cityDropdown">
                                    <option value="select option">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="localities">Locality</label>
                                <input type="hidden" id="selectedCity" value="{{ $city->id }}">
                                <select name="locality" id="localityDropdown">
                                    <option value="">Select Locality</option>
                                    @foreach ($localities as $locality)
                                        @if ($locality->city == $city->id)
                                            <option value="{{ $locality->id }}">{{ $locality->name }}</option>
                                        @endif
                                    @endforeach
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


                                @foreach ($localities as $locality)
                                    if ({{ $locality->city }} == selectedCity) {
                                        var option = document.createElement('option');
                                        option.value = "{{ $locality->id }}";
                                        option.text = "{{ $locality->name }}";
                                        localityDropdown.appendChild(option);
                                    }
                                @endforeach
                            }


                            updateLocalityDropdown(selectedCity);
                        </script>

                        <div class="form__c-r-i">
                            <button type="button" id="getLocationButton">Allow Location Coordinates</button>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Working hours</h4>
                    </div>
                    <div class="form_c">
                        <div class="wh">
                            @include('coachingregistration.workinghours')

                        </div>
                    </div>

                    <div class="form__h">
                        <h4>General Information</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="establishment">Establishment *</label>
                                <input type="text" name="establishment" id="establishment" placeholder="Establishment"
                                    required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="head_organisation">Head Of Institute *</label>
                                <input type="text" name="head_organisation" id="head_organisation"
                                    placeholder="Head Of Institute" required>
                            </div>
                        </div>

                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="status">Status of Coaching *</label>
                                <select name="institute_status" id="status" required>
                                    <option value="trust">Trust</option>
                                    <option value="Society">Society</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Proprietorship ">Proprietorship</option>
                                    <option value="Pvt. Ltd.">Pvt. Ltd.</option>
                                    <option value="State govt. Reg.">State govt. Reg.</option>
                                    <option value="others">others</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="total_area">Total Centre Area (in Sq.ft.) </label>
                                <input type="number" min="1" name="total_area" id="total_area"
                                    placeholder="Total Area">
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="total_branches">Total Branches in City *</label>
                                <input type="number" max="999" min="1" name="total_branches_city"
                                    id="total_branches" placeholder="Total Branches in city" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="total_branches">Total Branches Across India *</label>
                                <input type="number" max="999" min="1" name="total_branches"
                                    id="total_branches" placeholder="Total Branches" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="total_branches">Working Hours *</label>
                                <input type="number" max="999" min="1" name="working_hours"
                                    id="total_branches" placeholder="Working Hours" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="total_branches">Working Days *</label>
                                <input type="number" max="999" min="1" name="working_days"
                                    id="total_branches" placeholder="Working Days" required>
                            </div>
                        </div>

                    </div>

                    <div class="form__h">
                        <h4>Classroom facility</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="ac">AC Classroom *</label>
                                <select name="ac_available" id="ac">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="projector">Projector *</label>
                                <select name="projector_available" id="projector">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="biometric">Biometict Attendence *</label>
                                <select name="biometric_attendence" id="biometric">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="cctv_with_recording">CCTV with recording *</label>
                                <select name="cctv_with_recording" id="cctv_with_recording">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="audio">Audio System *</label>
                                <select name="audio_system_available" id="audio">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Other Facility</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="boys_hostel">Boys Hostel *</label>
                                <select name="boys_hostel" id="boys_hostel">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="girls_hostel">Girls Hostel *</label>
                                <select name="girls_hostel" id="girls_hostel">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="transport_facility">Transport *</label>
                                <select name="transport_facility" id="transport_facility">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="library_facility">Library *</label>
                                <select name="library_facility" id="library_facility">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form__h">
                        <h4>Study Material & Test Facility</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="study_material">Study Material *</label>
                                <select name="study_material" id="study_material">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="scholarship_admission_process">Scholarship cum admission process test *</label>
                                <select name="scholarship_admission_process" id="scholarship_admission_process">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="class_test">Class Test *</label>
                                <select name="class_test" id="class_test">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="online_test">Online Test *</label>
                                <select name="online_test" id="online_test">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="offline_test">Offline Test *</label>
                                <select name="offline_test" id="offline_test">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Other Details</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="doubt_classes">Doubt &amp; Revision Classes *</label>
                                <select name="doubt_classes" id="doubt_classes">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="institute_management_system">Institute Management System *</label>
                                <select name="institute_management_system" id="institute_management_system">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="batch_strength">Strength of students per batch *</label>
                                <input type="number" min="1" name="batch_strength" id="batch_strength"
                                    placeholder="Total Area" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="modes_of_payment">Modes of Payment *</label>
                                <input type="text" name="modes_of_payment" id="modes_of_payment"
                                    placeholder="Modes of Payment" required>
                            </div>

                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="gstin">GSTIN </label>
                                <input type="text" name="gstin" id="gstin" placeholder="GSTIN">
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Contact Details</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="address">Address *</label>
                                <input type="text" name="address" id="address" placeholder="Address" required>
                            </div>
                        </div>

                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="latitude">Latitude </label>
                                <input type="text" maxlength="24" name="latitude" id="latitude"
                                    placeholder="Latitude">
                            </div>
                            <div class="form__c-r-i">
                                <label for="longitude">Longitude </label>
                                <input type="text" maxlength="24" name="longitude" id="longitude"
                                    placeholder="Longitude">
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="landmark">Landmark *</label>
                                <input type="text" name="landmark" id="landmark" placeholder="Landmark" required>
                            </div>

                            <div class="form__c-r-i">
                                <label for="district">District *</label>
                                <input type="district" maxlength="18" name="district" id="district"
                                    placeholder="district" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="pincode">Pincode *</label>
                                <input type="pincode" maxlength="6" name="pincode" id="pincode"
                                    placeholder="Pincode" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="state">State *</label>
                                <input type="text" name="state" id="state" placeholder="State" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="landline_number">Landline Number</label>
                                <input type="tel" maxlength="24" name="landline_number" id="landline_number"
                                    placeholder="Landline Number">
                            </div>
                            <div class="form__c-r-i">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" maxlength="14" name="phone" id="phone"
                                    placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="alternate_phone">Alternate Phone Number </label>
                                <input type="tel" maxlength="14" name="alternate_phone" id="alternate_phone"
                                    placeholder="Alternate Phone Number">
                            </div>
                            <div class="form__c-r-i">
                                <label for="alternate_phone">WhatsApp Number *</label>
                                <input type="tel" maxlength="14" name="alternate_phone" id="alternate_phone"
                                    placeholder="WhatsApp Number" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="website">Website</label>
                                <input type="url" name="website" id="website" placeholder="Website Link">
                            </div>
                            <div class="form__c-r-i">
                                <label for="facebook_link">Facebook Page Link</label>
                                <input type="url" name="facebook_link" id="facebook_link"
                                    placeholder="Facebook Link">
                            </div>
                        </div>

                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="youtube_link">Youtube Channel Link</label>
                                <input type="url" name="youtube_link" id="youtube_link" placeholder="Youtube Link">
                            </div>
                            <div class="form__c-r-i">
                                <label for="twitter_link">Twitter Link</label>
                                <input type="url" name="twitter_link" id="twitter_link" placeholder="Twitter Link">
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Term & Condition</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-c">
                            <div class="form__c-c-i">
                                {{-- <label for="About">About *</label> --}}
                                <textarea name="termandcondition" id="termandcondition" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form__h">
                        <h4>About</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-c">
                            <div class="form__c-c-i">
                                {{-- <label for="About">About *</label> --}}
                                <textarea name="about" id="about" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Student Achievements</h4>
                    </div>
                    <div class="form_c" id="achieve">
                        @include('coachingregistration.achievements')
                    </div>

                    <div class="form__h">
                        <h4>Student Results</h4>
                    </div>
                    <div class="form_c" id="result">
                        @include('coachingregistration.results')
                    </div>

                    <!--faculties-->
                    <div class="form__h">
                        <h4>Faculties</h4>
                    </div>
                    <div class="form__c" id="faculty">
                     @include('coachingregistration.faculties')
                    </div>

                    <div class="form__h">
                        <h4>Fee Structure</h4>
                    </div>
                    <div class="form__c" id="fee">
                     @include('coachingregistration.feestructure')
                    </div>

                    <div class="form__c">
                        <div class="btncontainer">
                            <button type="submit" class="btn">Submit</button>
                            <button type="submit" class="btn">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const getLocationButton = document.getElementById('getLocationButton');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        getLocationButton.addEventListener('click', function() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Store latitude and longitude in inputs
                    latitudeInput.value = latitude;
                    longitudeInput.value = longitude;

                    // Change button text and disable it
                    getLocationButton.textContent = 'Location Added';
                    getLocationButton.disabled = true;
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        });
    });
</script>
