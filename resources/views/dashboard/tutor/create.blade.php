@extends('dashboard.layouts.dash')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="crtutor">
        <div class="crtutor__c">
            <form action="{{ url('dashboard/inserttutor') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="crtutor__c-l">
                    <h2>Add New Tutor</h2>
                    <div class="form">
                        <div class="fr">
                            <div class="fi">
                                <label for="tutorname">Name *</label>
                                <input type="text" name="tutorname" id="tutorname" required>
                            </div>
                            <div class="fi">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" id="dob">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="gender">Gender *</label>
                                <select name="gender" id="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="fi">
                                <label for="city">City *</label>
                                <select name="city" id="city" required>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="course">Courses *</label>
                                <select class="courses-select2" name="courses[]" multiple="multiple" required>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" maxlength="10" name="phone" id="phone" required>
                            </div>
                            <div class="fi">
                                <label for="altphone">Alternate Phone Number</label>
                                <input type="tel" maxlength="10" name="altphone" id="altphone">
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="experience">Teaching Experience (in years)</label>
                                <input type="number" name="experience" id="experience">
                            </div>
                            <div class="fi">
                                <label for="address">Present Address</label>
                                <input type="text" name="address" id="address" required>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="fee_per_hour">Fee per hour </label>
                                <input type="number"  name="fee_per_hour" id="fee_per_hour">
                            </div>
                            <div class="fi">
                                <label for="fee_per_month">Fee per month</label>
                                <input type="text" name="fee_per_month" id="fee_per_month">
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="board">Board *</label>
                                <select name="board" id="board">
                                    <option value="CBSE">CBSE</option>
                                    <option value="ICSE">ICSE</option>
                                    <option value="State Board">State Board</option>
                                </select>     
                            </div>
                            <div class="fi">
                                <label for="specialization">Specialization </label>
                                <input type="text" name="specialization" id="specialization" placeholder="Specialization">
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="subjects">Subject can teach </label>
                                <sub>(You can enter multiple subjects with each separated by comma)</sub>
                                <input type="text" name="subjects" id="subjects" placeholder="Subjects">
                            </div>
                            <div class="fi">
                                <label for="free_demo_class">Free Demo Class </label>
                                <select name="free_demo_class" id="free_demo_class">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>  
                            </div>
                        </div>

                        <div class="fr">
                            <div class="fi">
                                <label for="qd">Qualification Details</label>
                                <textarea type="text" name="qd" id="qd"></textarea>
                            </div>
                            <div class="fi">
                                <label for="tandc">Terms And Conditions</label>
                                <textarea type="text" name="tandc" id="tandc"></textarea>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="about">About Teacher</label>
                                <textarea type="text" name="about" id="about"></textarea>
                            </div>
                        </div>
                        <div class="fr">
                            <div class="fi">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password">
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="crtutor__c-r">
                    <h2>Images</h2>
                    <div class="di">
                        <img src="{{ asset('assets/img_placeholder.png') }}"
                            style="height:120px;width:120px;object-fit:contain;" id="thumbnail-view">
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <label for="thumbnail">Your Image</label>
                    <div class="gc"></div>
                    <input type="file" name="gallery[]" multiple id="gallery">
                    <label for="gallery">Add Gallery</label>
                    <button type="submit" class="sbtn">Add Tutor</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .select2-container .select2-search--inline .select2-search__field textarea
        {
            resize: none;
            padding: 0px;
            border: none;
            border-radius: none;
        }

        .select2-search__field
        {
            resize: none !important;
            padding: 2px !important;
            border: none !important;
            border-radius: revert !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid rgba(255, 102, 0, 0.3) !important;
            min-height: 40px !important;
            border-radius: revert !important;
        }

        .select2-dropdown
        {
            border: 1px solid rgba(255, 102, 0, 0.3) !important;   
        }
        
    </style>

    <script>

        $('.courses-select2').select2({
            placeholder: 'Select Course',
            allowClear: false
        });

        $('#feestructure').change((e) => {
            let reader = new FileReader();
            reader.onload = (re) => {
                $('.fsc').empty()
                $('.fsc').attr('style', 'display:block');
                $('.fsc').append(`<iframe src="${re.target.result}"></iframe>`);
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
                    $('.gc').append(`<img src="${re.target.result}"/>`);
                }
                reader.readAsDataURL(element)

            });
        })
    </script>
@endsection
