@extends('layouts.header')
@section('content')
    @include('components.pagetitle',['title'=>"Facilties",'subtitle'=>$library->name])
    <div class="feestructure">
        <div class="feestructure__c">
            <div class="feestructure__c-table">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Facility</th>

                    </thead>
                    <tbody>
                        @if ($lib_facility_structures->count() == 0)
                            <tr style="background-color: white;">
                                <td>N/A</td>
                                <td>N/A</td>

                            </tr>
                        @else
                            @foreach ($lib_facility_structures as $key => $libfacilitystructure)
                                <tr style="background-color: {{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$libfacilitystructure->facility ?? "N/A"}}</td>

                                </tr>

                            @endforeach

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
