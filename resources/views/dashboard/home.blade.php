@extends('dashboard.layouts.dash')

@section('content')
    <div class="dhome">
        <div class="dhome__c">
            {{-- <h2>Statistics</h2> --}}
            <div class="cardcontainer">
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Coachings</h4>
                        <p>Total Coachings listed on website</p>
                        <div class="count">{{$coachings}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Tutor</h4>
                        <p>Total tutors listed on website</p>
                        <div class="count">{{$tutors}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Library</h4>
                        <p>Total libraries listed on website</p>
                        <div class="count">{{$libraries}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Courses</h4>
                        <p>Total courses offered by all coachings</p>
                        <div class="count">{{$courses}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Operation Areas</h4>
                        <p>Number of cities coaching detail currently working</p>
                        <div class="count">{{$cities}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Blogs</h4>
                        <p>Total blogs created on website</p>
                        <div class="count">{{$blogs}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Students</h4>
                        <p>Total students registered on website</p>
                        <div class="count">{{$students}}</div>
                    </div>
                    <div class="st"></div>
                </div>
            </div>
        </div>
    </div>
@endsection