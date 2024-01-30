    <div class="cc">
        <div class="cc__l">
            <img src="{{ url('storage').'/'.$tutor->thumbnail }}" alt="Tutor Logo">
        </div>
        <div class="cc__m">
            <div class="cc__m-h">
                <a href="{{ url('tutor') . '/' . $tutor->slug }}">
                    {{$tutor->name}}
                </a> 
            </div>
            <div class="cc__m-r">
                <div class="cc__m-r-rc">
                    <i class="fa fa-star"></i>
                    <p>4.2</p>
                </div>
                <p>2k Likes & 150 Dislikes</p>
            </div>
            
            <ul>
                <li>Course Type:  @php $coursename = [] @endphp
                    @foreach(json_decode($tutor->course) as $tutcourse)
                        @php $coursename[] = $tutorcourselist[$tutcourse] @endphp
                    @endforeach
                    {{implode(", ",$coursename)}}

                </li>
                <li>Contact Number: {{$tutor->phone}}</li>
                <li>Email: {{$tutor->email}}</li>
                <li>Fee per hour: <p style="font-family: roboto;display:inline;">₹</p> {{$tutor->fee_per_hour}}</li>
                <li>Fee per month: <p style="font-family: roboto;display:inline;">₹</p> {{$tutor->fee_per_month}}</li>
                <li>Address: {{$tutor->present_address}}</li>
                <li>City: {{$tutor->cityrel['name']}}</li>
            </ul>
            <div class="cc__m-bg" style="display: none;"></div>
        </div>
        <div class="cc__r">
            @if (session('user'))
                <i class="fa fa-share" id="share"></i>
                <i class="fa fa-heart wishbtn" style="cursor: pointer;{{$tutor->in_wishlist ? 'color:red;' : 'color:grey;' }}" data-id="{{Crypt::encrypt($tutor->id)}}" data-type="tutor"></i>
                <a class="cc__r-btn" href="{{url('onlineadmission')}}">
                    <div><p>Enroll Now</p></div>
                </a>
            @else
                <a href="{{url('login')}}">
                    <i class="fa fa-heart"></i>
                </a>
                <a class="cc__r-btn" href="{{url('login')}}">
                    <div><p>Enroll Now</p></div>
                </a>
            @endif
        </div>
    </div>