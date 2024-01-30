@extends('layouts.header')

@section('content')

    <div class="clh">
        <div class="clh__c">
            @if (isset($searchtext))
                <h2 class="clh__c-t">Searched for: {{ $searchtext }} </h2>
            @endif
            @if (isset($cityname))
                <p class="clh__c-t">List of top Libraries in {{ $cityname }}</p>
                <div class="clh__c-s">
                    <div class="clh__c-s-st city-btn">
                        <p class="city-selected">{{ $cityname }}</p>
                        <i class="fa fa-caret-down"></i>
                        <div class="btn__dropdown" id="cityDropdown">
                            <ul class="btn__dropdown-ul city-btn-dropdown">
                                @foreach ($cities as $city)
                                    <li>
                                        <p>{{ $city->name }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a id="mapview"
                        href="{{ url('maplibrarysearch') . '/' . $cityname }}">
                        <div class="clh__c-s-ms">
                            <span class="material-icons">location_pin</span>
                            <p>MAP VIEW</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        
        $('.city-btn').click(() => {
            if ($('.city-btn-dropdown').css('height') === "0px") {
                $('.city-btn-dropdown').css({
                    'max-height': '22rem',
                    'height': 'auto',
                    'overflow-y': 'auto',
                    'transition': 'all 0.5s'
                });
            } else {
                $('.city-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });
            }
        })

        $(document).on("click", function(event) {
            if ($(event.target).closest(".city-btn").length === 0) {
                $('.city-btn-dropdown').css({
                    'height': '0px',
                    'overflow-y': 'hidden',
                    'transition': 'all 0.5s'
                });;
            }
        });

        let citySelected;
        Array.of($('.city-btn-dropdown').children()).forEach((city) => {
            city.on("click", (e) => {
                $('.city-selected').text(e.target.innerText);
                citySelected = e.target.innerText;
                $('#maplibraryview').attr('href', `{{ url('maplibrarysearch') . '/' }}${e.target.innerText}`);
            })
        })
    </script>

    <div class="bc">
        <div class="bc__c">
            <a href="{{ url('/') }}">
                <p>Home</p>
            </a>
            <p>&nbsp; > {{ isset($typename) ? $typename : '' }}{{ isset($cityname) ? ' > ' . $cityname : '' }}</p>
        </div>
    </div>

    <div class="cl">
        <div class="cl__c">
            <div class="cl__c-f">
                <div class="cl__c-f-c">
                    <h5 class="cl__c-f-c-h">FILTERS</h5>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">ESTABLISHED</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem establish_checkbox" name="established" value="asc"
                                id="old-1">
                            <label for="old-1">Old To New</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem establish_checkbox" name="established" value="desc"
                                id="old-2">
                            <label for="old-2">New To Old</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">FEE STRUCTURE</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem feestructure_checkbox" name="fees" value="desc"
                                id="old-3">
                            <label for="old-3">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem feestructure_checkbox" name="fees" value="asc"
                                id="old-4">
                            <label for="old-4">Low To High</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">RATING & REVIEWS</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="4"
                                id="old-5">
                            <label for="old-5">4 <i class="fa fa-star"></i> &amp; Above</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="3"
                                id="old-6">
                            <label for="old-6">3 <i class="fa fa-star"></i> &amp; Above </label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="2"
                                id="old-7">
                            <label for="old-7">2 <i class="fa fa-star"></i> &amp; Above </label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem rating_checkbox" name="rating" value="1"
                                id="old-8">
                            <label for="old-8">1 <i class="fa fa-star"></i> &amp; Above </label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">TOTAL BRANCH ACROSS INDIA</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem branch_checkbox" name="branches" value="desc"
                                id="old-9">
                            <label for="old-9">Maximum To Minimum</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem branch_checkbox" name="branches" value="asc"
                                id="old-10">
                            <label for="old-10">minimum to Maximum</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">SELECTED STUDENTS</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem students_checkbox" name="student_selection"
                                value="desc" id="old-11">
                            <label for="old-11">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem students_checkbox" name="student_selection"
                                value="asc" id="old-12">
                            <label for="old-12">Low To High</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem students_checkbox" name="student_selection"
                                value="n/a" id="old-13">
                            <label for="old-13">N/A</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">VIEW</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem view_checkbox" name="views" value="desc"
                                id="old-14">
                            <label for="old-14">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem view_checkbox" name="views" value="asc"
                                id="old-15">
                            <label for="old-15">Low To High</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">LIKE</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem like_checkbox" name="likes" value="desc"
                                id="old-16">
                            <label for="old-16">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem like_checkbox" name="likes" value="asc"
                                id="old-17">
                            <label for="old-17">Low To High</label>
                        </div>
                    </div>
                    <div class="cl__c-f-c-i">
                        <p class="cl__c-f-c-sh">DISLIKE</p>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem dislike_checkbox" name="dislikes" value="desc"
                                id="old-18">
                            <label for="old-18">High To Low</label>
                        </div>
                        <div class="cl__c-f-c-cbx">
                            <input type="checkbox" class="filteritem dislike_checkbox" name="dislikes" value="asc"
                                id="old-19">
                            <label for="old-19">Low To High</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cl__c-cl">
                <div class="cl__c-cl-c">
                    @if (count($libraries) == 0)
                        <div class="empty">
                            <img src="{{ asset('img/empty-tree.svg') }}" alt="">
                            <p>Oops! It seems that library you are looking for isn't available</p>
                        </div>
                    @else
                        @foreach ($libraries as $library)
                            @include('components.librarycard', [
                                'library' => $library,
                            ])
                        @endforeach
                        @include('components.pagination', ['data' => $libraries])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/coachingFilter.js') }}"></script>
     
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Add click event listener to dropdown items
        $('#cityDropdown').on('click', 'li', function () {
            // Get the selected city name
            var cityName = $(this).find('p').text();

            // Build the URL
            var redirectUrl = encodeURIComponent(cityName);

            // Redirect to the URL
            window.location.href = redirectUrl;
        });
    });
</script>
@endsection
