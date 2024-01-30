@php
    $ktitlez='Contact us : Best coaching courses | State Govt. Jobs  '??null;
    $meta='Our coaching centers and classes provide valuable insights to get Govt. jobs in India and to crack any exams with help of the top list of coaching details. '??null;
@endphp
@extends('layouts.header',[$ktitlez,$meta])


@section('content')
    @include('components.pagetitle',['title'=>"Contact Coaching Detail"])
    <div class="staticpage">
        <div class="staticpage__c">
    
            <div class="contact">
                <div class="contact__l">
                    <div class="contact__l-c">
                        <h3>Contact Us</h3>
                        <div class="tile">
                            <span class="material-icons">place</span>
                            <span>1st Floor, Rajhans Niketan, Rukanpura (Near Canal), Bailey Road, Patna, Bihar-800 014 </span>
                        </div>
                        <div class="tile">
                            <span class="material-icons">email</span>
                            <a href="mailto:contact@coachingdetail.com">contact@coachingdetail.com</a>
                        </div>
                        <div class="tile">
                            <span class="material-icons">phone</span>
                            <a href="tel:06123502407">06123502407</a>
                        </div>
                    </div>
                </div>
                <div class="contact__r">
                    <h4>Send us message</h4>
                    <form action="{{url('submit-contact-message')}}" method="POST" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <div class="fi">
                            <label for="name">Name *</label>
                            <input type="text" name="uname" id="name" required>
                        </div>
                        <div class="fi">
                            <label for="phone">Phone Number *</label>
                            <input type="text" name="phone" id="phone" maxlength="10" required>
                        </div>
                        <div class="fi">
                            <label for="email">Email *</label>
                            <input type="text" name="email" id="email" maxlength="64" required>
                        </div>
                        <div class="fi">
                            <label for="message">Message *</label>
                            <textarea type="text" name="message" id="message" rows="5" required></textarea>
                        </div>
                        <button class="btn fbtn" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=Taquino%20India%20Pvt.%20Ltd.&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            <style>.mapouter{position:relative;text-align:right;height:400px;width:100%;}</style>
            <style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:100%;}</style>
        </div>
    </div>
@endsection