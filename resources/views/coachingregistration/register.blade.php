@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Coaching/Institute Registration'])
    <div class="crf">
        <div class="crf__c">
            <div class="form" style="display: flex;">
                <div class="form__type">
                    <h2 style="background-color: #253f94;color:white;" id="coachingbtn">Coaching</h2>
                    <h2 id="tutorbtn">Tutor</h2>
                </div>
                <form id="coachingform" action="{{url('coachingregistration')}}" method="POST">
                    @csrf
                    <img src="{{asset('assets/logo.jpeg')}}" alt="Coaching Detail">
                    <div class="fi">
                        <label for="name">Coaching/Institute Name *</label>
                        <input type="text" id="name" name="name" placeholder="Coaching Name" required>
                    </div>
                    <div class="fi">
                        <label for="email">Email *</label>
                        <input type="text" id="email" name="email" placeholder="Email Id" required>
                    </div>
                    <div class="fi">
                        <label for="phone">Phone *</label>
                        <input type="tel" maxlength="10" id="phone" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="fi">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button class="btn">Register And Verify</button>
                    @if (session('message'))
                        <p style="font-size: 1.6rem;color:red;margin-top:1rem;font-family:'poppins';">{{session('message')}}</p>
                    @endif
                    <p class="existing_user">Already Registered ? <a href="{{url('coachingcms')}}">Login Here</a></p>
                </form>
                <form id="tutorform" action="{{url('tutorregistration')}}" method="POST" style="display:none;">
                    @csrf
                    <img src="{{asset('assets/logo.jpeg')}}" alt="Coaching Detail">
                    <div class="fi">
                        <label for="name">Tutor Name *</label>
                        <input type="text" id="name" name="name" placeholder="Teacher Name" required>
                    </div>
                    <div class="fi">
                        <label for="email">Email *</label>
                        <input type="text" id="email" name="email" placeholder="Email Id" required>
                    </div>
                    <div class="fi">
                        <label for="phone">Phone *</label>
                        <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="fi">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button class="btn">Register And Verify</button>
                    @if (session('message'))
                        <p style="font-size: 1.6rem;color:red;margin-top:1rem;font-family:'poppins';">{{session('message')}}</p>
                    @endif
                    <p class="existing_user">Already Registered ? <a href="{{url('tutorcms/login')}}">Login Here</a></p>
                </form>
            </div>
            
        </div>
    </div>
    <script>
        $('#tutorbtn').on('click',()=>{
            $('#tutorbtn').css({'background-color':'#253f94','color':'white'});
            $('#coachingbtn').css({'background-color':'white','color':'#253f94'});
            $('#tutorform').css('display','flex');
            $('#coachingform').css('display','none');
        })
        $('#coachingbtn').on('click',()=>{
            $('#coachingbtn').css({'background-color':'#253f94','color':'white'});
            $('#tutorbtn').css({'background-color':'white','color':'#253f94'});
            $('#tutorform').css('display','none');
            $('#coachingform').css('display','flex');
        })
    </script>
@endsection