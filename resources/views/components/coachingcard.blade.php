<head>
    <style>
  #local{
color: black;
font-weight: bold;
font-family:nunito;
font-size:15px;
}
/*for responsive */
#res2{
    display: none;
}
@media(max-width:700px){
    #res{
        display: none;
    }
    #res2{
        display: block;
    }
}

    </style>
</head>

<div class="cc">
    <div class="cc__l">
        <img src="{{ url('storage') . '/' . $coaching->logo }}" alt="Coaching Logo">
        <div class="cc__l-cbtn">
            @php
                $rand = rand(1000, 500000);
                $valarr = [
                    'name' => $coaching->name,
                    'logo' => $coaching->logo,
                    'id' => Crypt::encryptString($coaching->id),
                ];
            @endphp
            <input type="checkbox" class="comparebtn" value="{{ json_encode($coaching->only(['id', 'logo', 'name'])) }}"
                data-id="{{ $coaching->id }}" id="comparebtn_{{ $rand }}">
            <label for="comparebtn_{{ $rand }}">Add To Compare</label>
        </div>
    </div>
    <a href="{{ url('coaching') . '/' . $coaching->slug }}">
        <div class="cc__m">
            <div class="cc__m-h">
                {{-- <a href="{{url('coaching').'/'.implode('-',explode(' ',$coaching->name))}}"> --}}
                {{ $coaching->name }}
                {{-- </a>  --}}
            </div>
            <div class="cc__m-r">
                <div class="cc__m-r-rc">
                    <i class="fa fa-star"></i>
                    <p>{{ $coaching->stats->average_rating ?? 0 }}</p>
                </div>
                <p>{{ $coaching->stats->likes ?? 0 }} Likes & {{ $coaching->stats->dislikes ?? 0 }} Dislikes

                   @if($coaching->is_verified == 1)
                            <!-- Display verified item -->
                            <img src="{{ asset('assets/verify.png') }}" alt="" height="35px" width="110px" style="margin-bottom:-7px ">
                        @endif

               </p>
            </div>
               <br>
              <p id="local">
                @if ($coaching->locality != '' && $coaching->locality != NULL && $coaching->locality != 'null')
                    @foreach (json_decode($coaching->locality) as $decodedLocality)
                        @if($decodedLocality != 'others')
                            @foreach ($localities as $locality)
                                @if ($decodedLocality == $locality->id)
                                    {{$locality->name}},
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif

                @foreach ($cities as $city)
                    @if (in_array($city->id, json_decode($coaching->cities)))
                        {{ $city->name }}
                    @endif
                @endforeach
            </p>            
            <ul>
                <li>Establishment: {{ $coaching->establishment ?? "N/A"}} | Head Of the Institute: {{ $coaching->head_organisation ?? "N/A" }}</li>
                <li>Total Branch across India: {{ $coaching->total_branches ?? "N/A"}}</li>
                <li>Course:{{$coaching->mainCourse->name}}</li>
                <li>Contact Number: {{ $coaching->phone }}</li>
                <li>Email: {{ $coaching->email ?? "N/A"}}</li>
                <li>Address: {{ ucwords(strtolower($coaching->address)) }},
                    {{ ucwords(strtolower($coaching->district)) }}, {{ ucwords(strtolower($coaching->state)) }},
                    {{ $coaching->country }},
                    {{ $coaching->pincode }}</li>
            </ul>
            <div class="cc__m-bg">
                <a href="{{ url('feestructure') . '/' . $coaching->slug }}">
                    <div class="cc__m-bg-btn">FEE</div>
                </a>
                <a href="{{ url('faculties') . '/' . $coaching->slug }}">
                    <div class="cc__m-bg-btn">FACULTY</div>
                </a>
                <a href="{{ url('results') . '/achivement/' . $coaching->slug }}">
                    <div class="cc__m-bg-btn">ACHIEVEMENTS</div>
                </a>
                <a href="{{ url('results') . '/result/' . $coaching->slug }}" id="res">
                    <div class="cc__m-bg-btn">RESULTS</div>
                </a>
            </div>
           <a href="{{ url('results') . '/result/' . $coaching->slug }}" style="width:100px;margin-top:5px"id="res2">
                <div class="cc__m-bg-btn">RESULTS</div>
            </a>
        </div>
    </a>
    <div class="cc__r">
        <i class="fa fa-share"></i>
        <div class="cc__r-sc">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url("coaching/$coaching->slug") }}"
                target="_blank">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="https://wa.me/?text={{ url("coaching/$coaching->slug") }}" target="_blank">
                <i class="fa fa-whatsapp"></i>
            </a>
            <a href="http://twitter.com/share?text=ShareCoachingDetaile&url={{ url("coaching/$coaching->slug") }}"
                target="_blank">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="#">
                <i class="fa fa-linkedin"></i>
            </a>
        </div>
        @if (session('user'))
            <i class="fa fa-heart wishbtn"
                style="cursor: pointer;{{ $coaching->wishlisted ? 'color:red;' : 'color:grey;' }}"
                data-id="{{ Crypt::encrypt($coaching->id) }}" data-type="coaching"></i>
            <a class="cc__r-btn" href="{{ url("onlineadmission/$coaching->id") }}">
                <div>
                    <p>Enroll Now</p>
                </div>
            </a>
        @else
            <a href="{{ url('login') }}">
                <i class="fa fa-heart"></i>
            </a>
            <a class="cc__r-btn" href="{{ url('login') }}">
                <div>
                    <p>Enroll Now</p>
                </div>
            </a>
        @endif

    </div>
</div>
