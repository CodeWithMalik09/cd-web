<div class="cc">
    <div class="cc__l">
        <img src="{{ url('storage') . '/' . $library->logo }}" alt="Library Logo">
        <div class="cc__l-cbtn">
            @php
                $rand = rand(1000, 500000);
                $valarr = [
                    'name' => $library->name,
                    'logo' => $library->logo,
                    'id' => Crypt::encryptString($library->id),
                ];
            @endphp
        </div>
    </div>
    <a href="{{ url('library') . '/' . $library->slug }}">
        <div class="cc__m">
            <div class="cc__m-h">
                {{ $library->name }}
            </div>
            
            <div class="cc__m-r">
                <div class="cc__m-r-rc">
                    <i class="fa fa-star"></i>
                    <p>{{ $library->stats->average_rating ?? 0 }}</p>
                </div>
                <p>{{ $library->stats->likes ?? 0 }} Likes & {{ $library->stats->dislikes ?? 0 }} Dislikes</p>
            </div>
            <ul>
                <li>Establishment: {{ $library->establishment ?? "N/A"}}</li>
                <li>Head Of the Organisation: {{ $library->head_organisation ?? "N/A" }}</li>
                <li>Contact Number: {{ $library->phone }}</li>
                <li>Email: {{ $library->email ?? "N/A"}}</li>
                <li>Fee Structure: {{ ucwords($library->fee_structure) ?? "N/A"}}</li>
                <li>Modes of Payment: {{ $library->modes_of_payment ?? "N/A"}}</li>
                <li>AC Available: {{ $library->ac_available == 1 ? "Yes" : "No"}}</li>
                <li>CCTV Recording: {{ $library->cctv_with_recording == 1 ? "Yes" : "No"}}</li>
                <li>Address: {{ ucwords(strtolower($library->address)) }},
                    {{ ucwords(strtolower($library->district)) }}, {{ ucwords(strtolower($library->state)) }},
                    {{ $library->country }},
                    {{ $library->pincode }}</li>
            </ul>
              <div class="cc__m-bg">
                <a href="{{ url('libraryfeestructure') . '/' . $library->slug }}">
                    <div class="cc__m-bg-btn">FEE</div>
                </a>
                <a href="{{ url('libraryfacilitystructure') . '/' . $library->slug }}">
                    <div class="cc__m-bg-btn">Facility</div>
                </a>
            </div>
        </div>
    </a>
    <div class="cc__r">
        <i class="fa fa-share"></i>
        <div class="cc__r-sc">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url("library/$library->slug") }}"
                target="_blank">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="https://wa.me/?text={{ url("library/$library->slug") }}" target="_blank">
                <i class="fa fa-whatsapp"></i>
            </a>
            <a href="http://twitter.com/share?text=ShareCoachingDetaile&url={{ url("library/$library->slug") }}"
                target="_blank">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="#">
                <i class="fa fa-linkedin"></i>
            </a>
        </div>
        @if (session('user'))
            <i class="fa fa-heart wishbtn"
                style="cursor: pointer;{{ $library->wishlisted ? 'color:red;' : 'color:grey;' }}"
                data-id="{{ Crypt::encrypt($library->id) }}" data-type="library"></i>
            <a class="cc__r-btn" href="{{ url("onlineadmission/$library->id") }}">
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
