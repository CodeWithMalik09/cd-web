@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Online Admission'])
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
                    <p class="text">Admission Fee</p>
                </div>
                <div class="line"></div>
                <div class="stop">
                    <p class="num">3</p>
                    <p class="text">Confirmation</p>
                </div>
            </div>
            <form action="{{url('onlineadmission')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="coaching" value="{{$coaching->id}}">
                <div class="form">
                    <div class="form__h">
                        <h4>REGISTRATION DETAILS</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="name">Candidate Name *</label>
                                <input type="text" name="name" id="name" placeholder="Candidate Name" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="date">Date Of Birth *</label>
                                <input type="date" name="dob" id="date" placeholder="Select Date" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="gender">Gender *</label>
                                <select name="gender" id="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="date">Category *</label>
                                <select name="category" id="gender" required>
                                    <option value="general">General</option>
                                    <option value="ST">ST</option>
                                    <option value="SC">SC</option>
                                    <option value="OBC">OBC</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="email">Email Id *</label>
                                <input type="email" name="email" id="email" placeholder="Email Id" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="mobile">Contact Number *</label>
                                <input type="tel" maxlength="10" name="mobile" id="mobile" placeholder="Contact Number" required>
                            </div>
                        </div>
                    </div>
                    <div class="form__h">
                        <h4>Father's/Guardian's Details</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="fname">Father's Name *</label>
                                <input type="text" name="fname" id="fname" placeholder="Father's Name" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="occupation">Occupation *</label>
                                <input type="text" name="occupation" id="occupation" placeholder="Occupation" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="fmobile">Mobile No. *</label>
                                <input type="tel" maxlength="10" name="fmobile" id="fmobile" placeholder="Mobile No." required>
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Communication Address</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="address">Address *</label>
                                <input type="text" name="address" id="address" placeholder="Address" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="city">City/Town *</label>
                                <input type="text" name="city" id="city" placeholder="City/Town" required>
                            </div>
                        </div>
                        <div class="form__c-r">

                            <div class="form__c-r-i">
                                <label for="district">District *</label>
                                <input type="text" name="district" id="district" placeholder="District" required>
                            </div>

                            <div class="form__c-r-i">
                                <label for="state">State *</label>
                                <input type="text" name="state" id="state" placeholder="State" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="pincode">Pincode *</label>
                                <input type="text" maxlength="6" name="pincode" id="pincode" placeholder="Pincode" required>
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Course Details</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="session">Session *</label>
                                <input type="text" name="session" id="session" placeholder="Session" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="centre">Centre *</label>
                                <input type="text" name="centre" id="centre" placeholder="Centre" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="course">Course *</label>
                                <select name="course" id="course" required>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form__c-r-i">
                                <label for="exam">Exam *</label>
                                <input type="text" name="exam" id="exam" placeholder="Exam" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="course_category">Course Category *</label>
                                <select name="course_category" id="course_category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form__h">
                        <h4>Education Details</h4>
                    </div>
                    <div class="form__c">
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="qualification">Qualification *</label>
                                <input type="text" name="qualification" id="qualification" placeholder="Qualification" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="stream">Stream *</label>
                                <input type="text" name="qualification_stream" id="stream" placeholder="Stream" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="college">Name Of College (with city) *</label>
                                <input type="text" name="college" id="college" placeholder="College Name" required>
                            </div>
                            <div class="form__c-r-i">
                                <label for="passing_year">Passing Year *</label>
                                <input type="text" name="passing_year" id="passing_year" placeholder="Passing Year" required>
                            </div>
                        </div>
                        <div class="form__c-r">
                            <div class="form__c-r-i">
                                <label for="marks">Marks (in %) *</label>
                                <input type="text" name="marks" id="marks" placeholder="Marks" required>
                            </div>
                        </div>
                    </div>

                    <div class="form__h">
                        <h4>Upload Image / Documents</h4>
                    </div>
                    <div class="form__c">
                        <div class="doc">
                            <div class="doc__i">
                                <div class="doc__i-h"><h4>Upload Photo *</h4></div>
                                <div class="display" id="photo_display"></div>
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" required>
                            </div>
                            <div class="doc__i">
                                <div class="doc__i-h"><h4>Upload Signature *</h4></div>
                                <div class="display" id="signature_display"></div>
                                <label for="signature">Signature</label>
                                <input type="file" name="signature" id="signature" required>
                                
                            </div>
                            <div class="doc__i">
                                <div class="doc__i-h"><h4>Upload Id Proof *</h4></div>
                                <div class="display" id="idproof_display"></div>
                                <label for="idproof">ID Proof</label>
                                <input type="file" name="id_proof" id="idproof" required>
                            </div>
                        </div>
                        <div class="confirm">
                            <input type="checkbox" required>
                            <p>(Click to read the Terms & Conditions) I hereby declare that I have read, understood & agreed to all the terms & conditions set by Coaching Detail management.</p>
                        </div>
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
    <script>
        $('#photo').change((e) => {
            let reader = new FileReader();
            reader.onload = (re) => {
                $('#photo_display').empty()
                $('#photo_display').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        });

        $('#signature').change((e) => {
            let reader = new FileReader();
            reader.onload = (re) => {
                $('#signature_display').empty()
                $('#signature_display').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        });

        $('#idproof').change((e) => {
            let reader = new FileReader();
            reader.onload = (re) => {
                $('#idproof_display').empty()
                $('#idproof_display').append(`<img src="${re.target.result}"/>`);
            }
            reader.readAsDataURL(e.target.files[0])
        });
    </script>
@endsection