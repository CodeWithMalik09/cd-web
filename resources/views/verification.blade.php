@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Login/Registration'])
    <div class="stulogin">
        <div class="stulogin__c">
            <div class="form">
                <div class="form__type">
                    <h4 class="login-tab" style="width: 100%;">Verify Phone Number</h4>
                </div>
                <form action="{{url('verification')}}" method="POST" class="login">
                    @csrf
                    <img src="{{asset('assets/logo.jpeg')}}" alt="Coaching Detail">
                    <input type="hidden" name="type" value="{{session('verification_details')['type']}}">
                    <input type="hidden" name="phone" value="{{session('verification_details')['phone']}}">
                    <div class="fi">
                        <label for="otp">Enter OTP *</label>
                        <input type="text" maxlength="6" name="otp" id="otp" placeholder="OTP" required>
                    </div>
                    <a class="login__forget" href="{{url('resendotp')}}" style="align-self: flex-end;cursor: pointer;">Resend</a>
                    <button type="submit" class="login__btn">Submit</button>
                    @if (session('message'))
                        <p class="login__forget" style="text-align: center;color:red;">{{session('message')}}</p>
                    @endif
                    <p class="login__forget" style="text-align: center;">Enter OTP sent on your phone number you have entered.</p>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        $('.registration-tab').on('click',()=>{
            $('.login-tab').css({'background-color':"white","color":"black"});
            $('.registration-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','none');
            $('.registration').css('display','flex');
        })
        $('.login-tab').on('click',()=>{
            $('.registration-tab').css({'background-color':"white","color":"black"});
            $('.login-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','flex');
            $('.registration').css('display','none');
        })
    </script>
@endsection