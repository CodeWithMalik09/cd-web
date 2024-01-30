@extends('coaching.layouts.dash')

@section('content')
    <div class="facutly">
        <div class="faculty__c">
            <div class="blog__c-h">
                <a href="{{url('coachingcms/createfaculty')}}">New Faculty</a>
                <form action="{{url('/')}}" method="POST">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Specialization In</th>
                        <th>University</th>
                        <th>College</th>
                        <th>Experience (in years)</th>
                        <th>Job Type</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($faculties as $faculty)
                            <tr style="background-color:{{$i % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                <td>{{$i}}</td>
                                <td>{{$faculty->name}}</td>
                                <td>{{$faculty->designation}}</td>
                                <td>{{$faculty->specialization_on}}</td>
                                <td>{{$faculty->university}}</td>
                                <td>{{$faculty->college}}</td>
                                <td>{{$faculty->experience_in_years}}</td>
                                <td>{{$faculty->job_type}}</td>
                                {{-- <td>{{date('d F Y',strtotime($faculty->created_at))}}</td> --}}
                                <td>
                                    <a href="{{url('coachingcms/editfaculty').'/'.$faculty->id}}">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <a href="{{url('coachingcms/deletefaculty').'/'.$faculty->id}}">
                                        <span class="material-icons">delete</span>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection