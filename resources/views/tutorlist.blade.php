@extends('layouts.header')

@section('content')

<div class="clh">
    <div class="clh__c">
        @if (isset($cityname))
            <p class="clh__c-t">{{$coursename}} Exam in {{$cityname}}, List of top {{$coursename}} Coaching Institutes in {{$cityname}}</p>
            <div class="clh__c-s">
                <div class="clh__c-s-c course-btn">
                    <p class="course-selected">{{$coursename}}</p>
                    <i class="fa fa-caret-down"></i>
                    <div class="btn__dropdown">
                        <ul class="btn__dropdown-ul course-btn-dropdown">
                            @foreach ($courses as $course)
                                <li>
                                    <p>{{$course->name}}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="clh__c-s-st city-btn">
                    <p  class="city-selected">{{$cityname}}</p>
                    <i class="fa fa-caret-down"></i>
                    <div class="btn__dropdown">
                        <ul class="btn__dropdown-ul city-btn-dropdown">
                            @foreach ($cities as $city)
                                <li>
                                    <p>{{$city->name}}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a id="mapview" href="{{url('mapsearch').'/'.$coursename.'/'.$cityname}}">
                    <div class="clh__c-s-ms">
                        <i class="fa fa-map-marker"></i>
                        <p>MAP VIEW</p>
                    </div>
                </a>
            </div>
        @endif
    </div>
</div>

<script>
   
    $('.course-btn').click(()=>{
        if($('.course-btn-dropdown').css('height') === "0px" ){
            $('.city-btn-dropdown').css({'height':'0px','overflow-y':'hidden','transition':'all 0.5s'});
            $('.course-btn-dropdown').css({'max-height':'22rem','height':'auto','overflow-y':'auto','transition':'all 0.5s'});
        }else{
            $('.course-btn-dropdown').css({'height':'0px','overflow-y':'hidden','transition':'all 0.5s'});
        }
    })
    $('.city-btn').click(()=>{
        if($('.city-btn-dropdown').css('height') === "0px" ){
            $('.course-btn-dropdown').css({'height':'0px','overflow-y':'hidden','transition':'all 0.5s'});
            $('.city-btn-dropdown').css({'max-height':'22rem','height':'auto','overflow-y':'auto','transition':'all 0.5s'});
        }else{
            $('.city-btn-dropdown').css({'height':'0px','overflow-y':'hidden','transition':'all 0.5s'});
        }
    })

    $(document).on("click", function (event) {
        if ($(event.target).closest(".city-btn").length === 0) {
            $('.city-btn-dropdown').css({'height':'0px','overflow-y':'hidden','transition':'all 0.5s'});;
        }
        if ($(event.target).closest(".course-btn").length === 0) {
            $('.course-btn-dropdown').css({'height':'0px','overflow-y':'hidden','transition':'all 0.5s'});;
        }
    });

    let citySelected;
    let courseSelected;
    
    Array.of($('.city-btn-dropdown').children()).forEach((city)=>{
        city.on("click",(e)=>{
            $('.city-selected').text(e.target.innerText);
            citySelected = e.target.innerText;
            if(courseSelected){
                $('#mapview').attr('href',`{{url('mapsearch').'/'}}${e.target.innerText}`);
                $('#mapview').attr('href',`{{url('mapsearch').'/'}}${courseSelected}/${e.target.innerText}`);
            }else{
                $('#mapview').attr('href',`{{url('mapsearch').'/'}}${e.target.innerText}`);
            }
        })
    })
    Array.of($('.course-btn-dropdown').children()).forEach((city)=>{
        city.on("click",(e)=>{
            $('.course-selected').text(e.target.innerText);
            courseSelected = e.target.innerText;
            if(citySelected){
                $('#mapview').attr('href',`{{url('mapsearch').'/'}}${e.target.innerText}/${citySelected}`);
            }else{
                $('#mapview').attr('href',`{{url('mapsearch').'/'}}${e.target.innerText}`);
            }
        })
    })

</script>

<div class="bc">
    <div class="bc__c">
        <p>Home > {{isset($coursename) ? $coursename." > " : "" }} {{isset($cityname) ? $cityname." > " : ""}}</p>
    </div>
</div>

<div class="cl">
    <div class="cl__c">
        <div class="cl__c-f">
            <div class="cl__c-f-c">
                <h5 class="cl__c-f-c-h">FILTERS</h5>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">CATEGORIES</p>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">ESTABLISHED</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-1">
                        <label for="old-1">Old To New</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-2">
                        <label for="old-2">New To Old</label>
                    </div>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">FEE STRUCTURE</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-3">
                        <label for="old-3">Old To New</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-4">
                        <label for="old-4">New To Old</label>
                    </div>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">RATING & REVIEWS</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-5">
                        <label for="old-5">4 <i class="fa fa-star"></i> &amp; Above</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-6">
                        <label for="old-6">3 <i class="fa fa-star"></i> &amp; Above </label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-7">
                        <label for="old-7">2 <i class="fa fa-star"></i> &amp; Above </label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-8">
                        <label for="old-8">1 <i class="fa fa-star"></i> &amp; Above </label>
                    </div>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">TOTAL BRANCH ACROSS INDIA</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-9">
                        <label for="old-9">Old To New</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-10">
                        <label for="old-10">New To Old</label>
                    </div>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">SELECTED STUDENTS</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-11">
                        <label for="old-11">Old To New</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-12">
                        <label for="old-12">New To Old</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-13">
                        <label for="old-13">N/A</label>
                    </div>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">VIEW</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-14">
                        <label for="old-14">Old To New</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-15">
                        <label for="old-15">New To Old</label>
                    </div>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">LIKE</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-16">
                        <label for="old-16">Old To New</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-17">
                        <label for="old-17">New To Old</label>
                    </div>
                </div>
                <div class="cl__c-f-c-i">
                    <p class="cl__c-f-c-sh">DISLIKE</p>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-18">
                        <label for="old-18">Old To New</label>
                    </div>
                    <div class="cl__c-f-c-cbx">
                        <input type="checkbox" name="" id="old-19">
                        <label for="old-19">New To Old</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="cl__c-cl">
            <div class="cl__c-cl-c">
                @if (count($tutors) == 0)
                    <div class="empty">
                        <img src="{{asset('img/empty-tree.svg')}}" alt="">
                        <p>Oops! it seem tutor you are looking for isn't available</p>
                    </div>
                @else
                    @php
                        $courses =  app\Models\TutorCourse::select(['id','name'])->get();
                    @endphp
                    @foreach ($tutors as $tutor)
                        @include('components.tutorcard',['tutors'=>$tutor])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection