@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>'Compare Coachings'])
    <div class="compare">
        <div class="compare__c">
            <table>
                <thead style="width: 100%;">
                    <th>
                        <p style="font-size: 4.2rem;">Tutors</p>
                    </th>
                    @foreach ($tutors as $tutor)
                        <th ><img src="{{url('storage').'/'.$tutor->thumbnail}}" alt=""></th>
                    @endforeach
                </thead>
            </table>
            <table style="border: 1px solid rgb(207, 207, 207);">
                <thead style="background-color: #253f94;color:white;">
                    <th >
                        <p>Tutor Names</p>
                    </th>
                    @foreach ($tutors as $tutor)
                        <th >
                            <p>{{$tutor->name}}</p>
                        </th>
                    @endforeach
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>Rating & Review</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>4.2</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Courses / Exam Offers</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->course['name']}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Gender</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->gender}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Phone Number</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->phone}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Address</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->present_address}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Qualifications</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->qualification_details}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>City</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->city}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Fee Per Hour</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->fee_per_hour}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Fee Per Month</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->fee_per_month}}</p>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            <p>Experience</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->teaching_experience}}</p>
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>
                            <p>About</p>
                        </td>
                        @foreach ($tutors as $tutor)
                            <td>
                                <p>{{$tutor->about}}</p>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
@endsection