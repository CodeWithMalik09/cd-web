<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CoachingDetail || Search, Compare & Enroll for Coaching Institute free of Cost</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/constant.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,500;1,600&display=swap"
        rel="stylesheet">

    {{-- Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- jquery --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <meta name="google-site-verification" content="t3e272uCvq8GHnsASZjXcWNnmpYUiafV3uX9n0J7Nb0" />

    <meta name="robots" content="index,follow">
    {{-- <meta name="canonical" href="https://coachingdetail.com/{{$slug}}"> --}}
    <link rel="canonical" href="https://coachingdetail.com/{{$slug}}">
    <meta name="description" content="{{ $coaching->about }}" />
    {{-- OGP --}}
    <meta property="og:title" content="{{ $coaching->name }}" />
    <meta property="og:url" content="{{ url("coaching/$coaching->slug") }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ $coaching->about }}" />
    <meta property="og:image" content="{{ url('storage') . '/' . $coaching->logo }}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $coaching->name }}" />
    <meta name="twitter:description" content="{{ $coaching->about }}" />
    <meta name="twitter:url" content="https://www.coachingdetail.com" />
    <meta name="twitter:image" content="{{ url('storage') . '/' . $coaching->logo }}" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7FCWKCMJ1W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-7FCWKCMJ1W');
    </script>


    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EducationalOrganization",
      "name": "{{ $coaching->name}}",
      "description": "{{ $coaching->name}}",
      "url": "{{ url("coaching/$coaching->slug") }}",
      "logo": "{{ url('storage') . '/' . $coaching->logo }}",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{$coaching->landmark}},{{$coaching->address}}",
        "addressLocality": "{{$coaching->district}}",
        "postalCode": "{{$coaching->pincode}}",
        "addressCountry": "India"
      },
      "telephone": "{{$coaching->phone}}",
      "email": "{{$coaching->email}}",
      "image": "{{ url('storage') . '/' . $coaching->logo }}",
      "priceRange": "$$$",
      "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "4.5",
          "bestRating": "5"
        },
        "author": {
          "@type": "Person",
          "name": "CoachingDetail"
        },
        "datePublished": "{{ date('Y-m-d',strtotime($coaching->created_at))}}",
        "reviewBody": "Review of the coaching institute"
      }
    }
    </script>

</head>

