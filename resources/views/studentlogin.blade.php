@extends('layouts.header')

@section('content')
    {{-- @include('components.pagetitle',['title'=>'Login/Registration']) --}}
    <div class="pagetitle" style="background-image:url('{{asset("assets/pagetitle_login.png")}}')">
        <div class="pagetitle__c">
            <h2>
                Login/Registration
            </h2>
        </div>
    </div>
    <div class="stulogin">
        <div class="stulogin__c">
            <div class="form">
                <div class="form__type">
                    <h4 class="login-tab">Login</h4>
                    <h4 class="registration-tab">Registration</h4>
                </div>
                <form action="{{url('login')}}" method="POST" class="login">
                    @csrf
                    <img src="{{asset('assets/logo.jpeg')}}" alt="Coaching Detail">
                    <div class="fi">
                        <label for="lphone">Phone Number *</label>
                        <div class="phonein">
                            <input type="tel" maxlength="10" name="phone" id="lphone" placeholder="Enter Phone Number" required>
                            <span onclick="sendotp()" class="otp_btn">SEND OTP</span>
                        </div>
                        <p id="otp_send_notification" style="display:none;">OTP Sent</p>
                    </div>
                    @if (session('is_otp_field_visible'))
                        <div class="fi">
                            <label for="lpassword" id="lpl">Enter OTP *</label>
                            <input type="password" name="otp" id="lpassword" class="if" placeholder="Enter 4 Digit OTP" required="">
                        </div>
                    @else
                        <div class="fi">
                            <label for="lpassword" id="lpl">Password *</label>
                            <input type="password" name="password" id="lpassword" class="if" placeholder="Password" required>
                        </div>
                    @endif
                    <button type="submit" class="login__btn">Login</button>
                    <p class="login__forget">Forgot Password? <a href="#">Click Here</a></p>
                    @if (session('message'))
                        <p class="error">{{session('message')}}</p>
                    @endif
                </form>
                <form action="{{url('verifyphone')}}" method="POST" class="registration" style="display: none;">
                    @csrf
                    <img src="{{asset('assets/logo.jpeg')}}" alt="Coaching Detail">
                    <div class="fi">
                        <label for="name">Name *</label>
                        <input type="text" name="name" id="name" class="if" placeholder="Name" required>
                    </div>
                    <div class="fi">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" class="if" placeholder="Email Id" required>
                        @if (session('email_error'))
                            <p style="color: red;">{{session('email_error')}}</p>
                        @endif
                    </div>
                    <div class="fi">
                        <label for="phone">Phone Number *</label>
                        <div class="phonein">
                            <input class="if" type="tel" maxlength="10" name="phone" id="rphone" placeholder="Enter Phone Number" required>
                            <!-- <span onclick="sendotp('register')" class="otp_btn">SEND OTP</span> -->
                        </div>
                        @if (session('phone_error'))
                            <p style="color: red;">{{session('phone_error')}}</p>
                        @endif
                    </div>
                    <div class="fi">
                        <label for="rpassword" id="rpl">Password *</label>
                        <input type="password" name="password" id="rpassword" class="if" placeholder="Password" required>
                    </div>
                    <button type="submit" class="login__btn">Continue</button>
                    <p class="login__forget">Already User ? <i class="login-tab" style="color: blue;cursor: pointer;">Login Here</i></p>
                    @if (session('message'))
                        <p class="error">{{session('message')}}</p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>

        @if(session('email_error') || session('phone_error'))
            $('.login-tab').css({'background-color':"white","color":"black"});
            $('.registration-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','none');
            $('.registration').css('display','flex');
        @endif
        
        let params = new URLSearchParams(window.location.search);
        if(params.get('register') == true || params.get('register') == "true"){
            $('.login-tab').css({'background-color':"white","color":"black"});
            $('.registration-tab').css({'background-color':"#253f94","color":"white"});
            $('.login').css('display','none');
            $('.registration').css('display','flex');
        }

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

        // function sendotp(){
        //     let phone = $("#lphone").val();
        //     $("#lpl").text('Enter OTP *')
        //     $('#lpassword').attr('placeholder','Enter 4 Digit OTP');
        //     $('#lpassword').attr('name','otp');

        //     $.ajax(
        //         {
        //             url:"{{url('send-otp')}}",
        //             method:"POST",
        //             data:{"_token":"{{csrf_token()}}","phone":phone},
        //             success: (res)=>{
        //                 if(res.status == "success"){
                            
        //                 }else{
        //                     showAlertDialog(res.message);
        //                 }
        //             }
        //         }
        //     )
        // }
    </script>
@endsection