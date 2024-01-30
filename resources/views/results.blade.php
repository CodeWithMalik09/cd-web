@extends('layouts.header')

@section('content')
    @include('components.pagetitle', [
        'title' => $type == 'result' ? 'Student Results' : 'Student Achivements',
        'subtitle' => $coaching->name,
    ])
    <div class="feestructure">
        <div class="feestructure__c">
            <div class="feestructure__c-table">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Course</th>
                        <th>Exam Year</th>
                        <th>Stream/Post</th>
                        @if ($type == 'achivement')
                            <th>Type</th>
                            <th>Student Name</th>
                            <th>Rank</th>
                            <th>Percentage/Score</th>
                        @else
                            <th>Selected Students(PT)</th>
                            <th>Student Stuents(Main)</th>
                            <th>Selected Students(Final)</th>
                        @endif

                        {{-- <th>Selected in PT</th>
                        <th>Selected in Mains</th>
                        <th>Selected in Final</th>
                        <th>Selected in Top 10</th>
                        <th>Remarks</th> --}}
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @if ($results->count() == 0)
                            <tr style="background-color: {{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                @if ($type == 'achivement')
                                    <td>N/A</td>
                                @endif
                            </tr>
                        @else
                            @foreach ($results as $result)
                                <tr style="background-color: {{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                    <td>{{ $i }}</td>
                                    <td>{{ $result->course['name'] ?? 'N/A' }}</td>
                                    <td>{{ $result->exam_year ?? 'N/A' }}</td>
                                    <td>{{ $result->stream ?? 'N/A' }}</td>
                                    @if ($type == 'achivement')
                                        <td>{{ $result->type ?? 'N/A' }}</td>
                                        <td>{{ $result->student_name ?? 'N/A' }}</td>
                                        <td>{{ $result->rank ?? 'N/A' }}</td>
                                        <td>{{ $result->percentage ?? 'N/A' }}</td>
                                    @else
                                        <td>{{ $result->selected_in_pt ?? 'N/A' }}</td>
                                        <td>{{ $result->selected_in_mains ?? 'N/A' }}</td>
                                        <td>{{ $result->selected_in_final ?? 'N/A' }}</td>
                                    @endif
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
