@extends('coaching.layouts.dash')

@section('content')
    <div class="facutly">
        <div class="faculty__c">
            <div class="blog__c-h">
                <a href="{{url('coachingcms/createresults')}}">New Result And Achivement</a>
                <form action="{{url('/')}}" method="POST">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="blog__c-blogs">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Course</th>
                        <th>Exam Year</th>
                        <th>Type</th>
                        <th>Stream</th>
                        <th>Selected in PT</th>
                        <th>Selected in Mains</th>
                        <th>Selected in Final</th>
                        <th>Selected in Top 10</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($results as $result)
                            <tr style="background-color:{{$i % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                <td>{{$i}}</td>
                                <td>{{$result->course['name']}}</td>
                                <td>{{$result->exam_year}}</td>
                                <td>{{$result->type}}</td>
                                <td>{{$result->stream}}</td>
                                <td>{{$result->selected_in_pt}}</td>
                                <td>{{$result->selected_in_mains}}</td>
                                <td>{{$result->selected_in_final}}</td>
                                <td>{{$result->selected_in_top_ten}}</td>
                                {{-- <td>{{date('d F Y',strtotime($fee->created_at))}}</td> --}}
                                <td>
                                    <a href="{{url('coachingcms/editresults').'/'.$result->id}}">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <a href="{{url('coachingcms/deleteresults').'/'.$result->id}}">
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