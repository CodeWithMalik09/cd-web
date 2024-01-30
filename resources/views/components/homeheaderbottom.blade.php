<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="h__b">
    <div class="h__b-c">
        <h5>Hi we are CoachingDetail</h5>
        <p>Search, Compare & Enroll for Coaching Institute free of Cost</p>
        <div class="h__b-c-n">
            <ul>
                <li class="course_type_btn" style="background-color: white;">REGULAR</li>
                {{-- <li class="course_type_btn">WEEKEND</li> --}}
                <li class="course_type_btn">CORRESPONDENCE</li>
                <li class="course_type_btn">ONLINE</li>
                <li class="course_type_btn">TEST SERIES</li>
                <li class="course_type_btn">TUTOR</li>
                <li class="course_type_btn">LIBRARY</li>
                <li class="course_type_btn">BY NAME</li>
            </ul>
            <div class="h__b-c-s">
                <div class="btn course-type-btn">
                    <p class="course-type-selected">Course Type</p>
                    <i class="fa fa-caret-down"></i>
                    <div class="btn__dropdown">
                        <ul class="btn__dropdown-ul course-type-btn-dropdown">
                            <li>
                                <p>Regular</p>
                            </li>
                            {{-- <li>
                                <p>Weekend</p>
                            </li> --}}
                            <li>
                                <p>Correspondence</p>
                            </li>
                            <li>
                                <p>Online</p>
                            </li>
                            <li>
                                <p>Test Series</p>
                            </li>
                            <li>
                                <p>Tutor</p>
                            </li>
                            <li>
                                <p>Library</p>
                            </li>
                            <li>
                                <p>By Name</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="btn course-btn">

                    <select name="selectCourse" id="selectCourse">
                        <option></option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->slug ?? '' }}">{{ $course->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                
                <div class="btn city-btn">
                    <select name="selectCity" id="selectCity">
                        <option></option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->name }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                  <div class="btn search-input-container" style="display:none;">
                <input type="hidden" id="selectedCity" value="{{ $city->id }}">
                <select class="js-example-basic-single" name="coaching" id="searchByName">
                  
                      <option></option>
                  
              </select>

                </div>

                {{-- <form  action="{{url('homesearch')}}" method="POST" > --}}
                <form id="search-form">
                    @csrf
                    <input type="hidden" name="type" value="regular" id="type">
                    <input type="hidden" name="city" id="city">
                    <input type="hidden" name="course" id="course">
                    <input type="hidden" name="searchtext" id="searchtext">
                    <button type="submit" class="btn search-btn">SEARCH</button>
                </form>
                <div class="btn mapsearch" id="mapsearch">
                    <a id="mapsearch_btn" href="{{ url('mapsearch') . '/hello/world' }}">
                        MAP SEARCH
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    let tutorCourses = '<?php echo $tutorCourses; ?>';
    let regcourses   = '<?php echo $regcourses; ?>';
    $(document).ready(function () {
        $('#selectCity').select2({
            placeholder:"Select Your City",
        });
        
        $('#selectCourse').select2({
            placeholder:"Select Your Course"
        });
    
    });
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder:"Select Coaching"
        });
        
    });


    $("#searchByName").on('change', (e) => {
        $('#type').val('BY NAME')
        $('#searchtext').val(e.target.value);
    })


    $('#search-form').click((e) => {
        e.preventDefault();
        if ($('#course').val() == "" && ($("#type").val().toUpperCase() != "BY NAME" && $("#type").val().toUpperCase() != "LIBRARY")) {
            $('.dialog').toggle();
            $('.dialog__c-c').html(`<p>Select course you are looking for coaching.</p>`)
        } else if ($('#searchtext').val() == "" && $("#type").val().toUpperCase() == "BY NAME") {
            $('.dialog').toggle();
            $('.dialog__c-c').html(`<p>Enter coaching name you want to search.</p>`)
        } else if ($('#city').val() == "" && ($("#type").val().toUpperCase() == "REGULAR" || $("#type").val().toUpperCase() == "TEST SERIES" || $("#type").val().toUpperCase() == "LIBRARY" || $("#type").val().toUpperCase() == "TUTOR" || $("#type").val().toUpperCase() == "BY NAME")) {
            $('.dialog').toggle();
            $('.dialog__c-c').html(`<p>Select city in which you are looking for coaching</p>`);
        } else if ($("#type").val().toUpperCase() === "TUTOR") {
            window.open(
                `{{ url('tutors') }}/${$('#course').val().toLowerCase()}/${$('#city').val().toLowerCase()}`,
                '_self');
        } else if ($("#type").val().toUpperCase() === "LIBRARY") {
            window.open(
                `{{ url('libraries') }}/${$('#city').val().toLowerCase()}`,
                '_self');
        } else if ($("#type").val().toUpperCase() === "BY NAME") {
            window.open(
                `{{ url('search-by-name-city') }}/${$('#searchtext').val()}/${$('#city').val()}`,
                '_self');
        } else {
            window.open(
                `{{ url('homesearch') }}/${$('#type').val().toLowerCase().replace(" ",'-')}/${$('#course').val().toLowerCase()}/${$('#city').val().toLowerCase()}`,
                '_self');
        }
    })

    $('#mapsearch_btn').click((e) => {
        e.preventDefault();
        if ($('#course').val() == "") {
            $('.dialog').toggle();
            $('.dialog__c-c').html(`<p>Select course you are looking for coaching.</p>`)
        } else if ($('#city').val() === "" && ($("#type").val() !== "ONLINE" && $('#type').val() !==
                "CORRESPONDENCE")) {
            $('.dialog').toggle();
            $('.dialog__c-c').html(`<p>Select city in which you are looking for coaching</p>`);
        } else {
            window.open(
                `{{ url('mapsearch') }}/${$('#type').val().toLowerCase().replace(" ",'-')}/${$('#course').val().toLowerCase()}/${$('#city').val().toLowerCase()}`,
                '_self');
        }
    })


    Array.of($('.course_type_btn')).forEach((btn) => {
        btn.on('click', (i) => {
            if(i.target.innerText === "TUTOR")
            {
                $("#selectCourse").html('');
                let html = '<option value="">Select</option>';
                $.each( JSON.parse(tutorCourses), function( key, value ) {
                    html += `<option value="${value.slug}">${value.name}</option>`;
                });
                $("#selectCourse").html(html);
            }
            else
            {
                $("#selectCourse").html('');
                let html = '<option value="">Select</option>';
                $.each( JSON.parse(regcourses), function( key, value ) {
                    html += `<option value="${value.slug}">${value.name}</option>`;
                });
                $("#selectCourse").html(html);
            }
            btn.css('background-color', 'transparent');
            i.target.style.backgroundColor = "white";
            $('#type').val(i.target.innerText);
            $('#selectCity').val('').trigger('change'); 
            $('#selectCourse').val('').trigger('change'); 
            if (i.target.innerText === "ONLINE" || i.target.innerText === "CORRESPONDENCE") {
                $('.city-btn').css('display', 'none');
                $('.course-btn').css('display', 'flex');
                $('.course-btn').css('flex', '1')
                $('#mapsearch').css('display', 'none');
                $(".search-input-container").hide();
            } else if (i.target.innerText == "BY NAME") {
                $('.city-btn').css('display', 'flex');
                $('.city-btn').css('width', '25%');
                $('.course-btn').css('display', 'none');
                $(".search-input-container").show();
            } else if (i.target.innerText === "LIBRARY") {
                $('.course-btn').css('display', 'none');
                $('.city-btn').css('display', 'flex');
                $('.city-btn').css('flex', '1')
                $('#mapsearch').css('display', 'none');
                $(".search-input-container").hide();
            } else {
                $('.city-btn').css('display', 'flex');
                $('.city-btn').css('flex', '1');
                $('.course-btn').css('display', 'flex');
                $('.course-btn').css('flex', '1');
                $('#mapsearch').css('display', 'block');
                $(".search-input-container").hide();
            }
        })
    })

    $('.course-type-btn').click(() => {
        if ($('.course-type-btn-dropdown').css('height') === "0px") {
            $('.city-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
            $('.course-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
            $('.course-type-btn-dropdown').css({
                'max-height': '22rem',
                'height': 'auto',
                'overflow-y': 'auto',
                'transition': 'all 0.5s'
            });
        } else {
            $('.course-type-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
        }
    })

    $('.course-btn').click(() => {
        if ($('.course-btn-dropdown').css('height') === "0px") {
            $('.city-type-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
            $('.city-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
            $('.course-btn-dropdown').css({
                'max-height': '22rem',
                'height': 'auto',
                'overflow-y': 'auto',
                'transition': 'all 0.5s'
            });
        } else {
            $('.course-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
        }
    })

    $('.city-btn').click(() => {
        if ($('.city-btn-dropdown').css('height') === "0px") {
            $('.city-type-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
            $('.course-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
            $('.city-btn-dropdown').css({
                'max-height': '22rem',
                'height': 'auto',
                'overflow-y': 'auto',
                'transition': 'all 0.5s'
            });
        } else {
            $('.city-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });
        }
    })

    $(document).on("click", function(event) {
        if ($(event.target).closest(".course-type-btn").length === 0) {
            $('.course-type-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });;
        }
        if ($(event.target).closest(".city-btn").length === 0) {
            $('.city-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });;
        }
        if ($(event.target).closest(".course-btn").length === 0) {
            $('.course-btn-dropdown').css({
                'height': '0px',
                'overflow-y': 'hidden',
                'transition': 'all 0.5s'
            });;
        }
    });

    $('#selectCourse').on('change', (e) => {
        $('#course').val('');
        $('#course').val(e.currentTarget.value)
    })

    $('#selectCity').on('change', (e) => {
        $('#city').val('');
        $('#city').val(e.currentTarget.value)
        let cityId=e.currentTarget.value;
        if(cityId)
        {
            if($("#type").val().toUpperCase() == "BY NAME"){
                $('#searchByName').val('');
                $.ajax({
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getcoachingbyname') }}", 
                    method: "POST",
                    data: {
                            "city": cityId
                        },
                    success: function (data) {
                            //data=JSON.parse(data)
                            // Handle successful response
                            var selectElement = $('#searchByName');

                        // Clear existing options
                        selectElement.empty();
                        for (var i = 0; i < data.length; i++) {
                            selectElement.append('<option value="' + data[i].name + '">' + data[i].name + '</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error("Error:", error);
                    }
                });
            }
        }
    })

    Array.of($('.course-type-btn-dropdown').children()).forEach((city) => {
        city.on("click", (e) => {
            $('.course-type-selected').text(e.target.innerText);
            $('#type').val(e.target.innerText)
            if (e.target.innerText.toUpperCase() === "ONLINE" || e.target.innerText.toUpperCase() ===
                "CORRESPONDENCE") {
                $('.city-btn').css('display', 'none');
                $('.course-btn').css('display', 'flex');
                $('.course-btn').css('width', '62vw')
                $('#mapsearch').css('display', 'none');
                $(".search-input-container").css('display', 'none');;

            } 
            else if (e.target.innerText.toUpperCase() === "BY NAME") {
                $('.course-btn').css('display', 'none');
                $('.city-btn').css('display', 'flex');
                $(".search-input-container").show();
                $('.search-input-container').css('width', '84vw')
                $('#mapsearch').css('display', 'block');

            }
            else if (e.target.innerText.toUpperCase() === "LIBRARY") {
                $('.course-btn').css('display', 'none');
                $('.city-btn').css('display', 'flex');
                $(".search-input-container").css('display', 'none');
            } else {
                $('.city-btn').css('display', 'flex');
                $('.course-btn').css('display', 'flex');
                $('.course-btn').css('width', '50%');
                $('.city-btn').css('display', '46vw');
                $('#mapsearch').css('display', 'block');
                $(".search-input-container").css('display', 'none');
            }
        })
    })
</script>