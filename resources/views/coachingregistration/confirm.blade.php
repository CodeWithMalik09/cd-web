@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Coaching Registration'])
    <div class="enrollnow">
        <div class="enrollnow__c">
            <div class="timeline">
                <div class="stop">
                    <p class="num">1</p>
                    <p class="text">Registration Details</p>
                </div>
                <div class="line" style="background-color: #253f94;"></div>
                <div class="stop" style="background-color: #253f94;">
                    <p class="num">2</p>
                    <p class="text">Gallery</p>
                </div>
                <div class="line" style="background-color: #253f94;"></div>
                <div class="stop" style="background-color: #253f94;">
                    <p class="num">3</p>
                    <p class="text">Confirmation</p>
                </div>
            </div>
            <div class="confirm">
                <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_QKHsU2.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;" autoplay></lottie-player>
                <h4>Thank you for joining us.</h4>
                <p>Your coaching registration form has been completed successfully, Your coaching will be listed after mannual verification from our side.</p>
                <a href="{{url('/')}}">Go To Home Page</a>
            </div>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        </div>
    </div>
@endsection