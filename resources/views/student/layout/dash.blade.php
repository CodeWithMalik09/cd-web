@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>"My Profile"])
    <div class="studash">
        <div class="studash__c">
            <div class="studash__c-l">
                <a href="{{url('user/profile')}}">
                    <div class="details">
                        <img src="{{asset('assets/logo.jpeg')}}" alt="">
                        <div class="details__info">
                            <p>Hello,</p>
                            <p>{{session('user')->name}}</p>
                        </div>
                    </div>
                </a>
                <div class="tabs">
                    <a href="{{url('user/wishlist')}}">
                        <div class="tabs__tab">
                            <span class="material-icons">favorite</span>
                            <p>Wishlist</p>
                            <span class="material-icons">chevron_right</span>
                        </div>
                    </a>
                    <!-- <a href="{{url('user/wishlist')}}">
                        <div class="tabs__tab">
                            <span class="material-icons">info</span>
                            <p>Registration Details</p>
                            <span class="material-icons">chevron_right</span>
                        </div>
                    </a> -->
                    <a href="{{url("user/enrollments")}}">
                        <div class="tabs__tab">
                            <span class="material-icons">list</span>
                            <p>Enrollment</p>
                            <span class="material-icons">chevron_right</span>
                        </div>
                    </a>
                    <a href="{{url('studentlogout')}}">
                        <div class="tabs__tab">
                            <span class="material-icons">logout</span>
                            <p>Logout</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="studash__c-r">
                @yield('profilecontent')
            </div>
        </div>
    </div>
@endsection