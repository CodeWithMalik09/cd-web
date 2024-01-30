<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Coaching Details</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet"> 
    {{-- Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- jquery --}}
    <script src="{{asset('js/jquery.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> --}}
    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{asset('assets/logo.png')}}" type="image/x-icon">
    {{-- Slider js --}}
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApBNEfJZVU3qJrmZc9X1Y0jvmhFC_7s74&callback=initMap"></script>

</head>
<body>
    <header class="h">
        <div class="h__c">
            <ul class="h__c-ul">
                <li class="h__c-ul-li">
                    <a href="{{url('blog')}}">
                        Blog
                    </a>
                </li>
                <li class="h__c-ul-li">
                    <a href="{{url('login')}}">
                        Login/Register
                    </a>
                </li>
                <li class="h__c-ul-li">
                    <a href="{{url('registration')}}">
                        Register Coaching/Tutor
                    </a>
                </li>
            </ul>
            <div class="h__c-logo">
               <a href="{{url('/')}}">
                   <img src="{{ asset('assets/logo.png') }}" alt="Coaching Detail Logo" />
               </a>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="f">
        <div class="f__c">
            <div class="f__c-c">
                <h5>TEST SERIES</h5>
                <ul class="f__c-c-gl">
                    <li>Test</li>
                    <li>BTC</li>
                    <li>Teaching</li>
                    <li>NTPC</li>
                    <li>PCI</li>
                </ul>
            </div>
            <div class="f__c-c">
                <h5>AFTER 12TH</h5>
                <ul class="f__c-c-gl">
                    <li>BE/B.Tech</li>
                    <li>BBA</li>
                    <li>BCA,DCA,B.Sc(IT)</li>
                    <li>BA/B.Com</li>
                    <li>Hotel Management</li>
                </ul>
            </div>
            <div class="f__c-c">
                <h5>COMPANY PROFILE</h5>
                <ul class="f__c-c-gl">
                    <li>About Us</li>
                    <li>Team</li>
                    <li>Contact Us</li>
                </ul>
            </div>
            <div class="f__c-c">
                <h5>FOLLOW US</h5>
                <ul class="f__c-c-sl">
                    <li>
                        <a href="https://www.facebook.com/coachingdetail/">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/detail_coaching">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://in.linkedin.com/in/coaching-detail-0ab367177">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://youtube.com/channel/UC3j3-u56RxnfiAlTcrpzQkQ">
                            <i class="fa fa-youtube-play"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="f__b">
            <p>Copyrights © All rights reserved 2017 - 2021 Taquino India Pvt. Ltd.</p>
        </div>
    </footer>
</body>
</html>