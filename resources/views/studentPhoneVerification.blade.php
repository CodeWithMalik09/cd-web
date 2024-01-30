@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Login/Registration'])
    <div class="stulogin">
        <div class="stulogin__c">
            <div class="form">
                <div class="form__type">
                    <h4 class="login-tab" style="width: 100%;">Verify Phone Number</h4>
                </div>
                <form action="{{url('studentregistration')}}" method="POST" class="login">
                    @csrf
                    <img src="{{asset('assets/logo.jpeg')}}" alt="Coaching Detail">
                    <input type="hidden" name="type" value="{{session('student_register_details')['type']}}">
                    <input type="hidden" name="phone" value="{{session('student_register_details')['phone']}}">
                    <input type="hidden" name="email" value="{{session('student_register_details')['email']}}">
                    <input type="hidden" name="name" value="{{session('student_register_details')['name']}}">
                    <input type="hidden" name="pswd" value="{{session('student_register_details')['password']}}">
                    <div class="fi">
                        <label for="otp">Enter OTP *</label>
                        <input type="text" maxlength="6" name="otp" id="otp" placeholder="OTP" required>
                    </div>
                    <a class="login__forget" href="{{url('send-otp')}}" style="align-self: flex-end;cursor: pointer; color:blue;">Resend OTP</a>
                    @if (session('message'))
                        <p class="login__forget" style="text-align: center;color:red;">{{session('message')}}</p>
                    @endif
                    <button type="submit" class="login__btn">Submit</button>
                    <p class="login__forget" style="text-align: center;">A text with a One Time Password (OTP) has been sent to your mobile number: {{Crypt::decrypt(session('student_register_details')['phone'])}}</p>
                </form>
                
            </div>
        </div>
    </div>
@endsection