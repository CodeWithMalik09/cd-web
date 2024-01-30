@extends('layouts.header')

@section('content')
    @include('components.pagetitle',['title'=>"Fee Structure",'subtitle'=>$library->name])
    <div class="feestructure">
        <div class="feestructure__c">
            <div class="feestructure__c-table">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Shifts</th>
                        <th>Timing</th>
                        <th>Monthly Fee</th>

                    </thead>
                    <tbody>
                        @if ($lib_fee_structures->count() == 0)
                            <tr style="background-color: white;">
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>

                            </tr>
                        @else
                            @foreach ($lib_fee_structures as $key => $libfeestructure)
                                <tr style="background-color: {{ ($key + 1) % 2 == 0 ? 'rgba(242,242,242)' : 'white'}};">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$libfeestructure->lib_shift ?? "N/A"}}</td>
                                    <td>{{$libfeestructure->lib_timing ?? "N/A"}}</td>
                                    <td>{{$libfeestructure->lib_monthly_fee ?? "N/A"}}</td>

                                </tr>

                            @endforeach

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
