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
    @include('components.pagetitle',['title'=>"Faculties",'subtitle'=>$coaching->name])
     @if ($faculties->count() == 0)
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
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Specialization In</th>
                        <th>University</th>
                        <th>College</th>
                        <th>Experience (in years)</th>
                       {{--
                        <th>Job Type</th>
                        <th>Remarks</th>
                          --}}
                    </thead>
                    <tbody>
                         @php
                         $i=1;
                         @endphp
                         @foreach ($faculties as $faculty)
                                <tr style="background-color: {{$i % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                    <td>{{$i}}</td>
                                    <td>{{$faculty->name ?? "N/A"}}</td>
                                    <td>{{$faculty->designation ?? "N/A"}}</td>
                                    <td>{{$faculty->specialization_on ?? "N/A"}}</td>
                                    <td>{{$faculty->university ?? "N/A"}}</td>
                                    <td>{{$faculty->college ?? "N/A"}}</td>
                                    <td>{{$faculty->experience_in_years ?? "N/A"}}</td>
                                      {{--
                                    <td>{{$faculty->job_type ?? "N/A"}}</td>
                                    <td>{{$faculty->remarks ?? "N/A"}}</td>
                                     --}}
                                </tr>
                                @php
                                    $i = $i + 1;
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection