@extends('dashboard.layouts.dash')

@section('content')
    <div class="coaching">
        <div class="coaching__c">
            <div class="blog__c-h">
                <a href="javascript:void(0)">Students</a>
                <form action="{{ url('dashboard/search-student') }}" method="POST">
                    @csrf
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="table__c">
                <table>
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Time</th>
                        <th>Enrollments</th>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($students as $student)
                            <tr style="background-color:{{ $i % 2 == 0 ? 'rgba(242,242,242)' : 'white' }};">
                                <td>{{ $i }}</td>
                                <td style="max-width:160px;">{{ $student->name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->latest_login_time }}</td>
                                <td>
                                    <a target="_blank" href="{{ url('dashboard/student-enrollments') . '/' . $student->id }}" title="View">
                                        <span class="material-icons">preview</span>
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
            @if (!isset($search))
                @include('dashboard.components.pagination', ['data' => $students])
            @endif
        </div>
    </div>
@endsection