<body>
    <header class="h" style="z-index:1000;">
        <div class="h__c">
            <ul class="h__c-ul">
                <li class="h__c-ul-li">
                    <a href="{{ url('blogs') }}">
                        Blog
                    </a>
                </li>
                <li class="h__c-ul-li">
                    <a href="{{ url('jobs') }}">
                        Jobs
                    </a>
                </li>
                <li class="h__c-ul-li">
                    @if (session('user'))
                        <div class="userhc">
                            <span class="material-icons">person</span>
                            <p>{{ session('user')->name }}</p>
                        </div>
                        <ul class="h__c-ul-li-ul">
                            <li><a href="{{ url('user/profile') }}">My Profile</a></li>
                            <li><a href="{{ url('user/wishlist') }}">Wishlist</a></li>
                            <li>
                                <a href="{{ url('studentlogout') }}">Logout</a>
                            </li>
                        </ul>
                    @else
                        <a href="{{ url('login') }}">
                            Login/Register
                        </a>
                    @endif
                </li>
                <li class="h__c-ul-li">
                    <a href="{{ url('registration') }}">
                        Register Coaching/Tutor
                    </a>
                </li>
            </ul>
            <div class="h__c-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/logo.png') }}" alt="Coaching Detail || Coaching Compare Kiya Kya" />
                </a>
                <div class="phc">
                    <h1>CoachingDetail</h1>
                    <p>Coaching Compare Kiya Kya</p>
                </div>
            </div>
            <div class="h__c-md">
                <div class="h__c-md-db">
                    <span class="material-icons">menu</span>
                </div>
                <div class="h__c-md-d h__c-md-danim">
                    <img src={{ asset('assets/logo.png') }} alt="Coaching Detail">
                    <ul>
                        <li class="h__c-ul-li">
                            <a href="{{ url('blogs') }}">
                                Blog
                            </a>
                        </li>
                        <li class="h__c-ul-li">
                            <a href="{{ url('jobs') }}">
                                Jobs
                            </a>
                        </li>
                        <li class="h__c-ul-li">
                            @if (session('user'))
                                <div class="userhc">
                                    <span class="material-icons">person</span>
                                    <p>{{ session('user')->name }}</p>
                                </div>
                                <ul class="h__c-ul-li-ul">
                                    <li>
                                        <a href="{{ url('user/profile') }}">My Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user/wishlist') }}">Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('studentlogout') }}">Logout</a>
                                    </li>
                                </ul>
                            @else
                                <a href="{{ url('login') }}">
                                    Login/Register
                                </a>
                            @endif
                        </li>
                        <li class="h__c-ul-li">
                            <a href="{{ url('registration') }}">
                                Register Coaching/Tutor
                            </a>
                        </li>
                    </ul>
                    <div class="copy">All rights reserved &copy; {{ date('Y', strtotime('now')) }}</div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <div class="dialog" style="display: none;">
        <div class="dialog__c">
            <div class="dialog__c-h">
                <h3 class="dialog__c-h-txt">Alert</h3>
            </div>
            <div class="dialog__c-c"></div>
            <div class="dialog__c-f">
                <div class="dialog__c-f-btn">
                    <span class="dialog__c-f-btn-close">Close</span>
                </div>
            </div>
        </div>
    </div>





    <footer class="f">
        <h5>Coaching Classes In India</h5>

        <div class="f__c">
            <div class="f__c-c">
                <a href="{{ url('homesearch/regular/bank/delhi') }}">Banking Classes In New Delhi</a>
                <a href="{{ url('homesearch/regular/civil-services/delhi') }}">Civil Service Classes In New Delhi</a>
                <a href="{{ url('homesearch/regular/gate/delhi') }}">GATE Classes In New Delhi</a>
                <a href="{{ url('homesearch/regular/jee/delhi') }}">JEE Classes In New Delhi</a>
                <a href="{{ url('homesearch/regular/neet/delhi') }}">NEET Classes In New Delhi</a>
                {{-- <h5>JEE</h5>
                <ul class="f__c-c-gl">
                    <li><a href="{{url("course/jee-advance")}}">JEE Advance</a></li>
                    <li><a href="{{url("course/jee-main")}}">JEE Main</a></li>
                    <li><a href="{{url("course/bitsat")}}">BITSAT</a></li>
                    <li><a href="{{url("course/gate")}}">GATE</a></li>
                </ul> --}}
            </div>
            <div class="f__c-c">
                <a href="{{ url('homesearch/regular/bank/patna') }}">Banking Classes In Patna</a>
                <a href="{{ url('homesearch/regular/civil-service/patna') }}">Civil Service Classes In Patna</a>
                <a href="{{ url('homesearch/regular/gate/patna') }}">GATE Classes In Patna</a>
                <a href="{{ url('homesearch/regular/jee/patna') }}">JEE Classes In Patna</a>
                <a href="{{ url('homesearch/regular/neet/patna') }}">NEET Classes In Patna</a>

                {{-- <h5>MEDICAL</h5>
                <ul class="f__c-c-gl">
                    <li><a href="{{url("course/neet")}}">NEET</a></li>
                    <li><a href="{{url("course/aiims")}}">AIIMS</a></li>
                    <li><a href="{{url("course/neet-pg")}}">NEET PG</a></li>
                    <li><a href="{{url("course/aiims-pg")}}">AIIMS PG</a></li>
                </ul> --}}
            </div>
            <div class="f__c-c">
                <a href="{{ url('homesearch/regular/bank/kota') }}">Banking Classes In Kota</a>
                <a href="{{ url('homesearch/regular/civil-services/kota') }}">Civil Service Classes In Kota</a>
                <a href="{{ url('homesearch/regular/gate/kota') }}">GATE Classes In Kota</a>
                <a href="{{ url('homesearch/regular/jee/kota') }}">JEE Classes In Kota</a>
                <a href="{{ url('homesearch/regular/neet/kota') }}">NEET Classes In Kota</a>
                {{-- <h5>SSC</h5>
                <ul class="f__c-c-gl">
                    <li><a href="{{url("course/ssc-chsl")}}">SSC CHSL</a></li>
                    <li><a href="{{url("course/ssc-cgl")}}">SSC CGL</a></li>
                    <li><a href="{{url("course/ssc-cpo")}}">SSC CPO</a></li>
                    <li><a href="{{url("course/ssc-je")}}">SSC JE</a></li>
                </ul> --}}
            </div>
            <div class="f__c-c">
                <a href="{{ url('homesearch/regular/bank/hyderabad') }}">Banking Classes In Hyderabad</a>
                <a href="{{ url('homesearch/regular/civil-services/hyderabad') }}">Civil Service Classes In
                    Hyderabad</a>
                <a href="{{ url('homesearch/regular/gate/hyderabad') }}">GATE Classes In Hyderabad</a>
                <a href="{{ url('homesearch/regular/jee/hyderabad') }}">JEE Classes In Hyderabad</a>
                <a href="{{ url('homesearch/regular/neet/hyderabad') }}">NEET Classes In Hyderabad</a>
                {{-- <h5>BANK</h5>
                <ul class="f__c-c-gl">
                    <li><a href="{{url("course/sbi-po")}}">SBI PO</a></li>
                    <li><a href="{{url("course/ibps-po")}}">IBPS PO</a></li>
                    <li><a href="{{url("course/ibps-rrb")}}">IBPS RRB</a></li>
                    <li><a href="{{url("course/ibps-clerk")}}">IBPS Clerk</a></li>
                    <li><a href="{{url("course/rbi-assitant")}}">RBI Assitant</a></li>
                    <li><a href="{{url("course/rbi-grade-b")}}">RBI Grade B</a></li>
                    <li><a href="{{url("course/bank-po")}}">Bank PO</a></li>
                </ul> --}}
            </div>

        </div>

        <div class="f__c">
            <div class="f__c-acd">
                <div class="acd">
                    <h2>CoachingDetail</h2>
                    <div class="acd__l">
                        <a href="{{ url('about') }}">About Us</a>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="{{ url('contact') }}">Contact</a>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="{{ url('privacy-policy') }}">Privacy Policy</a>
                    </div>
                    <a class="mail" href="mailto:contact@coachingdetail.com">Email: contact@coachingdetail.com</a>
                </div>
            </div>
            <div class="f__c-acd">
                <ul class="f__c-c-sl">
                    <li>
                        <a href="https://www.facebook.com/coachingdetail/">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/detail_coaching">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://in.linkedin.com/in/coaching-detail-0ab367177">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://youtube.com/channel/UC3j3-u56RxnfiAlTcrpzQkQ">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
            {{-- <div class="f__c-c">
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
            </div> --}}
            {{-- <div class="f__c-c">
                <h5>FOLLOW US</h5>
                <ul class="f__c-c-sl">
                    <li>
                        <a href="https://www.facebook.com/coachingdetail/">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/detail_coaching">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://in.linkedin.com/in/coaching-detail-0ab367177">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://youtube.com/channel/UC3j3-u56RxnfiAlTcrpzQkQ">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div> --}}
        </div>
        <div class="f__b">
            <p>Copyrights © All rights reserved 2017 - {{ date('Y', strtotime('now')) }} Taquino India Pvt. Ltd.</p>
        </div>
    </footer>
    <script src="{{ asset('js/coachingCompare.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
