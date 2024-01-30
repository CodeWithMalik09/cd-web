<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
      @if(isset($ktitlez) && $ktitlez != null)

    <title>{{$ktitlez}}</title>
    @else
    <title>CoachingDetail : Best coaching for competitive exams  in Patna</title>
   @endif

    <meta name="robots" content="index,follow">
     @if(isset($slugs))
    <link rel="canonical" href="https://coachingdetail.com/{{$slugs}}">
     @elseif(isset($canonicals))
    <link rel="canonical" href="https://coachingdetail.com/{{$canonicals}}">
    @else
    <link rel="canonical" href="https://coachingdetail.com/">
    @endif
     @if(isset($meta)&& $meta!=null)
    <meta name="description"
    content="{{$meta}}" />
    @else
    <meta name="description"
    content="Find the top coaching classes in Patna. Learn about the institutes and tutors in Patna and make an expert decision to crack the all competitive exam." />
    @endif
    @if(isset($ogtitle) && $ogtitle!=null)
    <meta property="og:title" content="{{$ogtitle}}" />
    @else
    <meta property="og:title" content="CoachingDetail : Best coaching for competitive exams  in Patna" />
    @endif
       <meta property="og:url" content="{{ isset($ogurl) && $ogurl!=null ? $ogurl : url('/') }}" />
        <meta property="og:type" content="{{ isset($ogtype)&& $ogtype!=null ? $ogtype : 'website' }}" />
       <meta property="og:description" content="{{ isset($ogdesc)&& $ogdesc!=null ? $ogdesc : 'Find the top coaching classes in Patna. Learn about the institutes and tutors in Patna and make an expert decision to crack the all competitive exam.' }}" />
    <meta property="og:image" content="{{ asset('assets/logo.png') }}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="CoachingDetail" />
    <meta name="twitter:description"
        content="Search top coaching institutes and tutors at CoachingDetail.com. Find the perfect options for your education with comprehensive information on fees, faculties, results, and more. Compare courses across 25+ cities in India. Unlock your potential today!" />
    <meta name="twitter:url" content="https://www.coachingdetail.com" />
    <meta name="twitter:image" content="{{ asset('assets/logo.png') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/constant.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,500;1,600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- jquery --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
    {{-- Font Awesome CDN --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <meta name="google-site-verification" content="t3e272uCvq8GHnsASZjXcWNnmpYUiafV3uX9n0J7Nb0" />
    <meta name="yandex-verification" content="1919573c82bbc980" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
      "@type": "Organization",
      "name": "CoachingDetail",
      "url": "https://coachingdetail.com",
      "logo": "https://coachingdetail.com/assets/logo.png",
      "description": "Search top coaching institutes and tutors at CoachingDetail.com. Find the perfect options for your education with comprehensive information on fees, faculties, results, and more. Compare courses across 25+ cities in India. Unlock your potential today!",
      "sameAs": [
        "https://www.facebook.com/CoachingDetail",
        "https://twitter.com/CoachingDetail",
        "https://www.instagram.com/coachingdetail/",
        "https://www.linkedin.com/company/coachingdetail/"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "06123502407",
        "contactType": "customer service"
      },
      "location": {
        "@type": "Place",
        "name": "CoachingDetail Headquarters",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "1st Floor, Rajhans Niketan, Rukanpura (Near Canal), Bailey Road",
          "addressLocality": "Patna",
          "postalCode": "800014",
          "addressCountry": "IN"
        }
      },
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://coachingdetail.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <style type="text/css">

        .select2-container--default .select2-selection--multiple {
            border: none;
            border-radius: 3px !important;
            font-size: 1.6rem;
            font-family: "Nunito",sans-serif;
            padding: 0.6rem 1.4rem;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: none;
            outline: 0;
        }

        .select2-results__option {
            padding: 6px;
            user-select: none;
            -webkit-user-select: none;
            font-size: 1.6rem;
            font-family: "Nunito",sans-serif;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #164ca1;
            color: white;
        }

        @media (max-width: 600px)
        {
            .select2-container--default .select2-selection--multiple {
                width: 100% !important;
                font-size: 2rem;
            }
        }

        @media (max-width: 600px)
        {
            .enrollnow__c .form__c .doc__i .display {
                width: 10rem !important;
                font-size: 2rem;
            }
        }

        @media (max-width: 600px)
        {
            .enrollnow__c .form__c .doc__i .display {
                width: 10rem !important;
                font-size: 2rem;
            }
        }

        .enrollnow__c .form__c-r .form__c-r-i sub {
            position: absolute;
            margin-left: 22%;
            margin-top: -45px;
            font-size: 1.2rem;
        }

        @media (max-width: 600px)
        {
            .enrollnow__c .form__c-r .form__c-r-i sub {
                position: unset;
                margin-left: unset;
                margin-top: 0px;
                font-size: 1.2rem;
            }
        }
        .h__c-ul-li {
            position: relative;
            display: inline-block;
        }

        /* Style for the dropdown button */
        .dropdown-button {
            background-color: rgba(255,102,0,0.8);
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        /* Style for the dropdown content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            max-height: 400px; /* Set the max height before scrollbar appears */
            overflow-y: auto; /* Add a scrollbar when content exceeds max height */
        }

        /* Style for the individual dropdown options */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;

            text-decoration: none;
            display: block;
        }

        /* Change color on hover for the options */
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Show the dropdown content when the dropdown button is hovered */
        .h__c-ul-li:hover .dropdown-content {
            display: block;
        }
    </style>
      <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
    <header class="h" style="z-index:1000;">
        <div class="h__c">
            <ul class="h__c-ul">
         <li class="h__c-ul-li">
                    <div class="dropdown-button">Top Coaching Institutes<iconify-icon icon="gridicons:dropdown" style="font-size:27px;margin-bottom:-10px;"></iconify-icon></div>
                    <div class="dropdown-content">
                        @if(isset($courses))
                            @foreach ($courses as $course)
                                <a href="{{ url('topcoachings') . '/' . urlencode($course->slug) }}">{{ $course->name}}</a>
                            @endforeach
                        @endif
                    </div>
                </li>                
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
                    <p>Search Coaching, Compare Coaching</p>
                </div>
            </div>
            <div class="h__c-md">
                <div class="h__c-md-db">
                    <span class="material-icons">menu</span>
                </div>
                <div class="h__c-md-d h__c-md-danim">
                    <img src={{ asset('assets/logo.png') }} alt="Coaching Detail">
                    <ul>
                  {{--
                      <li class="h__c-ul-li">

                    <select name="" id="courseDropdown" onchange="redirectToCourse()">
                        <option value="" style="text-align: left">Top Coaching Institutes</option>
                        @if(isset($courses))
                        @foreach ($courses as $course)
                            <option value="{{ url('course') . '/' . urlencode($course->slug) }}">{{ $course->name}}</option>
                        @endforeach
                        @endif
                    </select>



                </li>
                        --}}
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
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="{{ url('disclaimer') }}">Disclaimer</a>
                    </div>
                    <a class="mail" href="mailto:contact@coachingdetail.com">Email: contact@coachingdetail.com</a>
                      <a href="https://play.google.com/store/apps/details?id=com.coachingdetail.app&hl=en-IN"><img src="img/google_play.png" alt="" height="50px" width="150px"></a>
                </div>
            </div>
            <div class="f__c-acd">
                <ul class="f__c-c-sl">
                    <li>
                        <a href="https://www.facebook.com/coachingdetail/">
                            <i class="fab fa-facebook" aria-hidden="true"></i>
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
                           <i class="fab fa-facebook" aria-hidden="true"></i>
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
<script>
    function redirectToCourse() {
        var dropdown = document.getElementById("courseDropdown");
        var selectedUrl = dropdown.options[dropdown.selectedIndex].value;
        if (selectedUrl) {
            window.location.href = selectedUrl;
        }
    }
</script>


</html>
