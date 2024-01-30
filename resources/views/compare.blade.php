@extends('layouts.header')

@section('content')
    <div class="pagetitle" style="background-image:url('https://coachingdetail.com/assets/pagetitle_compare.png')">
        <div class="pagetitle__c">
            <h2>
                @foreach ($coachings as $key => $coaching)
                    {{ $coaching->name }}
                    @if ($coachings->count() > 1 && $key != $coachings->count() - 1)
                        <span style="color: orange;">VS</span>
                    @endif
                @endforeach
            </h2>
        </div>
    </div>
    <div class="compare">
        <div class="compare__c">

            <table>
                <tbody style="width: 100%;">
                    <tr>
                        <td>
                            <p style="font-size: 2rem;">
                                Logo
                            </p>
                        </td>
                        @foreach ($coachings as $coaching)
                            <td>
                                <div class="img-container">
                                    <img src="{{ url('storage') . '/' . $coaching->logo }}" alt="{{ $coaching->name }} Logo">
                                </div>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size: 2rem;">
                                Coaching
                            </p>
                        </td>
                        @foreach ($coachings as $coaching)
                            <td>
                                <h4>{{ $coaching->name }}</h4>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <div class="tblcon">
                <table style="border: 1px solid rgb(207, 207, 207);">
                    <tbody>
                        <tr>
                            <td>
                                <p>Rating & Review</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->reviews->count() }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Course</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->mainCourse->name }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Streams</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->streams }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Course Type</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->course_types }}</p>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tblcon">
                <table style="border: 1px solid rgb(207, 207, 207);">
                    <thead>
                        <th colspan="4"style="background-color: #f79b39;">
                            <p style="padding: 0.6rem;"><i class="fa fa-arrow-right"></i> General Information</p>
                        </th>
                    </thead>
                    <tbody>
                          <tr>
                            <td>
                                <p>Established</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->establishment ?? "N/A" }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Location</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <a href="https://maps.google.com/?q={{$coaching->latitude}},{{$coaching->longitude}}" target="_blank">
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </a>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Status</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->institute_status }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Head Of Institute</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ ucwords(strtolower($coaching->head_organisation)) }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Total Branches Across India</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->total_branches ?? 'N/A' }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Total Centre Area (Sq.)</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->total_area ?? 'N/A' }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Fee Structure, Admission Process & Online Student Enrollment</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <a href="{{ url('feestructure') . '/' . $coaching->slug }}"
                                        class="btn">View</a>
                                    {{-- <div class="hoverview">
                                        fsdf
                                    </div> --}}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Students Achievement</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <a href="{{ url('results') . '/achivement/' . $coaching->slug }}"
                                        class="btn">View</a>
                                    {{-- <div class="hoverview">
                                        fsdf
                                    </div> --}}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Students Results</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <a href="{{ url('results') . '/result/' . $coaching->slug }}"
                                        class="btn">View</a>
                                    {{-- <div class="hoverview">
                                        fsdf
                                    </div> --}}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Faculty Staff & Achievement</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <a href="{{ url('faculties') . '/' . $coaching->slug }}"
                                        class="btn">View</a>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tblcon">
                <table style="border: 1px solid rgb(207, 207, 207);">
                    <thead>
                        <th colspan="4"style="background-color: #f79b39;">
                            <p style="padding: 0.6rem;"><i class="fa fa-arrow-right"></i> Classroom facility</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>AC</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->ac_available)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Projector</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->projector_available)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Biometric attendance</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->biometric_attendence)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>CCTV With Recording</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->cctv_with_recording)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Audio system</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->audio_system_available)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tblcon">
                <table style="border: 1px solid rgb(207, 207, 207);">
                    <thead>
                        <th colspan="4"style="background-color: #f79b39;">
                            <p style="padding: 0.6rem;"><i class="fa fa-arrow-right"></i> Other Facility</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Hostel Available</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->hostel_facility)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        {{-- <tr>
                            <td>
                                <p>Girls Hostel</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p><i class="fa fa-check"></i></p>
                                </td>
                            @endforeach
                        </tr> --}}
                        <tr>
                            <td>
                                <p>Transport</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->transport_facility)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Library</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->library_facility)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tblcon">
                <table style="border: 1px solid rgb(207, 207, 207);">
                    <thead>
                        <th colspan="4"style="background-color: #f79b39;">
                            <p style="padding: 0.6rem;"><i class="fa fa-arrow-right"></i> Study Material & Test Facility</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Study material/Books/DVD</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->study_material)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Scholarship cum admission process test</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->scholarship_admission_process)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Class test</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->class_test)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Online Test</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->online_test)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Offline Test</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->offline_test)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tblcon">
                <table style="border: 1px solid rgb(207, 207, 207);">
                    <thead>
                        <th colspan="4"style="background-color: #f79b39;">
                            <p style="padding: 0.6rem;"><i class="fa fa-arrow-right"></i> Other Details</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Doubt & Revision classes</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->doubt_and_revision_class)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif

                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Strength of students per batch</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->batch_strength ?? 'N/A' }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Institute management system</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    @if ($coaching->institute_management_system)
                                        <p><i class="fa fa-check"></i></p>
                                    @else
                                        <p><i class="fa fa-times"></i></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Modes of Payment</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->modes_of_payment }}</p>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tblcon">
                <table style="border: 1px solid rgb(207, 207, 207);">
                    <thead>
                        <th colspan="4"style="background-color: #f79b39;">
                            <p style="padding: 0.6rem;"><i class="fa fa-arrow-right"></i> Contact Details</p>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Address</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ ucwords(strtolower($coaching->address)) }}, {{ ucwords(strtolower($coaching->district)) }}, {{ ucwords(strtolower($coaching->state)) }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Contact No.</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>{{ $coaching->phone }}</p>
                                    <p>{{ $coaching->alternate_phone }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Website</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p><a href="{{ $coaching->website }}" target="_blank"><span
                                                class="material-icons">website</span></a></p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Facebook Link</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p><a href="{{ $coaching->facebook_link }}" target="_blank"><span
                                                class="material-icons">facebook</span></a></p>
                                </td>
                            @endforeach
                        </tr>
                        @if ($coaching->twitter_link != '')
                            <tr>
                                <td>
                                    <p>Twitter Link</p>
                                </td>
                                @foreach ($coachings as $coaching)
                                    <td>
                                        <p><a href="{{ $coaching->twitter_link }}" target="_blank"><i
                                                    class="fa fa-twitter fa-2x"></i></a></p>
                                    </td>
                                @endforeach
                            </tr>
                        @endif
                        <tr>
                            <td>
                                <p>Email</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p><a href="mailto:{{ $coaching->email }}"><span
                                                class="material-icons">email</span></a></p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <p>Enroll</p>
                            </td>
                            @foreach ($coachings as $coaching)
                                <td>
                                    <p>
                                        @if (auth()->user())
                                            <a class="btn" href="{{ url("onlineadmission/$coaching->id") }}">Enroll
                                                Now</a>
                                        @else
                                            <a class="btn" href="{{ url('login') }}">Enroll Now</a>
                                        @endif
                                    </p>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
