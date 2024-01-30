@extends('layouts.header')

@section('content')
<head>
    <style>
    .container {
    text-align: center;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 36px;
    margin-bottom: 20px;
    color: #ff6f61;
}

p {
    font-size: 18px;
    margin-bottom: 40px;
    color: #333333;
}

.emoji {
    font-size: 48px;
}
</style>
</head>
    @include('components.pagetitle',['title'=>"Fee Structure",'subtitle'=>$coaching->name])
      @if ($fee_structures->count() == 0)
    <tr style="background-color: white;">
        <div class="container">
            
            <h1>Data Not Available</h1>
            <p>Sorry, there is no data to display at the moment. Please check back later.</p>
        </div>
    </tr>
    @else
    <div class="feestructure">
        <div class="feestructure__c">
            <div class="feestructure__c-table">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Course</th>
                        <th>Course Name</th>
                        <th>Stream</th>
                         {{--
                        <th>Type</th>--}}
                        <th>Batch Starting Date</th>
                        <th>Duration</th>
                        <th>Fees</th>
                        <th>Admission Process</th>
                        <th>Admission Open</th>
                    </thead>
                    <tbody>
                       
                            @foreach ($fee_structures as $key => $structure)
                                <tr style="background-color: {{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$structure->course['name'] ?? "N/A"}}</td>
                                    <td>{{$structure->course_name ?? "N/A"}}</td>
                                    <td>{{$structure->stream ?? "N/A"}}</td>
                                             {{--
                                    <td>{{$structure->type ?? "N/A"}}</td>--}}
                                    <td>{{$structure->batch_starting_date == null ? "N/A" : date('d F Y',strtotime($structure->batch_starting_date))}}</td>
                                    <td>{{$structure->course_duration ?? "N/A"}}</td>
                                    <td><span style="font-family: arial;">₹</span> {{$structure->fees ?? "N/A"}}</td>
                                    <td>Online/Offline</td>
                                    <td>@if (session('user'))
                                                    <a href="{{ url("onlineadmission/$coaching->id") }}" style="background-color:#253f94;font-size:10px;width:70px;margin-top:50%;font-weight:bold">Enroll Now</a>
                                                @else
                                                    <a href="{{ url('login') }}" style="background-color:#253f94;font-size:10px;width:70px;margin-top:50%;font-weight:bold">Enroll Now</a>
                                                @endif
                                         </td>
                                      </tr>
                              
                            @endforeach
                            
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection