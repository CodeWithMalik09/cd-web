@extends('layouts.coachingHeader', ['slug' => $coaching->slug])

@section('content')
<head>
 <link rel="stylesheet" href="{{asset('css/coachingcss.css')}}">
 <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
 @include('social_media')

    <div class="ch">
        <div class="ch__c">
            <div class="ch__c-title">
                              <center>
            <div class="heading-container">
        <h1>{{$coaching->name}}</h1>
    
              </div>
              <div class="paracontainer">
                <p>
                    FIND    THE    BEST    COACHING    IN    YOUR    CITY 
                </p>
    
              </div>
              </center>
                <img src="{{ asset('assets/thumbnail.jpeg') }}" alt="Coaching Detail || Title Image"
                    class="ch__c-title-i">
                {{-- url('storage') . '/' . $coaching->thumbnail --}}
                {{-- asset('assets/pagetitle_list.png') --}}
            </div>
            <div class="ch__c-b">
                <a href="{{ url('/') }}">
                    <p>Home</p>
                </a> <i class="fa fa-chevron-right"></i>
                <p>Coaching </p> <i class="fa fa-chevron-right"></i>
                <p>{{ $coaching->name }}</p>
            </div>
            <div class="ch__c-f">
                <div class="form">
                    <form>
                        @php
                            $types = ['Regular', 'Test Series', 'Correspondance', 'Online', 'Tutor', 'Library'];
                        @endphp,
                        <select name="type" id="type">
                            @foreach ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <select name="category" id="course">
                            @foreach ($allcourses as $course)
                                @if ($coaching->main_course_id == $course->id)
                                    <option value="{{ $course->slug }}" selected>{{ $course->name }}</option>
                                @else
                                    <option value="{{ $course->slug }}">{{ $course->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="city" id="city">
                            @foreach ($cities as $city)
                                @if (in_array($city->id, json_decode($coaching->cities)))
                                    <option value="{{ $city->name }}" selected>{{ $city->name }}</option>
                                @else
                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="submit" id="searchbtn">Search</button>
                    </form>
                </div>
                <script>
                    $('#searchbtn').click((e) => {
                        e.preventDefault();
                        window.open(`{{ url('homesearch') }}/${$('#type').val()}/${$('#course').val()}/${$('#city').val()}`,
                            '_self');
                    })
                </script>
            </div>
            <div class="ch__c-mc">
                <div class="ch__c-mc-l">
                    @if (session('user'))
                        <div class="wishlist">
                            <i class="fa fa-heart wishbtn"
                                style="cursor: pointer;color: {{ $coaching->wishlisted ? 'red;' : 'grey;' }}"
                                data-id="{{ Crypt::encrypt($coaching->id) }}" data-type="coaching">
                            </i>
                        </div>
                    @else
                        <a class="wishlist" href="{{ url('login') }}">
                            <i class="fa fa-heart wishbtn"></i>
                        </a>
                    @endif
                    <div class="logo">
                        <img src="{{ url('storage') . '/' . $coaching->logo }}" alt="{{ $coaching->name }}">
                    </div>
                    @php
                        $images = [];
                        array_push($images, url('storage') . '/' . $coaching->logo);
                    @endphp
                    <div class="gallery">
                        @if ($coaching->galleries)
                            @foreach ($coaching->galleries as $img)
                                @php
                                    array_push($images, url('storage') . '/' . $img->image);
                                @endphp
                                <img src="{{ url('storage') . '/' . $img->image }}" alt="Img"
                                    onclick="viewImage(this)">
                            @endforeach
                        @endif
                    </div>
                      <div class="extra">
                        @if (session('user'))
                            <a href="{{ url("onlineadmission/$coaching->id") }}">Enroll Now</a>
                        @else
                            <a href="{{ url('login') }}">Enroll Now</a>
                        @endif
                        <a href="{{ url('mapview') . '/' . Crypt::encrypt($coaching->id) }}">Map View</a>
                    </div>

                     {{--for address--}}
                          <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>

                     <div class="address">

                         <div class="popup-container" id="popupContainer">
                            <p style="font-family:nunito;font-size:22px;margin-bottom:10px">Contact Information <i class="fa fa-times" style="margin-left:70px;cursor:pointer" onclick="closeShow()"></i></p>
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:{{$coaching->phone}}" >{{$coaching->phone}}</a></p>
                               @if($coaching->alternate_phone != null)
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:{{$coaching->alternate_phone}}" >{{$coaching->alternate_phone}}</a></p>
                             @endif
                                     @if($coaching->landline_number != null)
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:{{$coaching->landline_number}}" >{{$coaching->landline_number}}</a></p>
                             @endif

                            @if($coaching->phone != $coaching->whatsapp_no && $coaching->whatsapp_no != null)
                            <p><i class="fa fa-phone" style="margin-right:4px"></i><a href="tel:{{$coaching->whatsapp_no}}" >{{$coaching->whatsapp_no}}</a></p>
                             @endif
                        </div>

                        <h3>Address</h3>
                        <p>

                         {{ $coaching->landmark ? $coaching->landmark . ', '.' ' : '' }}
                            {{ $coaching->address . ', ' }}
                            {{ ucwords(strtolower($coaching->district)) . ',  '.' ' }}
                            {{ ucwords(strtolower($coaching->state)) . ',  '.' ' }}
                            {{ $coaching->pincode }}                       
                           </p>
                       <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>                       
                           @if (session('user'))
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
                                            <a href="https://wa.me/{{ $coaching->whatsapp_no }}" target="_blank"
                                                style="color:white">Chat</a>



                                        </button>
                                </div>
                            </center>
                        @else
                        <div class="contactbtn" style="display:flex;margin-left:5px">


                            <button
                                style="border-radius: 9.564px;margin-top:5px; margin-bottom:5px;
                               border: 0.956px solid #00C514;
                                   background: linear-gradient(180deg, #6BCF1C 5.73%, rgba(150, 255, 67, 0.82) 10.94%, #4BA505 83.85%);width:60%"><i
                                    class="fa fa-phone" aria-hidden="true"></i>
                                    <a href="{{url('login')}}" target="_blank"
                                    style="color:white">   Get Number </a>


                            </button>
                            <center> <button id="popupButton"
                                    style="border-radius: 9.564px;margin-top:5px; margin-bottom:5px;margin-left:7px;
            border: 0.956px solid #00C514;
            background: linear-gradient(180deg, #6BCF1C 5.73%, rgba(150, 255, 67, 0.82) 10.94%, #4BA505 83.85%);width:100%"><i
                                        class="fab fa-whatsapp"></i>
                                    <a href="{{url('login')}}" target="_blank"
                                        style="color:white">Chat</a>



                                </button>
                        </div>
                    </center>                        
                    @endif

                    </div>
                    <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>
                        {{-- working hours --}}
                    <div class="workinghours">
                        @php
                            $hasWorkingHours = false;

                        @endphp
                        @foreach ($newworkinghours as $newworkinghour)
                            @if (
                                $newworkinghour->coaching_id == $coaching->id &&
                                    !empty($newworkinghour->weekdays) &&
                                    !empty($newworkinghour->from) &&
                                    !empty($newworkinghour->to))
                                @php
                                    $hasWorkingHours = true;
                                @endphp
                            @endif
                        @endforeach
                        @if ($hasWorkingHours)
                            <h3>Working Hours</h3>
                        @endif

                        @foreach ($newworkinghours as $newworkinghour)
                            @if (
                                $newworkinghour->coaching_id == $coaching->id &&
                                    !empty($newworkinghour->weekdays) &&
                                    !empty($newworkinghour->from) &&
                                    !empty($newworkinghour->to))
                                @php
                                    $hasWorkingHours = true;
                                @endphp

                                <p id="wh">
                                    {{ $newworkinghour->weekdays }}
                                    {{ $newworkinghour->from.'-' }}
                                    {{ $newworkinghour->to }}
                                </p>
                                <br>
                            @endif
                        @endforeach
                    </div>

                          <svg width="95%" height="1" style="margin-top: 10px; margin-bottom: 10px;">
                        <line x1="2.5%" y1="0" x2="97.5%" y2="0" stroke="gray" stroke-width="2"/>
                      </svg>
                     @if($coachingList->count() !=0)
                  <div class="similarcoachings">
                        <h3 style="font-family: nunito;font-size:20px;margin-bottom:8px;margin-left:5px">Similar Coachings
                        </h3>
                    </div>
                    @endif


                    <div class="gallerys">

                        @foreach ($coachingList as $coachingList)
                            <a href="{{ url('coaching') . '/' . $coachingList->slug }}">
                         <img src="{{ url('storage') . '/' . $coachingList->logo }}" alt="{{ $coachingList->name }}"width="100%">


                                <center>
                                    <p id="title" style="font-size: 17px;font-family:nunito">
                                        {{ $coachingList->name }}</p>
                                    <p id="paragraph" style="font-size:12px;color:gray;margin-top:-6px;">
                                        {{ $coachingList->mainCourse->name }}</p>

                                    {{-- locatity --}}

                                    @if ($coachingList->locality != '' && $coachingList->locality != null && $coachingList->locality != 'null')
                                        @foreach (json_decode($coachingList->locality) as $decodedLocality)
                                            @if ($decodedLocality != 'others')
                                                @foreach ($localities as $locality)
                                                    @if ($decodedLocality == $locality->id)
                                                        <p style="font-size:12px;color:gray;margin-top:-5px;">
                                                            {{ $locality->name }},
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif

                                    {{-- end locality --}}
                                    {{-- city --}}
                                    @foreach ($cities as $city)
                                        @if (in_array($city->id, json_decode($coachingList->cities)))

                                          <span style="font-size:12px;color:gray;margin-top:-5px;">      {{ $city->name }}</span></p>
                                        @endif
                                    @endforeach

                                </center>
                            </a>

                        @endforeach
                    </div>

                                                              
                   
                </div>
                <div class="ch__c-mc-r">
                    <div class="mrow">
                        <h2>{{ $coaching->name }}</h2>
                        <div class="row">
         {{--
                              <p class="enroll__now-cls">
                            @if (session('user'))
                            <a href="{{ url("onlineadmission/$coaching->id") }}">Enroll Now</a>
                        @else
                            <a href="{{ url('login') }}" id="enow">Enroll Now</a>
                        @endif
                    </p>
                       --}}
                            <input type="checkbox" class="comparebtn" data-id="{{ $coaching->id }}"
                                value="{{ json_encode($coaching->only(['id', 'logo', 'name'])) }}" id="compare-btn"
                                style="display:none;">
                            <label class="share-btn coaching-compare-btn" for="compare-btn">
                                <i class="fa fa-random"></i>
                                <span>Compare</span>
                            </label>
                            <div
                                class="share-btn"onclick="shareMe('{{ urlencode(url('coaching') . '/' . $coaching->slug) }}')">
                                <i class="fa fa-share"></i>
                                <span>Share</span>
                                <div class="share-container">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url("coaching/$coaching->slug") }}"
                                        target="_blank">
                                        <i class="fab fa-facebook"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a href="http://twitter.com/share?text=ShareCoachingDetaile&url={{ url("coaching/$coaching->slug") }}"
                                        target="_blank">
                                        <i class="fab fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a href="https://wa.me/?text={{ url("coaching/$coaching->slug") }}" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>Whatsapp</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
           
                    <div class="dflex">
                    <p id="en">
                        @if (session('user'))
                        <a href="{{ url("onlineadmission/$coaching->id") }}" id="enow">Enroll Now</a>
                    @else
                        <a href="{{ url('login') }}" id="enow">Enroll Now</a>
                    @endif
                </p>
                   @if($feedisc!=null && $feedisc->scholarship_discount !='YES' && $feedisc->scholarship_discount !='NO' && $feedisc->scholarship_discount !='Yes' && $feedisc->scholarship_discount !='No' && $feedisc->scholarship_discount !=null)
                <p id="disc">
             
                      {{$feedisc->scholarship_discount !='YES' && $feedisc->scholarship_discount !='NO' && $feedisc->scholarship_discount !='Yes' && $feedisc->scholarship_discount !='No' && $feedisc->scholarship_discount !=null?  $feedisc->scholarship_discount.' '.'off' :''}}
            
            </p>
          @endif
        </div>   
                      
                    <div class="rc">
   <p style="font-size:15px;color:white;background-color:#2873F0;padding:9px 18px;border-radius:5px">

                        <i class="fa fa-star"></i>
                        {{ $coaching->stats->average_rating ?? 0 }}</p>

                    <p style="margin-left:10px;font-size:15px;color:white;background-color:#2873F0;padding:8px 15px;border-radius:5px">
                        <img src="{{ asset('assets/like.png') }}" height="15px" width="15px">
                        {{ $coaching->stats->likes . ' ' . '|' ?? 0.0 }}


                        <img src="{{ asset('assets/dislike.png') }}" height="15px" width="15px">
                        {{ $coaching->stats->dislikes ?? 2.2 }}
                    </p>

                    @if ($coaching->is_verified == 1)
                        <!-- Display verified item -->
                        <img src="{{ asset('assets/verify.png') }}" alt="" height="35px" width="110px"
                            style="margin-bottom:-7px ">
                    @endif                      
                       <br>
                        </div>
                             <p id="local">
                            @if ($coaching->locality != '' && $coaching->locality != NULL && $coaching->locality != 'null') 
                                @foreach (json_decode($coaching->locality) as $decodedLocality)
                                    @if($decodedLocality != 'others')   
                                        @foreach ($localities as $locality) 
                                            @if ($decodedLocality == $locality->id) 
                                                {{$locality->name}},
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif

                            @foreach ($cities as $city)
                                @if (in_array($city->id, json_decode($coaching->cities)))
                                    {{ $city->name }}
                                @endif
                            @endforeach
                        </p>

                     <div class="sc">
                    <div id="popupMenu" class="popup-menu" style="display: none;">
                        @foreach ($othercourses->unique('mainCourse.name') as $othercourse)
                            <a href="{{ url('coaching') . '/' . $othercourse->slug }}" style="margin-right:6px">

                                <button style="margin:5px;">
                                    {{ '     ' . $othercourse->mainCourse->name ?? 'N/A' }}
                                </button>
                            </a>
                        @endforeach
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
                                       <img src="{{asset('img/Establishment1.png')}}" alt="" style="height: 22px;width:22px;margin-bottom:-5px;margin-right:5px"> Establishment
                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                       | {{$coaching->establishment ?? 'N/A'}}
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
                                        <img src="{{asset('img/hod.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Head of Organisation
                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | {{$coaching->head_organisation ?? 'N/A'}}
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
                                        <img src="{{asset('img/tbai.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Total Branches Accross India

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | {{$coaching->total_branches ?? 'N/A'}}
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
                                        <img src="{{asset('img/area.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Total Area

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | {{$coaching->total_area ?? 'N/A'}}
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
                                        <img src="{{asset('img/status.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Status of Coaching

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        | {{$coaching->institute_status}}
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
                                    | {{$categories}}
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
                                        | {{$coaching->streams}}
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
                                        | {{$coaching->mainCourse->name}}
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
                                        <img src="{{asset('img/course.png')}}" alt="" style="height:20px;width:20px;margin-bottom:-5px;margin-right:5px">Other Courses

                                    </div>
                                </div>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                <!-- Added ml-md-3 for horizontal space -->
                                <div class="card">
                                    <div class="card-body">
                                        |  @foreach ($othercourses->unique('mainCourse.name') as $othercourse)


                                        <a href="{{ url('coaching') . '/' . $othercourse->slug }}" class="other">


                                                {{ $othercourse->mainCourse->name?? 'N/A' }}

                                        </a>
                                        @if($loop->iteration > 3)

                                            @break

                                        @elseif($loop->iteration < $othercourses->count())
                                        ,{{' '}}
                                        @endif
                                    @endforeach
                                    @if($othercourses->count() > 4)
                                    <span id="showcourse" onclick="showcoursePopup()" style="cursor: pointer;font-size:1.6rem;text-decoration:underline">See All</span>
                                     @elseif($othercourses->count() < 1)
                                      N/A
                                    @endif
                                    </div>
                                </div>
                            </div>


                            <!-- Third Column -->

                        </div>



                        <!-- Add more rows with 3 columns each as needed -->
                    </div>

                </div>

                {{--classroom--}}
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
                                            <img src="{{asset('img/ac.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">AC Available

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->ac_available == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/projector.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Projector Available
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->projector_available == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/biometric.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Biometric Available

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                        | {{ $coaching->biometric_attendence == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/cctv.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">CCTV With Recording
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->cctv_with_recording == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/audio.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Audio System
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                         | {{ $coaching->audio_system_available == 1 ? 'Yes' : 'No' }}
                                        </div>
                                    </div>
                                </div>


                                <!-- Third Column -->

                            </div>

                        </div>

                </div>

                {{--other facility new--}}
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
                                            <img src="{{asset('img/hostel.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Boys Hostel

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->boys_hostel == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/hostel.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Girls Hostel

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->girls_hostel == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/transport.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Transportation
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->transport_facility == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/Library13.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Library

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->library_facility == 1 ? 'Yes' : 'No' }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                        </div>
                </div>

                {{--study material new--}}
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
                                            <img src="{{asset('img/dvd.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Study Material/Books/DVD

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->study_material == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/scholarship.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Scholarship cum Admission Test
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->scholarship_admission_process == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/offline.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Offline Test

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->offline_test == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/online.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Online Test

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->online_test == 1 ? 'Yes' : 'No' }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                        </div>
                </div>


                {{--other details new--}}
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
                                            <img src="{{asset('img/revision.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Revision & Doubt Classes

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->doubt_and_revision_class == 1 ? 'Yes' : 'No' }}
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
                                            <img src="{{asset('img/payment.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px">Available Modes of Payment
                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->modes_of_payment ?? 'N/A'}}
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
                                            <img src="{{asset('img/batch.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Strength of Students Per Batch

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->batch_strength ?? 'N/A' }}
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
                                            <img src="{{asset('img/institute.png')}}" alt="" style="height:22px;width:22px;margin-bottom:-5px;margin-right:5px"> Institute Management System

                                        </div>
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-md-4 mb-4 ml-md-3" style="width:50%">
                                    <!-- Added ml-md-3 for horizontal space -->
                                    <div class="card">
                                        <div class="card-body">
                                            | {{ $coaching->institute_management_system == 1 ? 'Yes' : 'No' }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Third Column -->

                            </div>
                        </div>
                </div>

                    @if ($coaching->feeStructures->count() > 0)
                        <h4 class="ch__c-mc-r-sh">Fee Structure, Admission process & Enrollment -</h4>
                        <div class="tblcon">
                            <table>
                                <thead>
                                    <th>S.No.</th>
                                    <th>Course</th>
                                    <th>Course Name</th>
                                    <th>Stream</th>
                                    {{-- <th>Type</th> --}}
                                    <th>Batch Starting Date</th>
                                    <th>Duration</th>
                                    <th>Fees</th>
                                    <th>Admission Process</th>
                                    <th>Admission Open</th>
                                </thead>
                                <tbody>
                                    @foreach ($coaching->feeStructures as $key => $structure)
                                        @if ($key < 3)
                                            <tr
                                                style="background-color: {{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                                <td>{{ $key + 1 }}</td>
                                                @if ($structure->course)
                                                    <td>{{ $structure->course['name'] ?? '' }}</td>
                                                @else
                                                    N/A
                                                @endif
                                                <td>{{ $structure->course_name ?? 'N/A' }}</td>
                                                <td>{{ $structure->stream ?? 'N/A' }}</td>
                                                {{-- <td>{{$structure->type}}</td> --}}
                                                <td>{{ $structure->batch_starting_date == null ? 'N/A' : date('d F Y', strtotime($structure->batch_starting_date)) }}
                                                </td>
                                                <td>{{ $structure->course_duration ?? 'N/A' }}</td>
                                                <td><span style="font-family: arial;">₹</span>
                                                    {{ $structure->fees ?? 'N/A' }}
                                                </td>
                                                <td>Online/Offline</td>
                                                <td>@if (session('user'))
                                                    <a href="{{ url("onlineadmission/$coaching->id") }}" style="background-color:#253f94;font-size:10px;width:70px;margin-top:50%;font-weight:bold">Enroll Now</a>
                                                @else
                                                    <a href="{{ url('login') }}" style="background-color:#253f94;font-size:10px;width:70px;margin-top:50%;font-weight:bold">Enroll Now</a>
                                                @endif</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($coaching->feeStructures->count() > 3)
                            <a href="{{ url('feestructure') . '/' . $coaching->slug }}" class="viewmore">View
                                More</a>
                        @endif
                    @endif

                    @if (count($coaching->resultsAndAchivements->where('data_type', 'achivement')) > 0)
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
                                    {{-- <th>Selected in PT</th>
                            <th>Selected in Mains</th>
                            <th>Selected in Final</th>
                            <th>Selected in Top 10</th> --}}
                                </thead>
                                <tbody>
                                    @foreach ($coaching->resultsAndAchivements->where('data_type', 'achivement') as $key => $result)
                                        @if ($key < 3)
                                            <tr
                                                style="background-color: {{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                                <td>{{ $key + 1 }}</td>
                                                @if ($result->course)
                                                    <td>{{ $result->course['name'] ?? 'N/A' }}</td>
                                                @else
                                                    <td>
                                                        N/A
                                                    </td>
                                                @endif
                                                <td>{{ $result->exam_year ?? 'N/A' }}</td>
                                                <td>{{ $result->type ?? 'N/A' }}</td>
                                                <td>{{ $result->stream ?? 'N/A' }}</td>
                                                <td>{{ $result->student_name ?? 'N/A' }}</td>
                                                <td>{{ $result->rank ?? 'N/A' }}</td>
                                                <td>{{ $result->percentage ?? 'N/A' }}</td>
                                                {{-- <td>{{$result->selected_in_pt}}</td>
                                    <td>{{$result->selected_in_mains}}</td>
                                    <td>{{$result->selected_in_final}}</td>
                                    <td>{{$result->selected_in_top_ten}}</td> --}}
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($coaching->resultsAndAchivements->where('data_type', 'achivement')->count() > 3)
                            <a href="{{ url('results') . '/achivement' . '/' . $coaching->slug }}" class="viewmore">View
                                More</a>
                        @endif
                    @endif

                    @if (count($coaching->resultsAndAchivements->where('data_type', 'result')) > 0)
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
                                    {{-- <th>Selected in PT</th>
                            <th>Selected in Mains</th>
                            <th>Selected in Final</th>
                            <th>Selected in Top 10</th> --}}
                                </thead>
                                <tbody>
                                    @php
                                        $key = 0;
                                    @endphp
                                    @foreach ($coaching->resultsAndAchivements->where('data_type', 'result') as $result)
                                        @if ($key < 3)
                                            <tr
                                                style="background-color: {{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $result->exam_year ?? 'N/A' }}</td>
                                                <td>{{ $result->stream ?? 'N/A' }}</td>
                                                <td>{{ $result->selected_in_pt ?? 'N/A' }}</td>
                                                <td>{{ $result->selected_in_mains ?? 'N/A' }}</td>
                                                <td>{{ $result->selected_in_final ?? 'N/A' }}</td>
                                            </tr>
                                        @endif
                                        @php
                                            $key++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($coaching->resultsAndAchivements->where('data_type', 'result')->count() > 3)
                            <a href="{{ url('results') . '/result' . '/' . $coaching->slug }}" class="viewmore">View
                                More</a>
                        @endif
                    @endif

                    @if (count($coaching->faculties) > 0)
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
                             {{--
                                    <th>Job Type</th>
                                    <th>Remarks</th>
                                     --}}
                                </thead>
                                <tbody>
                                    @foreach ($coaching->faculties as $key => $faculty)
                                        @if ($key < 3)
                                            <tr
                                                style="background-color: {{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $faculty->name ?? 'N/A' }}</td>
                                                <td>{{ $faculty->designation ?? 'N/A' }}</td>
                                                <td>{{ $faculty->specialization_on ?? 'N/A' }}</td>
                                                <td>{{ $faculty->university ?? 'N/A' }}</td>
                                                <td>{{ $faculty->college ?? 'N/A' }}</td>
                                                <td>{{ $faculty->experience_in_years ?? 'N/A' }}</td>
                                                    {{--
                                                <td>{{ $faculty->job_type ?? 'N/A' }}</td>
                                                <td>{{ $faculty->remarks ?? 'N/A' }}</td>
                                              --}}
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($coaching->faculties->count() > 3)
                            <a href="{{ url('faculties') . '/' . $coaching->slug }}" class="viewmore">View
                                More</a>
                        @endif
                    @endif


                    <h4 class="ch__c-mc-r-sh">About {{ $coaching->name }} | Facility | Classrooms -</h4>
                     <br>

                     @if($coaching->youtube_video_link != null)
                     <div class="video-container">
                         <iframe width="560" height="315" src="{{ $coaching->youtube_video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                     </div>
                 @endif 
                   <p class="ch__c-mc-r-p">{{ $coaching->about }}</p>
                    <div class="row justify-content-between align-items-center">
                        <h4 class="ch__c-mc-r-sh">Rating & Reviews -</h4>
                        @if (auth()->user())
                            <a href="{{ url("write-review/$coaching->slug") }}" class="cta">Write Review</a>
                        @else
                            <a href="{{ url('login') }}" class="cta">Login to Write Review</a>
                        @endif
                    </div>
                    <?php //echo "<pre>"; //print_r($coaching->reviews);
                    // foreach($coaching->reviews as $reviews)
                    // {

                    //     $reviewCount[$reviews->overall_rating][] = $reviews->overall_rating;
                    // }
                    // print_r($reviewCount);
                    ?>
                    @if ($coaching->reviews->count() > 0)
                        <div class="review">
                            <div class="review__count">
                                <div class="review__count-l">
                                    <div class="review__count-ar">
                                        <h3>{{ round($coaching->reviews->sum('overall_rating') / $coaching->reviews->count(), 1) }}
                                            <i class="fa fa-star"></i>
                                        </h3>
                                        <p>Average Rating</p>
                                        <p>By</p>
                                        <p>{{ $coaching->reviews->count() }} people</p>
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
                                @php
                                    $fee_ratings = round($coaching->reviews->sum('stars_fees') / $coaching->reviews->count(), 1);
                                    $faculty_ratings = round($coaching->reviews->sum('stars_faculties') / $coaching->reviews->count(), 1);
                                    $material_ratings = round($coaching->reviews->sum('stars_study_materials') / $coaching->reviews->count(), 1);
                                    $result_ratings = round($coaching->reviews->sum('stars_results') / $coaching->reviews->count(), 1);
                                @endphp
                                <div class="review__count-r">
                                    <div class="review__count-avgitem">
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green {{ ($fee_ratings / 5) * 360 }}deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p>{{ $fee_ratings }}
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Fees</p>
                                        </div>
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green {{ ($faculty_ratings / 5) * 360 }}deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p>{{ $faculty_ratings }}
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Faculty</p>
                                        </div>
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green {{ ($material_ratings / 5) * 360 }}deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p>{{ $material_ratings }}
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Study Materials</p>
                                        </div>
                                        <div class="review__count-avgitem-i">
                                            <div class="pie"
                                                style="background-image: conic-gradient(green {{ ($result_ratings / 5) * 360 }}deg, rgba(138, 138, 138,0.1) 0)">
                                                <div class="abovepie">
                                                    <p>{{ $result_ratings }}
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="txt">Results</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review__review">
                                @foreach ($coaching->reviews as $review)
                                    <div class="review__review-i">
                                        <div class="reviewer">
                                            <div class="star">
                                                <p>{{ $review->overall_rating }}</p><i class="fa fa-star"></i>
                                            </div>
                                            <p>{{ $review->user->name ?? '' }}</p>
                                        </div>
                                        <p class="rtxt">{{ $review->review }}</p>
                                        <div class="cred">
                                            <p>Verified User</p><i class="fa fa-shield"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <h4 class="ch__c-mc-r-sh">Connect us on -</h4>
                    <div class="ch__c-mc-r-cc">
                        {{-- <div class="cp">
                        <p>Contact Person</p>
                        <p>Person Name</p>
                    </div> --}}
                           <div class="od">
                            <div class="em">
                                <p>Email</p>
                                <a href="mailto:{{ $coaching->email }}">
                                    <span class="material-icons">email</span>
                                </a>
                            </div>
                            <div class="links">
                                <p>Connect us</p>
                                <div class="lc">
                                    @if ($coaching->website)
                                        <a href="{{ $coaching->website }}" target="_blank">
                                            <div class="fa fa-globe"></div>
                                        </a>
                                    @endif
                                    @if ($coaching->facebook_link)
                                        <a href="{{ $coaching->facebook_link }}" target="_blank">
                                           <i class="fab fa-facebook" aria-hidden="true"></i>
                                           {{-- <div class="fa fa-facebook"></div>--}}
                                        </a>
                                    @endif
                                    @if ($coaching->youtube_link)
                                        <a href="{{ $coaching->youtube_link }}" target="_blank">
                                            <div class="fab fa-youtube"></div>
                                        </a>
                                    @endif
                                    @if ($coaching->twitter_link)
                                        <a href="{{ $coaching->twitter_link }}" target="_blank">
                                            <div class="fab fa-twitter"></div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="comparewidget">
        <a href="{{ url('compare') }}" class="comparewidget__a">
            <div class="comparewidget__c">
                <p>Compare</p>
                <span class="comparewidget__c-count">1</span>
            </div>
        </a>
        <div class="comparewidget__ic">
            <div class="comparewidget__ic-cc">
                {{-- <div class="cwcoaching">
                    <img src="https://rukminim1.flixcart.com/image/312/312/krf91u80/mobile/i/f/m/f3-gt-mzb09huin-poco-original-imag57hec6wkrk77.jpeg?q=70" alt="">
                    <p>Poco F3 GT</p>
                </div> --}}
            </div>
            <div class="remove">Remove All</div>
        </div>
    </div>


   <script>
        var images = {!! json_encode($images) !!}
    </script>
    <div class="imgcarousel" style="display: none;">
        <span class="imgcarousel__close" onclick="closeViewImage()">X</span>
        <span class="imgcarousel__prev" onclick="showPrevImage()"><i class="fa fa-chevron-left"></i></span>
        <div class="imgcarousel__c">
            <img src="" class="imgcarousel__c-img">
        </div>
        <span class="imgcarousel__next" onclick="showNextImage()"><i class="fa fa-chevron-right"></i></span>
    </div>

@endsection
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
