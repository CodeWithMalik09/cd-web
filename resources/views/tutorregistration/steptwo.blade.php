@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Tutor Registration'])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                    <p class="text">Confirmation</p>
                </div>
            </div>
            <form action="{{url('tutordetailsubmission')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="coaching" value="2">
                <div class="form">
                    <div class="form__h">
                        <h4>Tutor Details</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="courses">Courses offering *</label>
                                <select class="courses-select2" name="courses[]" multiple="multiple" required>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form__c-r-i">
                                <label for="gender">Gender *</label>
                                <select name="gender" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                           
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="city">City *</label>
                                <select name="city" id="city" required>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="alternate_phone">Alternate Phone Number</label>
                                <input type="text" name="alternate_phone" id="alternate_phone" placeholder="Alternate Phone">
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="present_address">Present Address *</label>
                                <input type="text" name="present_address" id="present_address" placeholder="Present Address" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="qualification_details">Qualifications Details *</label>
                                <input type="text" name="qualification_details" id="qualification_details" placeholder="Qualification Details" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="teaching_experience">Teaching Experience(in years) *</label>
                                <input type="number" min="1" max="60" name="teaching_experience" id="teaching_experience" placeholder="Teaching Experience" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="date_of_birth">Date of Birth *</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of birth" required>
                            </div>
                        </div>

                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="fee_per_hour">Fee per hour *</label>
                                <input type="number" name="fee_per_hour" id="fee_per_hour" placeholder="Fee per hour" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="fee_per_month">Fee per month *</label>
                                <input type="number" name="fee_per_month" id="fee_per_month" placeholder="Fee per month" required>
                            </div>
                        </div>

                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="board">Board *</label>
                                <select name="board" id="board">
                                    <option value="CBSE">CBSE</option>
                                    <option value="ICSE">ICSE</option>
                                    <option value="State Board">State Board</option>
                                </select>                            
                            </div>
                            <div class="form__c-r-i">
                                <label for="specialization">Specialization </label>
                                <input type="text" name="specialization" id="specialization" placeholder="Specialization">
                            </div>
                        </div>

                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="subjects">Subject can teach </label>
                                <sub>(You can enter multiple subjects with each separated by comma)</sub>
                                <input type="text" name="subjects" id="subjects" placeholder="Subjects">
                            </div>
                            <div class="form__c-r-i">
                                <label for="free_demo_class">Free Demo Class </label>
                                <select name="free_demo_class" id="free_demo_class">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>  
                            </div>
                        </div>
                    </div>
                    <div class="form__c">
                        <div class="doc">
                            <div class="doc__i">
                                <div class="doc__i-h"><h4>Upload Photo *</h4></div>
                                <div class="display" id="photo_display"></div>
                                <label for="photo">Photo</label>
                                <input type="file" name="thumbnail" id="photo" required>
                            </div>

                            <div class="doc__i">
                                <div class="doc__i-h"><h4>Upload Aadhaar Front *</h4></div>
                                <div class="display" id="aadhaar_front_display"></div>
                                <label for="aadhaar_front">Upload</label>
                                <input type="file" name="aadhaar_front" id="aadhaar_front" required>
                                <!-- <span>Photo is required</span> -->
                            </div>

                            <div class="doc__i">
                                <div class="doc__i-h"><h4>Upload Aadhaar Back *</h4></div>
                                <div class="display" id="aadhaar_back_display"></div>
                                <label for="aadhaar_back">Upload</label>
                                <input type="file" name="aadhaar_back" id="aadhaar_back" required>
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>About</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-c" >
                            <div class="form__c-c-i">
                                <textarea name="about" id="about" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form__c">
                        <div class="btncontainer">
                            <button type="submit" class="btn" id="submit">Submit</button>
                            <button onclick='window.location.href="{{url('')}}";' class="btn">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">

        $('.courses-select2').select2({
            placeholder: 'Select Course',
            allowClear: true
        });

        $('#photo').change((e) => {
            $(".photo_error").remove();
            let reader = new FileReader();
            reader.onload = (re) => {
                $('#photo_display').empty()
                $('#photo_display').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        });

        $('#aadhaar_front').change((e) => {
            $(".aadhaar_front_error").remove();
            let reader = new FileReader();
            reader.onload = (re) => {
                $('#aadhaar_front_display').empty()
                $('#aadhaar_front_display').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        });

        $('#aadhaar_back').change((e) => {
            $(".aadhaar_back_error").remove();
            let reader = new FileReader();
            reader.onload = (re) => {
                $('#aadhaar_back_display').empty()
                $('#aadhaar_back_display').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        });

        $("#submit").on('click',function()
        {
            let photoLength = $("#photo")[0].files.length;
            if(photoLength === 0){
                $('<span class="photo_error" style="font-size:1.6rem;color:red;">Photo is required</span>').insertAfter("#photo");
            }

            let aadhaarFrontLength = $("#aadhaar_front")[0].files.length;
            if(aadhaarFrontLength === 0){
                $('<span class="aadhaar_front_error" style="font-size:1.6rem;color:red;">Aadhaar Front is required</span>').insertAfter("#aadhaar_front");
            }

            let aadhaarBackLength = $("#aadhaar_back")[0].files.length;
            if(aadhaarBackLength === 0){
                $('<span class="aadhaar_back_error" style="font-size:1.6rem;color:red;">Aadhaar Back is required</span>').insertAfter("#aadhaar_back");
            }
        });
    </script>
@endsection