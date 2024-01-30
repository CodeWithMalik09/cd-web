@extends('layouts.tutorHeader')

@section('content')
    <div class="ch">
        <div class="ch__c">
            <div class="ch__c-title">
                <h2 class="ch__c-title-heading">{{ $tutor->name }}</h2>
                <img src="{{ asset('img/default_thumbnail.jpeg') }}" alt="Coaching Detail || Title Image"
                    class="ch__c-title-i">
            </div>
            <div class="ch__c-b">
                <a href="{{ url('/') }}">
                    <p>Home</p>
                </a> <i class="fa fa-chevron-right"></i>
                <p>Tutor </p> <i class="fa fa-chevron-right"></i>
                <p>{{ $tutor->name }}</p>
            </div>
            <div class="ch__c-f">
                <div class="form">
                    <form>
                        <select name="city" id="city">
                            @foreach ($cities as $city)
                                @if ($city->id == $tutor->city)
                                    <option value="{{ $city->name }}" selected>{{ $city->name }}</option>
                                @else
                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="submit" id="searchbtn">Search</button>
                    </form>
                </div>
                <script>
                    $('#searchbtn').click((e) => {
                        e.preventDefault();
                        window.open(`{{ url('tutor') }}/${$('#city').val()}`,
                            '_self');
                    })
                </script>
            </div>
            <div class="ch__c-mc">
                <div class="ch__c-mc-l">
                    @if (session('user'))
                        <div class="wishlist">
                            <i class="fa fa-heart wishbtn"
                                style="cursor: pointer;color: {{ $tutor->wishlisted ? 'red;' : 'grey;' }}"
                                data-id="{{ Crypt::encrypt($tutor->id) }}" data-type="coaching">
                            </i>
                        </div>
                    @else
                        <a class="wishlist" href="{{ url('login') }}">
                            <i class="fa fa-heart wishbtn"></i>
                        </a>
                    @endif
                    <div class="logo">
                        <img src="{{ url('storage') . '/' . $tutor->thumbnail }}" alt="{{ $tutor->name }}">
                    </div>
                    @php
                        $images = [];
                        array_push($images, url('storage') . '/' . $tutor->thumbnail);
                    @endphp
                    <div class="gallery">
                        @if ($tutor->gallery)
                            @foreach (json_decode($tutor->gallery) as $img)
                                @php
                                    array_push($images, url('storage') . '/' . $img);
                                @endphp
                                <img src="{{ url('storage') . '/' . $img }}" alt="Img"
                                    onclick="viewImage(this)">
                            @endforeach
                        @endif
                    </div>

                    <div class="extra">
                        @if (session('user'))
                            <a href="{{ url("onlineadmission/$tutor->id") }}">Enroll Now</a>
                        @else
                            <a href="{{ url('login') }}">Enroll Now</a>
                        @endif
                        <a href="{{ url('mapview') . '/' . Crypt::encrypt($tutor->id) }}">Map View</a>
                    </div>
                </div>
                <div class="ch__c-mc-r">
                    <div class="mrow">
                        <h2>{{ $tutor->name }}</h2>
                        <div class="row">
                            <div
                                class="share-btn"onclick="shareMe('{{ urlencode(url('tutor') . '/' . $tutor->slug) }}')">
                                <i class="fa fa-share"></i>
                                <span>Share</span>
                                <div class="share-container">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url("tutor/$tutor->slug") }}"
                                        target="_blank">
                                        <i class="fa fa-facebook"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a href="http://twitter.com/share?text=ShareCoachingDetaile&url={{ url("tutor/$tutor->slug") }}"
                                        target="_blank">
                                        <i class="fa fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a href="https://wa.me/?text={{ url("tutor/$tutor->slug") }}" target="_blank">
                                        <i class="fa fa-whatsapp"></i>
                                        <span>Whatsapp</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="rc">
                        <div class="rc__p">
                            <i class="fa fa-star"></i>
                            <p>{{ $tutor->stats->average_rating ?? 0 }}</p>
                        </div>
                        <p class="rc__t">({{ $tutor->stats->likes ?? 0 }} likes &amp;
                            {{ $tutor->stats->dislikes ?? 0 }} dislikes)</p>
                    </div>
                    
                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>Contact Number: {{ $tutor->phone }}</p>
                    </div>
                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>Email: {{ $tutor->email }}</p>
                    </div>

                    <h4 class="ch__c-mc-r-sh">About {{ $tutor->name }} | Facility -</h4>
                    <p class="ch__c-mc-r-p">{{ $tutor->about }}</p>
                    <div class="row justify-content-between align-items-center">
                        <h4 class="ch__c-mc-r-sh">Rating & Reviews -</h4>
                        @if (auth()->user())
                            <a href="{{ url("write-review/$tutor->slug") }}" class="cta">Write Review</a>
                        @else
                            <a href="{{ url('login') }}" class="cta">Login to Write Review</a>
                        @endif
                    </div>
                 
                    <h4 class="ch__c-mc-r-sh">Contact Information -</h4>
                    <div class="ch__c-mc-r-cc">
                        {{-- <div class="cp">
                        <p>Contact Person</p>
                        <p>Person Name</p>
                    </div> --}}
                        <div class="ca">
                            <div class="address">
                                <p>Address</p>
                                <p>{{ $tutor->landmark ? $tutor->landmark . ', ' : '' }}
                                    {{ $tutor->address . ', ' }}
                                    {{ ucwords(strtolower($tutor->district)) . ', ' }}
                                    {{ ucwords(strtolower($tutor->state)) . ', ' }}
                                    {{ $tutor->pincode }}</p>
                                <a href="tel:+{{ $tutor->phone }}"><i class="fa fa-phone"></i>
                                    {{ $tutor->phone }}
                                </a>
                                @if ($tutor->landline_number && $tutor->landline_number != 'N/A')
                                    <br>
                                    <a href="tel:+{{ $tutor->landline_number }}"><i class="fa fa-phone"></i>
                                        {{ $tutor->landline_number }}
                                    </a>
                                @endif
                                @if ($tutor->alternate_phone && $tutor->alternate_phone != 'N/A')
                                    <br>
                                    <a href="tel:+{{ $tutor->alternate_phone }}"><i class="fa fa-phone"></i>
                                        {{ $tutor->alternate_phone }}
                                    </a>
                                @endif
                            </div>
                            <div class="wh">
                                <p>Working Hours</p>
                                <p>10:00 AM - 8:00 PM <br>Monday to Friday</p>
                            </div>
                        </div>
                        <div class="od">
                            <div class="em">
                                <p>Email</p>
                                <a href="mailto:{{ $tutor->email }}">
                                    <span class="material-icons">email</span>
                                </a>
                            </div>
                            @if ($tutor->website || $tutor->facebook_link || $tutor->youtube_link || $tutor->twitter_link)
                                <div class="links">
                                    <p>Connect us</p>
                                    <div class="lc">
                                        @if ($tutor->website)
                                            <a href="{{ $tutor->website }}" target="_blank">
                                                <div class="fa fa-globe"></div>
                                            </a>
                                        @endif
                                        @if ($tutor->facebook_link)
                                            <a href="{{ $tutor->facebook_link }}" target="_blank">
                                                <div class="fa fa-facebook"></div>
                                            </a>
                                        @endif
                                        @if ($tutor->youtube_link)
                                            <a href="{{ $tutor->youtube_link }}" target="_blank">
                                                <div class="fa fa-youtube"></div>
                                            </a>
                                        @endif
                                        @if ($tutor->twitter_link)
                                            <a href="{{ $tutor->twitter_link }}" target="_blank">
                                                <div class="fa fa-twitter"></div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var images = {!! json_encode($images) !!}
    </script>
    <div class="imgcarousel" style="display: none;">
        <span class="imgcarousel__close" onclick="closeViewImage()">X</span>
        <span class="imgcarousel__prev" onclick="showPrevImage()"><i class="fa fa-chevron-left"></i></span>
        <div class="imgcarousel__c">
            <img src="" class="imgcarousel__c-img">
        </div>
        <span class="imgcarousel__next" onclick="showNextImage()"><i class="fa fa-chevron-right"></i></span>
    </div>

@endsection
