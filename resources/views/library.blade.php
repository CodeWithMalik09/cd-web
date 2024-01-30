@extends('layouts.libraryHeader')

@section('content')
    <div class="ch">
        <div class="ch__c">
            <div class="ch__c-title">
                <h2 class="ch__c-title-heading">{{ $library->name }}</h2>
                <img src="{{ asset('img/default_thumbnail.jpeg') }}" alt="Coaching Detail || Title Image"
                    class="ch__c-title-i">
            </div>
            <div class="ch__c-b">
                <a href="{{ url('/') }}">
                    <p>Home</p>
                </a> <i class="fa fa-chevron-right"></i>
                <p>Library </p> <i class="fa fa-chevron-right"></i>
                <p>{{ $library->name }}</p>
            </div>
            <div class="ch__c-f">
                <div class="form">
                    <form>
                        <select name="city" id="city">
                            @foreach ($cities as $city)
                                @if ($city->id == $library->cities)
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
                        window.open(`{{ url('libraries') }}/${$('#city').val()}`,
                            '_self');
                    })
                </script>
            </div>
            <div class="ch__c-mc">
                <div class="ch__c-mc-l">
                    @if (session('user'))
                        <div class="wishlist">
                            <i class="fa fa-heart wishbtn"
                                style="cursor: pointer;color: {{ $library->wishlisted ? 'red;' : 'grey;' }}"
                                data-id="{{ Crypt::encrypt($library->id) }}" data-type="coaching">
                            </i>
                        </div>
                    @else
                        <a class="wishlist" href="{{ url('login') }}">
                            <i class="fa fa-heart wishbtn"></i>
                        </a>
                    @endif
                    <div class="logo">
                        <img src="{{ url('storage') . '/' . $library->logo }}" alt="{{ $library->name }}">
                    </div>
                    @php
                        $images = [];
                        array_push($images, url('storage') . '/' . $library->logo);
                    @endphp
                    <div class="gallery">
                        @if ($library->galleries)
                            @foreach ($library->galleries as $img)
                                @php
                                    array_push($images, url('storage') . '/' . $img->image);
                                @endphp
                                <img src="{{ url('storage') . '/' . $img->image }}" alt="Img"
                                    onclick="viewImage(this)">
                            @endforeach
                        @endif
                    </div>

                    @if ($library->video)
                        <div class="video">
                            <video controls=""><source src="{{ url('storage') . '/' . $library->video }}" type="video/mp4"></video>
                        </div>
                    @endif
                    <div class="extra">
                        @if (session('user'))
                            <a href="{{ url("onlineadmission/$library->id") }}">Enroll Now</a>
                        @else
                            <a href="{{ url('login') }}">Enroll Now</a>
                        @endif
                        <a href="{{ url('maplibraryview') . '/' . Crypt::encrypt($library->id) }}">Map View</a>
                    </div>
                </div>
                <div class="ch__c-mc-r">
                    <div class="mrow">
                        <h2>{{ $library->name }}</h2>
                        <div class="row">
                            <div
                                class="share-btn"onclick="shareMe('{{ urlencode(url('library') . '/' . $library->slug) }}')">
                                <i class="fa fa-share"></i>
                                <span>Share</span>
                                <div class="share-container">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url("library/$library->slug") }}"
                                        target="_blank">
                                        <i class="fa fa-facebook"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a href="http://twitter.com/share?text=ShareCoachingDetaile&url={{ url("library/$library->slug") }}"
                                        target="_blank">
                                        <i class="fa fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a href="https://wa.me/?text={{ url("library/$library->slug") }}" target="_blank">
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
                            <p>{{ $library->stats->average_rating ?? 0 }}</p>
                        </div>
                        <p class="rc__t">({{ $library->stats->likes ?? 0 }} likes &amp;
                            {{ $library->stats->dislikes ?? 0 }} dislikes)</p>
                    </div>
                    <div class="dc">
                        <i class="fa fa-calendar"></i>
                        <p>Est.: {{ $library->establishment ?? 'N/A'}}</p>
                    </div>
                
                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>Head of Organization: {{ ucwords($library->head_organisation) ?? 'N/A'}}</p>
                    </div>
                    
                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>Contact Number: {{ $library->phone }}</p>
                    </div>
                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>Email: {{ $library->email }}</p>
                    </div>

                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>Fee Structure: {{ ucwords($library->fee_structure) ?? "N/A"}}</p>
                    </div>

                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>Modes of Payment: {{ $library->modes_of_payment ?? "N/A"}}</p>
                    </div>

                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>AC Available: {{ $library->ac_available == 1 ? "Yes" : "No"}}</p>
                    </div>

                    <div class="dc">
                        <i class="fa fa-arrow-right"></i>
                        <p>CCTV Recording: {{ $library->cctv_with_recording == 1 ? "Yes" : "No"}}</p>
                    </div>

                    <h4 class="ch__c-mc-r-sh">About {{ $library->name }} | Facility -</h4>
                    <p class="ch__c-mc-r-p">{{ $library->about }}</p>
                    <div class="row justify-content-between align-items-center">
                        <h4 class="ch__c-mc-r-sh">Rating & Reviews -</h4>
                        @if (auth()->user())
                            <a href="{{ url("write-review/$library->slug") }}" class="cta">Write Review</a>
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
                                <p>{{ $library->landmark ? $library->landmark . ', ' : '' }}
                                    {{ $library->address . ', ' }}
                                    {{ ucwords(strtolower($library->district)) . ', ' }}
                                    {{ ucwords(strtolower($library->state)) . ', ' }}
                                    {{ $library->pincode }}</p>
                                <a href="tel:+{{ $library->phone }}"><i class="fa fa-phone"></i>
                                    {{ $library->phone }}
                                </a>
                                @if ($library->landline_number && $library->landline_number != 'N/A')
                                    <br>
                                    <a href="tel:+{{ $library->landline_number }}"><i class="fa fa-phone"></i>
                                        {{ $library->landline_number }}
                                    </a>
                                @endif
                                @if ($library->alternate_phone && $library->alternate_phone != 'N/A')
                                    <br>
                                    <a href="tel:+{{ $library->alternate_phone }}"><i class="fa fa-phone"></i>
                                        {{ $library->alternate_phone }}
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
                                <a href="mailto:{{ $library->email }}">
                                    <span class="material-icons">email</span>
                                </a>
                            </div>
                            @if ($library->website || $library->facebook_link || $library->youtube_link || $library->twitter_link)
                                <div class="links">
                                    <p>Connect us</p>
                                    <div class="lc">
                                        @if ($library->website)
                                            <a href="{{ $library->website }}" target="_blank">
                                                <div class="fa fa-globe"></div>
                                            </a>
                                        @endif
                                        @if ($library->facebook_link)
                                            <a href="{{ $library->facebook_link }}" target="_blank">
                                                <div class="fa fa-facebook"></div>
                                            </a>
                                        @endif
                                        @if ($library->youtube_link)
                                            <a href="{{ $library->youtube_link }}" target="_blank">
                                                <div class="fa fa-youtube"></div>
                                            </a>
                                        @endif
                                        @if ($library->twitter_link)
                                            <a href="{{ $library->twitter_link }}" target="_blank">
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
