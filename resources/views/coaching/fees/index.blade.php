@extends('coaching.layouts.dash')

@section('content')
    <div class="facutly">
        <div class="faculty__c">
            <div class="blog__c-h">
                <a href="{{url('coachingcms/createfeestructure')}}">New Fee Structure</a>
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
                        <th>Stream</th>
                        <th>Type</th>
                        <th>Batch Starting Date</th>
                        <th>Fees</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($fee_structures as $fee)
                            <tr style="background-color:{{$i % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                <td>{{$i}}</td>
                                <td>{{$fee->course['name']}}</td>
                                <td>{{$fee->stream}}</td>
                                <td>{{$fee->type}}</td>
                                <td>{{date('d F Y',strtotime($fee->batch_starting_date))}}</td>
                                <td><span style="font-family: arial;">₹</span> {{$fee->fees}}</td>
                                {{-- <td>{{date('d F Y',strtotime($fee->created_at))}}</td> --}}
                                <td>
                                    <a href="{{url('coachingcms/editfeestructure').'/'.$fee->id}}">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <a href="{{url('coachingcms/deletefeestructure').'/'.$fee->id}}">
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