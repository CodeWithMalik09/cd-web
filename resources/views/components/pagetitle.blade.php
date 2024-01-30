<div class="pagetitle">
    <div class="pagetitle__c">
        <h2>
            {{ $title }}
            {{-- @if (isset($coachings)) --}}
            {{-- @if (isset($coachings))
                @foreach ($coachings as $coaching)
                    {{ $coaching->name }}
                @endforeach
            @endif --}}
            {{-- @endif --}}
        </h2>
        @if (isset($type) && $type == 'Job')
            <form action="{{ url('search-job-post') }}" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf
                @php
                    $exam_course = ['All India Govt. Jobs', 'Bank Jobs', 'Teaching Jobs', 'Technical Jobs(GATE/ESE/State PSUs)', 'Technical Jobs(Upto JE)', 'Railway Jobs', 'SSC Jobs', 'UPSC Jobs', 'Police/Defence Jobs', 'Andhra Pradesh Jobs', 'Assam Jobs', 'Bihar Jobs', 'Chhattisgarh Jobs', 'Delhi Jobs', 'Gujarat Jobs', 'Himachal Jobs', 'Haryana Jobs', 'Jharkhand Jobs', 'Karnataka Jobs', 'Kerala Jobs', 'Maharastra Jobs', 'Madhya Pradesh Jobs', 'Odisha Jobs', 'Punjab Jobs', 'Rajasthan Jobs', 'Tamil Nadu Jobs', 'Telangana Jobs', 'Uttarakhand Jobs', 'Uttar Pradesh Jobs', 'West Bengal Jobs', 'Meghalaya Jobs', 'Arunachal Pradesh', 'Other State'];
                @endphp
                <select name="course" id="">
                    <option selected disabled>Select to search job</option>
                    @foreach ($exam_course as $course)
                        @if (isset($search) && $course == $search)
                            <option value="{{ $course }}" selected>{{ $course }}</option>
                        @else
                            <option value="{{ $course }}">{{ $course }}</option>
                        @endif
                    @endforeach
                </select>
                <input type="submit" value="Search">
            </form>
                    @elseif (isset($type) && $type == 'Blog')
            <form action="{{ url('search-blog-post') }}" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf
                @php
                    $exam_course = ['JEE(Mains & Adv)KVPY/Olympiad', 'Bank/Ibps', 'Railway', 'SSC', 'Civil Services/State PSC', 'Defence(Police)/NDA', 'Technical(Gate/ESE/PSUs)', 'Technical(upto JE)', 'NEET(UG)', 'NEET(PG)', 'CAT/MAT(MBA)', 'CLAT(Law)', 'CA/CS(Commerce)', 'NIFT(NID)', 'Interview/GD', 'Music/Dance/Acting', 'Karate/Yoga/Sports', 'GMAT/GRE(Foreign Study)', 'JRF/NET/CSIR(UGC)/TET','6th-12th'];
                @endphp
                <select name="course" id="">
                    <option selected disabled>Select to search Blog</option>
                    @foreach ($exam_course as $course)
                        @if (isset($search) && $course == $search)
                            <option value="{{ $course }}" selected>{{ $course }}</option>
                        @else
                            <option value="{{ $course }}">{{ $course }}</option>
                        @endif
                    @endforeach
                </select>
                <input type="submit" value="Search">
            </form>
            @endif
        @if (isset($subtitle))
            <h5>{{ $subtitle }}</h5>
        @endif
    </div>
</div>
