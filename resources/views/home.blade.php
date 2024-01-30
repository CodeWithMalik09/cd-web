@extends('layouts.header')

@section('content')
    @include('components.homeheaderbottom')
    @if (!isset($_COOKIE['showpopup']))
        @include('components.homeloginpopup')
    @endif
    @include('social_media')
    <section class="es">
        <div class="es__c">
            <h2 class="es__c-h2">Select Your Exam/Course</h2>
            <div class="es__c-c">
                @foreach ($courses as $course)
                    <a href="{{ url('course') . '/' . urlencode($course->slug) }}">
                        <div class="esc">
                            <div class="esc__c">
                                @if ($course->icon)
                                    <img src="{{ asset('storage/' . $course->icon) }}" alt="CoachingDetail Course Icon">
                                @else
                                    <img src="{{ asset('img/badge.svg') }}" alt="CoachingDetail Course Icon">
                                    <p class="esc__c-letter">
                                        {{ $course->name[0] }}
                                    </p>
                                @endif
                            </div>

                            <p class="esc__title">{{ $course->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
       
    </section>

    @foreach ($courses as $course)
        @if ($course->coachings->count() != 0)
            <section class="ccv">
                <div class="ccv__c">
                    <div class="ccv__c-h">
                        <h5>Recently Added {{ $course->name }} Coachings</h5>
                        <a href="{{ url('course') . '/' . $course->slug }}">
                            <span class="vlbtn">VIEW ALL</span>
                        </a>
                    </div>
                    <div class="ccv__c-cl">
                        @foreach ($course->coachings as $coaching)
                            <a href="{{ url('coaching') . '/' . $coaching->slug }}" class="ccv__c-cl-cc">
                                <div>
                                    <img src="{{ url('storage') . '/' . $coaching->logo }}" alt="{{ $coaching->name }}"
                                        loading="lazy">
                                    <h4>{{ $coaching->name }}</h4>
                                    <p>
                                        {{-- @foreach ($courses->whereIn('id', json_decode($coaching->courses)) as $course)
                                            @if ($course->id == $courses->last()->id)
                                                {{ $course->name }}
                                            @else
                                                {{ $course->name }} |
                                            @endif
                                        @endforeach --}}
                                        {{ $coaching->mainCourse->name }}
                                    </p>
                                    <p>{{ $cities->find(json_decode($coaching->cities)[0])->name ?? '' }},
                                        {{ ucwords(strtolower($coaching->state)) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach


    @if (isset($recents))
        <section class="ccv">
            <div class="ccv__c">
                <div class="ccv__c-h">
                    <h5>Recently Viewed</h5>
                    <a href="{{ url('search') . '/' . 'recent' }}">
                        <span class="vlbtn">VIEW ALL</span>
                    </a>
                </div>
                <div class="ccv__c-cl">
                    @foreach ($recents as $coaching)
                        <a href="{{ url('coaching') . '/' . $coaching->slug }}" class="ccv__c-cl-cc">
                            <div>
                                <img src="{{ url('storage') . '/' . $coaching->logo }}" alt="{{ $coaching->name }}"
                                    loading="lazy">
                                <h4>{{ $coaching->name }}</h4>
                                <p>{{ $coaching->mainCourse->name }}</p>
                                <p>{{ $cities->find(json_decode($coaching->cities)[0])->name ?? '' }},{{ ucwords(strtolower($coaching->state)) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- <section class="ccv">
        <div class="ccv__c">
            <div class="ccv__c-h">
                <h5>Recent Activity</h5>
                <a href="{{url('search').'/'."activity"}}">
                    <span class="vlbtn">VIEW ALL</span>
                </a>
            </div>
            <div class="ccv__c-cl">
                @foreach ($coachings as $coaching)
                    <a href="{{url('coaching').'/'.$coaching->name}}" class="ccv__c-cl-cc">
                        <div>
                            <img src="{{url('storage').'/'.$coaching->logo}}" alt="{{$coaching->name}}">
                            <h4>{{$coaching->name}}</h4>
                            <p>Branches: {{$coaching->total_branches}}</p>
                            <p>{{$coaching->state}},{{$coaching->country}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section> --}}

    {{-- <section class="rac">
        <div class="rac__c">
            <div class="rac__c-h">
                <p>Recently Added Coachings</p>
            </div>
            <div class="rac__c-cs">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($coachings as $coaching)
                                <li class="splide__slide">
                                    <a href="{{url('coaching').'/'.implode('-',explode(' ',$coaching->name))}}">
                                        <div class="badge"><p>{{$coaching->name}}</p></div>
                                        <img src="{{url('storage').'/'.$coaching->thumbnail}}" alt="{{$coaching->name}}">
                                    </a>
                                </li>    
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="t">
        <div class="t__c">
            <div class="t__c-h">
                <p>Testimonials</p>
            </div>
            <div class="t__c-c">
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_rakesh.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Rakesh</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>The Coachingdetail.com portal helped my brother in giving appropriate institute for
                                preparation for JEE and my brother securing a good rank. The different concepts helped in
                                searching good institute. I have already recommended this portal to known students.Again
                                thanks Coachingdetail and Taquino india Team</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_viswajeet.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Vishwajeet</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>At CD, teachers are always available for help and clearing doubts through social platform.
                                The way of teaching is helpful to students like me. Now I am preparing BPSC exam and this
                                social education platform is very useful for me.Thanks Coachingdetail</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_kundan.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Kundan</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>I think Coachingdetail.com is the best coaching comparison website and app for JEE and other
                                exams preparation . They provide us which is best coaching nearby you.I am very thankful to
                                Coachingdetail team for their continuous support and motivation which helped me to dream big
                                for myself and gave me the confidence to achieve it.</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_sneha.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Sneha</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>Really No.1 App.This websites is very helpful for the selection of coaching/Institute. With
                                the help of coachingdetail ,i have selected the coaching for junior engineer exam
                                preparation.Now the day,I am working as an engineer at Bihar Govt.Thanks Coachingdetail
                                team.</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_ritika.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Ritika</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>I loved Coachingdetail portal. Really this portal is very helpful for all students which
                                wants to admission in coaching institutes. before the selection of coaching you can compare
                                the institutes accordingthe faculty,fee,results facilities Etc. Coachingdetail helps to me
                                for the searching of GATE exam preparation institute at Patna.</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_deepak.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Deepak</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>

                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>I am a simple student and preparing for competitive exams like Bank, Railway, SSC Etc.With
                                the help of coachingdetail App I joined the coaching institutes without fee because some
                                coaching provide free of cost of education. This facilities i had known from coachingdetail
                                app.Thanks CD</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_nitish.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Nitish</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>If you want to join any coaching classes, before that you can visit coachingdetail portal.
                                Because this portal helps to you for the selection of coaching classes. I really use the App
                                of coachingdetail for the searching of SSC Exam preparation institutes at Delhi</p>
                        </div>
                    </div>
                </div>
                <div class="tc">
                    <div class="tc__circle"></div>
                    <div class="tc__c">
                        <div class="tc__c-t">
                            <img src="{{ asset('assets/testimonial/tst_pintu.jpeg') }}" alt="user image">
                            <div class="tc__c-t-ad">
                                <p class="tc__c-t-ad-n">Pintu</p>
                                <div class="star">
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star</span>
                                    <span class="material-icons">star_half</span>
                                </div>
                            </div>
                        </div>
                        <div class="tc__c-b">
                            <p>At first thanks Taquino India team for developing the portal and app of coachingdetail.This
                                is the best platform for teachers/faculties like me. Here teachers can promote our name with
                                the help of social education platform at coachingdetail. Here teachers/Students can post
                                education related topics.Here tweet and retweet facilities also available.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('enrollment_message'))
        <script>
            swal({
                title: "Message",
                text: "{{ session('enrollment_message') }}",
                icon: "success",
                button: "OK",
            });
        </script>
    @endif
@include('faq')
 @include('homekeyword')
@endsection
