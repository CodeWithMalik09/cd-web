@extends('coaching.layouts.dash')

@section('content')
    <div class="dhome">
        <div class="dhome__c">
            {{-- <h2>Statistics</h2> --}}
            <div class="cardcontainer">
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Faculties</h4>
                        <p>Total faculties listed on your profile</p>
                        <div class="count">{{$faculties}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Results &amp; Achivements</h4>
                        <p>Total results and achivements you have created</p>
                        <div class="count">{{$achivements}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                <div class="dhc">
                    <div class="dhc__c">
                        <h4>Fee Structures</h4>
                        <p>Total fee Structures available for different courses</p>
                        <div class="count">{{$fee_structures}}</div>
                    </div>
                    <div class="st"></div>
                </div>
                {{-- <div class="dhc">
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
                </div> --}}
            </div>
        </div>
    </div>
@endsection